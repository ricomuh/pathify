<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSubmission extends Model
{
    /** @use HasFactory<\Database\Factories\CourseSubmissionFactory> */
    use HasFactory;

    public $fillable = ['title', 'body', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function userCourseSubmissions()
    {
        return $this->hasOne(UserCourseSubmission::class)->latestOfMany();
    }
}
