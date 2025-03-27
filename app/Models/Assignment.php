<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'supervisor_id',
        'staff_id',
        'start_datetime',
        'end_datetime',
        'priority',
        'status',
        'due_date',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'completed_at' => 'datetime',
        'due_date' => 'date',
        'submission_notes' => 'string',
        'attachment' => 'string'
    ];

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isInProgress()
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_datetime', '>', now())
                     ->orderBy('start_datetime', 'asc');
    }

    public function scopeOverdue($query)
    {
        return $query->where('end_datetime', '<', now())
                     ->where('status', '!=', 'completed');
    }
}