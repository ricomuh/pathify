<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseComment extends Model
{
    /** @use HasFactory<\Database\Factories\CourseCommentFactory> */
    use HasFactory;

    protected $fillable = ['course_id', 'user_id', 'course_content_id', 'parent_id', 'body'];
}
