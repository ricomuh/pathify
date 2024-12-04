<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseSubmission extends Model
{
    /** @use HasFactory<\Database\Factories\UserCourseSubmissionFactory> */
    use HasFactory;

    public $fillable = ['file_path', 'status', 'user_id', 'course_id', 'course_submission_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseSubmission()
    {
        return $this->belongsTo(CourseSubmission::class);
    }
}
