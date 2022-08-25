<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::latest()->where('status',0)->whereHas('tickets')->paginate(4);
        return view('home',compact('events'));
    }
}
