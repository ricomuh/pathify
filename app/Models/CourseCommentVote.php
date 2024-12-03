<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCommentVote extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_comment_id', 'is_upvote'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUpvote($query)
    {
        return $query->where('is_upvote', true);
    }

    public function scopeDownvote($query)
    {
        return $query->where('is_upvote', false);
    }

    public function courseComment()
    {
        return $this->belongsTo(CourseComment::class);
    }

    public function scopeVoted($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
