<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $fillable = ['name', 'slug', 'color'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {

            $found = true;

            while ($found) {
                $slug = str($category->name)->slug('-');

                $categorySlug = self::where('slug', $slug)->exists();

                if ($categorySlug) {
                    $slug = str($slug . '-' . str()->random(5))->slug('-');
                } else {
                    $found = false;
                }
            }

            $category->slug = $slug;
        });
    }
}
