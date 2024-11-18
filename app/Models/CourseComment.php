<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseComment extends Model
{
    /** @use HasFactory<\Database\Factories\CourseCommentFactory> */
    use HasFactory;

    protected $fillable = ['course_id', 'user_id', 'course_content_id', 'parent_id', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseContent()
    {
        return $this->belongsTo(CourseContent::class);
    }

    public function parent()
    {
        return $this->belongsTo(CourseComment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CourseComment::class, 'parent_id');
    }

    public function votes()
    {
        return $this->hasMany(CourseCommentVote::class);
    }

    public function upvotes()
    {
        return $this->votes()->upvote();
    }

    public function downvotes()
    {
        return $this->votes()->downvote();
    }

    public function scopeVoted($query, $userId)
    {
        return $query->whereHas('votes', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });
    }
}
