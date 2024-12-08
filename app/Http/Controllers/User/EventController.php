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
        $events = Event::select('id', 'thumbnail', 'title', 'slug', 'quota', 'start_date', 'event_category_id')
            ->latest()
            ->with('category')
            ->withCount('users')
            ->when(request('search'), function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            // ->whereDate('registration_end_date', '>=', now())
            ->paginate(10);

        $events->getCollection()->transform(function ($event) {
            $event->isJoined = UserEvent::where('user_id', auth()->id())
                ->where('event_id', $event->id)
                ->exists();

            $event->seats_left = $event->quota - $event->users_count;

            return $event;
        });

        // return response()->json(compact('events'));

        return Inertia::render('EventPage/ListEvent', compact('events'));
    }

    public function show(Event $event)
    {
        $event
            ->load('category')
            ->loadCount('users')->get();

        $isJoined = UserEvent::where('user_id', auth()->id())
            ->where('event_id', $event->id)
            ->exists();

        $event->seats_left = $event->quota - $event->users_count;

        // return response()->json(compact('event', 'isJoined'));
        return Inertia::render('EventPage/DetailEvent', compact('event', 'isJoined'));
    }
}
