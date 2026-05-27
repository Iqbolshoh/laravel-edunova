<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'course_id',
        'teacher_id',
        'due_date',
        'max_score',
        'status',
        'file_path',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'max_score' => 'integer',
    ];

    /**
     * Kursga bog'lanish
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * O'qituvchiga bog'lanish
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Topshiriq javoblari
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    /**
     * Foydalanuvchining javobini olish
     */
    public function getUserSubmission(int $userId)
    {
        return $this->submissions()->where('user_id', $userId)->first();
    }

    /**
     * Deadline o'tganligini tekshirish
     */
    public function isPastDue(): bool
    {
        return $this->due_date && now()->gt($this->due_date);
    }

    /**
     * Faol ekanligini tekshirish
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
