<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContentGroup extends Model
{
    /** @use HasFactory<\Database\Factories\CourseContentGroupFactory> */
    use HasFactory;

    protected $fillable = ['course_id', 'order', 'title'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function contents()
    {
        return $this->hasMany(CourseContent::class, 'group_id');
    }
}
