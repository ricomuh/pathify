<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = ['thumbnail', 'title', 'slug', 'body', 'start_date', 'end_date', 'location', 'registration_start_date', 'registration_end_date', 'quota', 'status', 'rundown'];

    public function casts()
    {
        return [
            'rundown' => 'array',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'registration_start_date' => 'datetime',
            'registration_end_date' => 'datetime',
        ];
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, UserEvent::class, 'event_id', 'id', 'id', 'user_id');
    }

    // generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {

            $found = true;

            while ($found) {
                $slug = str($event->title)->slug('-');

                $eventSlug = self::where('slug', $slug)->exists();

                if ($eventSlug) {
                    $slug = str($slug . '-' . str()->random(5))->slug('-');
                } else {
                    $found = false;
                }
            }

            $event->slug = $slug;
        });
    }
}
