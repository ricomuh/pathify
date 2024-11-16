<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    protected $fillable = ['user_id', 'course_id', 'is_favorite', 'progress', 'last_watched_at', 'completed_at'];

    protected function casts()
    {
        return [
            'is_favorite' => 'boolean',
            'progress' => 'integer',
            'last_watched_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getProggresPercentageAttribute()
    {
        // get total episode
        $totalEpisode = $this->course->contents->count();

        // calculate percentage
        $percentage = ($this->progress / $totalEpisode) * 100;

        return $percentage;
    }

    public function getCompletedAttribute()
    {
        return $this->completed_at ? true : false;
    }
}
