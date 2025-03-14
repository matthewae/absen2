<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'staff_id',
        'name',
        'email',
        'password',
        'position',
        'department',
        'phone_number',
        'profile_picture',
        'supervisor_id',
        'birth_date',
        'photo_url'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function workProgress()
    {
        return $this->hasMany(WorkProgress::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function latestAttendance()
    {
        return $this->hasOne(Attendance::class)->latest();
    }
}