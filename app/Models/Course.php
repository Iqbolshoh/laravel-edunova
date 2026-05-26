<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'image',
        'teacher_id',
        'status',
        'price',
        'duration',
        'students_count',
    ];

    protected $casts = [
        'status' => 'string',
        'price' => 'integer',
        'duration' => 'integer',
        'students_count' => 'integer',
    ];

    // O'qituvchi
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // O'quvchilar
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')
            ->withPivot('progress', 'completed')
            ->withTimestamps();
    }

    // Vazifalar
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
