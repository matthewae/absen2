<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'check_in',
        'check_out',
        'status',
        'work_progress',
        'is_work_submitted',
        'location'
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'is_work_submitted' => 'boolean'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function canCheckOut()
    {
        return $this->is_work_submitted && !$this->check_out;
    }

    public function scopeToday($query)
    {
        return $query->whereDate('check_in', today());
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('check_in', now()->month)
                        ->whereYear('check_in', now()->year);
    }

    public function getWorkDurationAttribute()
    {
        if (!$this->check_out) {
            return null;
        }
        return $this->check_in->diffInHours($this->check_out);
    }
}