<?php

namespace App\Models;

use App\Enums\CourseLevelEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = ['mentor_id', 'status_id', 'thumbnail', 'title', 'slug', 'description', 'level'];

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

    // public function casts()
    // {
    //     return [
    //         'level' => CourseLevelEnum::class,
    //     ];
    // }

    // public function getLevelNameAttribute()
    // {
    //     return match ($this->level) {
    //         1 => 'Beginner',
    //         2 => 'Intermediate',
    //         3 => 'Advanced',
    //         default => 'Beginner',
    //     };
    // }

    // mentor
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

    // categories
    public function categories()
    {
        // from course_categories and then categories
        return $this->belongsToMany(Category::class, 'course_categories', 'course_id', 'category_id');
        // return $this->belongsToMany(CourseCategory::class, 'course_categories', 'course_id', 'category_id');
    }

    // contents
    public function contents()
    {
        return $this->hasMany(CourseContent::class);
    }

    // users
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses', 'course_id', 'user_id');
    }
}
