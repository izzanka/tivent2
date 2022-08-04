<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::latest()->where('status',5)->paginate(4);
        return view('home');
    }
}
