<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Supervisor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'supervisor_id',
        'name',
        'email',
        'password',
        'department',
        'phone_number',
        'profile_picture'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function approvedLeaveRequests()
    {
        return $this->hasMany(LeaveRequest::class, 'approved_by');
    }

    public function getDepartmentStaffCount()
    {
        return $this->staff()->where('department', $this->department)->count();
    }

    public function getPendingLeaveRequests()
    {
        return LeaveRequest::whereHas('staff', function($query) {
            $query->where('supervisor_id', $this->id);
        })->where('status', 'pending')->get();
    }
}