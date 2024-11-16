<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseStatus extends Model
{
    protected $fillable = ['name', 'color'];

    public $timestamps = false;

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
