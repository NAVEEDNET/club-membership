<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;

class MembersExport implements FromCollection
{
    public function collection()
    {
        return Member::select(
            'member_id',
            'full_name',
            'nic',
            'phone',
            'email',
            'address',
            'membership_type',
            'start_date',
            'expiry_date',
            'status'
        )->get();
    }
}