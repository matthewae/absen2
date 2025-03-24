<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkProgress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'work_progress';

    protected $fillable = [
        'staff_id',
        'work_progress_id',
        'company_name',
        'project_topic',
        'work_description',
        'status',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'file_size' => 'integer'
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function files()
    {
        return $this->hasMany(WorkProgressFile::class);
    }

    public function parentProgress()
    {
        return $this->belongsTo(WorkProgress::class, 'work_progress_id');
    }

    public function childProgress()
    {
        return $this->hasMany(WorkProgress::class, 'work_progress_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}