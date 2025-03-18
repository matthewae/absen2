<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkProgressFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_progress_id',
        'original_name',
        'file_path',
        'mime_type',
        'file_size'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function workProgress(): BelongsTo
    {
        return $this->belongsTo(WorkProgress::class);
    }
}