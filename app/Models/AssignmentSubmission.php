<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentSubmission extends Model
{
    protected $fillable = [
        'assignment_id',
        'user_id',
        'content',
        'file_path',
        'file_name',
        'submission_type',
        'score',
        'feedback',
        'status',
        'submitted_at',
        'graded_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'graded_at' => 'datetime',
        'score' => 'integer',
    ];

    /**
     * Vazifaga bog'lanish
     */
    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    /**
     * O'quvchiga bog'lanish
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Baholanganligini tekshirish
     */
    public function isGraded(): bool
    {
        return $this->status === 'graded';
    }

    /**
     * Yuborilganligini tekshirish
     */
    public function isSubmitted(): bool
    {
        return $this->status === 'submitted';
    }

    /**
     * Fayl hajmini formatlash
     */
    public function getFileSizeAttribute(): string
    {
        if (!$this->file_path || !Storage::disk('public')->exists($this->file_path)) {
            return '0 KB';
        }

        $size = Storage::disk('public')->size($this->file_path);

        if ($size < 1024) {
            return $size . ' B';
        } elseif ($size < 1048576) {
            return round($size / 1024, 2) . ' KB';
        } else {
            return round($size / 1048576, 2) . ' MB';
        }
    }
}
