<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    /** @use HasFactory<\Database\Factories\CourseContentFactory> */
    use HasFactory;

    protected $fillable = [
        'course_id',
        'group_id',
        'title',
        'description',
        'body',
        'view_count',
        'order'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function comments()
    {
        return $this->hasMany(CourseComment::class);
    }

    public function group()
    {
        return $this->belongsTo(CourseContentGroup::class);
    }
}
