<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        'event_category_id',
        'thumbnail',
        'title',
        'slug',
        'body',
        'start_date',
        'end_date',
        'is_online',
        'platform',
        'link',
        'location_name',
        'location_address',
        'registration_start_date',
        'registration_end_date',
        'quota',
        'status',
        'rundown',
        'faqs',
    ];

    public function casts()
    {
        return [
            'rundown' => 'array',
            'faqs' => 'array',
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

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
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

    // scope for published only
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // get the seats left
    public function getSeatsLeftAttribute()
    {
        return $this->quota - $this->users_count;
    }
}
