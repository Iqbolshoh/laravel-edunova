<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'video_url',
        'file_path',
        'duration',
        'order',
        'status',
    ];

    protected $casts = [
        'duration' => 'integer',
        'order'    => 'integer',
    ];

    // Kurs
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
