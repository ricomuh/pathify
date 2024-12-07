<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    //
    public function index()
    {
        $events = Event::select('id', 'thumbnail', 'title', 'slug', 'quota')
            ->latest()
            ->withCount('users')
            // ->whereDate('registration_end_date', '>=', now())
            ->paginate(10);

        $events->getCollection()->transform(function ($event) {
            $event->isJoined = UserEvent::where('user_id', auth()->id())
                ->where('event_id', $event->id)
                ->exists();

            $event->seats_left = $event->quota - $event->users_count;

            return $event;
        });

        return response()->json(compact('events'));

        return Inertia::render('EventPage/ListEvent');
    }

    public function show(Event $event)
    {
        $event->loadCount('users')->get();

        $isJoined = UserEvent::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->exists();

        $event->seats_left = $event->quota - $event->users_count;

        return response()->json(compact('event', 'isJoined'));
    }
}
