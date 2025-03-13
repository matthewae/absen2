<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkProgress extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'staff_id',
        'project_topic',
        'company_name',
        'work_description',
        'status'
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