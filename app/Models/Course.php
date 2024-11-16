<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['mentor_id', 'status_id', 'thumbnail', 'title', 'slug', 'description'];

    // auto generate uuid and slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->id = str()->uuid();

            $found = true;

            while ($found) {
                $slug = str($course->title)->slug('-');

                $courseSlug = Course::where('slug', $slug)->first();

                if ($courseSlug) {
                    $slug = str($slug . '-' . str()->random(5))->slug('-');
                } else {
                    $found = false;
                }
            }

            $course->slug = $slug;
        });
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function status()
    {
        return $this->belongsTo(CourseStatus::class, 'status_id');
    }

    public function getStatusAttribute()
    {
        return $this->status ? $this->status->name : null;
    }
}
