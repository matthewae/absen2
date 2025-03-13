<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkProgress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'work_progress';

    protected $fillable = [
        'staff_id',
        'project_topic',
        'company_name',
        'work_description',
        'title',
        'description',
        'status',
        'feedback'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(WorkProgressFile::class);
    }
}