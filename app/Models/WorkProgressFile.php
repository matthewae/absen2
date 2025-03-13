<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkProgressFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'work_progress_id',
        'filename',
        'file_path',
        'file_type',
        'file_size'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function workProgress(): BelongsTo
    {
        return $this->belongsTo(WorkProgress::class);
    }
}