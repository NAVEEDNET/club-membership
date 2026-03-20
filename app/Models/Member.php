<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'full_name',
        'nic',
        'date_of_birth',
        'membership_type',
        'email',
        'phone',
        'address',
        'photo',
        'start_date',
        'expiry_date',
        'status',
        'qr_code',
    ];
    public static function expireExpiredMembers()
    {
        self::whereDate('expiry_date', '<', now())
            ->update(['status' => 'expired']);
    }

    public function renewMembership()
    {
        $this->expiry_date = now()->addYear();
        $this->status = 'renewed';
        $this->save();
    }
}