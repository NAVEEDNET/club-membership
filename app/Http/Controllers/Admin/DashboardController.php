<?php
namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Carbon\Carbon;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();

        $totalMembers = Member::count();

        $activeMembers = Member::whereDate('expiry_date', '>=', $today)->count();

        $expiredMembers = Member::whereDate('expiry_date', '<', $today)->count();

        $renewedMembers = Member::where('status', 'renewed')->count();

        return view('admin.dashboard', compact(
            'totalMembers',
            'activeMembers',
            'expiredMembers',
            'renewedMembers'
        ));
    }
}