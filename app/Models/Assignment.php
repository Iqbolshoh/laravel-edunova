<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'status' => 'string',
    ];

    // Kurs
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // O'qituvchi
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Topshiriq javoblari
    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
