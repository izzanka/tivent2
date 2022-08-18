<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id',$this->getUser()->id)->latest()->paginate(4);
        return view('user.event.index',compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'categories' => 'required',
            'location' => 'required|string',
            'important_information' => 'string',
            'start_time' => 'required',
            'start_date' => 'required|after:today',
            'images' => 'required',
            'images.*' => 'image|max:2048',
        ]);

        $images = [];

        if ($request->hasFile('images')) {
            foreach($request->file('images') as $image){
                $imageName = $image->hashName();
                $image->move('storage/img/', $imageName);
                $images[] = $imageName;
            }
        }

        $jsonImages = json_encode($images);
        $jsonCategories = json_encode($request->categories);

        try{

            $this->getUser()->events()->create([
                'name' => $request->name,
                'description' => $request->description,
                'location' => $request->location,
                'important_information' => $request->important_information,
                'start_time' => $request->start_time,
                'start_date' => $request->start_date,
                'images' => $jsonImages,
                'categories' => $jsonCategories,
            ]);
            
            return redirect()->route('events.index')->with('message', ['text' => 'Event Created Successfully!', 'class' => 'success']);

        }catch(Exception $e){
            // Log::error($e->getMessage());
            return back()->with('message', ['text' => 'Event failed to create, try again!', 'class' => 'danger']);
        }
    }

    public function detail(Event $event)
    {
        return view('user.event.detail', compact('event'));
    }
}
