<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::parentOnly()->get();

        $events = Event::latest()->limit(5)->with('category')->get();

        return inertia('Home', [
            'categories' => $categories,
            'events' => $events,
        ]);
    }
}