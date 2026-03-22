<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Exports\MembersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\MemberCardMail;

class MemberController extends Controller
{
    // Show add member form
    public function create()
    {
        // Generate automatic Member ID
        $lastMember = Member::latest('id')->first();
        $nextId = $lastMember ? $lastMember->id + 1 : 1;
        $memberId = 'MB' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        return view('admin.members.create', compact('memberId'));
    }

    // Store member
    public function store(Request $request)
    {
        // 1️⃣ Validate input
        $request->validate([
            'full_name'       => 'required|string|max:255',
            'nic'             => 'nullable|string|max:50',
            'date_of_birth'   => 'nullable|date',
            'membership_type' => 'required|string|max:50',
            'email'           => 'nullable|email',
            'phone'           => 'nullable|string|max:20',
            'address'         => 'nullable|string',
            'start_date'      => 'required|date',
            'expiry_date'     => 'required|date|after:start_date',
            'photo'           => 'nullable|image|mimes:jpg,jpeg,png|max:30720',
        ]);

        // 2️⃣ Generate Member ID
        $lastMember = Member::latest('id')->first();
        $nextId = $lastMember ? $lastMember->id + 1 : 1;
        $memberId = 'MB' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        // 3️⃣ Upload photo if exists
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('members/photos', 'public');
        }

        // 4️⃣ Create member first
        $member = Member::create([
            'member_id'       => $memberId,
            'full_name'       => $request->full_name,
            'nic'             => $request->nic,
            'date_of_birth'   => $request->date_of_birth,
            'membership_type' => $request->membership_type,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'address'         => $request->address,
            'photo'           => $photoPath,
            'start_date'      => $request->start_date,
            'expiry_date'     => $request->expiry_date,
            'status'          => 'active',
        ]);

        // 5️⃣ Generate QR Code pointing to member detail page
        try {
            $qrData = route('admin.members.show', $member->id); // URL of member detail

            // decide format based on server capabilities
            $format = extension_loaded('imagick') ? 'png' : 'svg';
            $extension = $format; // name matches extension
            $qrFileName = 'member_' . $member->id . '.' . $extension;

            // Folder path: storage/app/public/qr-codes
            $folderPath = storage_path('app/public/qr-codes');

            // Create folder if not exists
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $filePath = $folderPath . '/' . $qrFileName;

            // Generate QR code; SVG does not require imagick, PNG does
            if ($format === 'png') {
                QrCode::format('png')
                    ->size(300)
                    ->generate($qrData, $filePath);
            } else {
                QrCode::format('svg')
                    ->size(300)
                    ->generate($qrData, $filePath);
            }

            // Save QR filename in database
            $member->qr_code = $qrFileName;
            $member->save();
        } catch (\Exception $e) {
            \Log::error('QR Code generation failed: ' . $e->getMessage());
        }

        // 6️⃣ Generate and email membership card
        // try {
        //     $this->generateAndEmailCard($member);
        // } catch (\Exception $e) {
        //     \Log::error('Card generation failed: ' . $e->getMessage());
        // }

        // 7️⃣ Redirect back with success
        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Member added successfully with QR code and card sent via email!');
    }

    // View all members
    public function index()
    {
        $members = Member::orderBy('created_at', 'desc')->get();
        return view('admin.members.index', compact('members'));
    }

    public function show($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.show', compact('member'));
    }

    // Show edit form
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.edit', compact('member'));
    }

    // Update member
    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $validated = $request->validate([
            'full_name'        => 'required|string|max:255',
            'nic'              => 'nullable|string|max:50',
            'date_of_birth'    => 'nullable|date',
            'membership_type'  => 'required|string|max:50',
            'email'            => 'nullable|email',
            'phone'            => 'nullable|string|max:20',
            'address'          => 'nullable|string',
            'start_date'       => 'required|date',
            'expiry_date'      => 'required|date|after:start_date',
            'photo'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $validated['photo'] = $request->file('photo')->store('members/photos', 'public');
        }

        $member->update($validated);
        return redirect()->route('admin.members.index')->with('success', 'Member updated successfully');
    }

    // Delete member
    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }

        if ($member->qr_code) {
            Storage::disk('public')->delete('qr-codes/' . $member->qr_code);
        }

        $member->delete();
        return redirect()->route('admin.members.index')->with('success', 'Member deleted successfully');
    }
    public function exportExcel()
    {
        return Excel::download(new MembersExport, 'members.xlsx');
    }

    /**
     * Private method to generate member card PDF and send via email
     */
    // private function generateAndEmailCard(Member $member)
    // {
    //     $pdf = Pdf::loadView('admin.members.card', [
    //         'member' => $member
    //     ]);

    //     $fileName = 'card_' . $member->id . '.pdf';
    //     $folderPath = storage_path('app/public/cards');
    //     $filePath = $folderPath . '/' . $fileName;

    //     if (!file_exists($folderPath)) {
    //         mkdir($folderPath, 0777, true);
    //     }

    //     $pdf->save($filePath);

        // Send Email
    //     if ($member->email) {
    //         Mail::to($member->email)
    //             ->send(new MemberCardMail($filePath));
    //     }
    // }

    /**
     * Manually send member card via email
     */
    // public function sendCard($id)
    // {
    //     $member = Member::findOrFail($id);

    //     try {
    //         $this->generateAndEmailCard($member);
    //         return redirect()->back()->with('success', 'Member card sent successfully.');
    //     } catch (\Exception $e) {
    //         \Log::error('Card sending failed: ' . $e->getMessage());
    //         return redirect()->back()->with('error', 'Failed to send member card.');
    //     }
    // }
}