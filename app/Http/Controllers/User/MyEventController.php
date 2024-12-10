<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MyEventController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $userEvents = UserEvent::where('user_id', $user->id)->get();

        $events = Event::select('id', 'thumbnail', 'title', 'slug', 'quota', 'start_date', 'event_category_id')
            ->whereIn('id', $userEvents->pluck('event_id'))
            ->latest()
            ->with('category')
            ->withCount('users')
            // ->paginate(10);
            ->get();

        $events->transform(function ($event) {
            $event->isJoined = UserEvent::where('user_id', auth()->id())
                ->where('event_id', $event->id)
                ->exists();

            $event->seats_left = $event->quota - $event->users_count;

            return $event;
        });

        // return response()->json(compact('events'));
        return Inertia::render('EventPage/MyEvent', compact('events'));
    }
}