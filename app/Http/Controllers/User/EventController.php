<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\City;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function __construct(){
        $this->middleware('can:eventCrud,event')->only(['edit','update','delete']);
    }

    public function storeImage($image)
    {
        $imageName = $image->hashName();
        $image->move('storage/img/', $imageName);
        return $imageName;
    }

    public function getCity($provinceId)
    {
        $cities = City::select('name','id')->where('province_id',$provinceId)->pluck('name','id');
        return json_encode($cities);
    }

    public function index()
    {
        $events = Event::where('user_id',auth()->user()->id)->latest()->paginate(4);
        return view('user.event.index',compact('events'));
    }

    public function create()
    {
        $categories = Category::select('name')->get();
        $provinces = Province::select('id','name')->get();
        $cities = City::select('id','province_id','name')->get();
        return view('user.event.create', compact('categories','provinces','cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'categories' => 'required',
            'province_id' => 'string|required',
            'city_id' => 'string|required',
            'address' => 'required|string',
            'information' => 'string',
            'start_time' => 'required',
            'start_date' => 'required|after:today',
            'images' => 'required',
            'images.*' => 'image|max:2048',
        ]);

        $images = [];

        if ($request->hasFile('images')) {
            foreach($request->file('images') as $image){
               $images[] = $this->storeImage($image);
            }
        }

        dd($request->categories);

        $jsonImages = json_encode($images);
        $jsonCategories = json_encode($request->categories);

        try{

            auth()->user()->events()->create([
                'name' => $request->name,
                'description' => $request->description,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'information' => $request->information,
                'start_time' => $request->start_time,
                'start_date' => $request->start_date,
                'images' => $jsonImages,
                'categories' => $jsonCategories,
            ]);
            
            return redirect()->route('events.index')->with('message', ['text' => 'Event Created Successfully!', 'class' => 'success']);

        }catch(Exception $e){
            return back()->with('message', ['text' => 'Event failed to create, try again!', 'class' => 'danger']);
        }
    }

    public function show(Event $event)
    {
        $categories = json_decode($event->categories);
        return view('user.event.show', compact('event','categories'));
    }

    public function edit(Event $event)
    {
        $categories = json_decode($event->categories);
        $categoriesName = Category::select('name')->get();

        return view('user.event.edit', compact('event','categories','categoriesName'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required',
            'categories' => 'required',
            'province_id' => 'required|string',
            'city_id' => 'required|string',
            'address' => 'required|string',
            'information' => 'string',
            'start_time' => 'required',
            'start_date' => 'required|after:today',
            'images' => '',
            'images.*' => 'image|max:2048',
        ]);

        $images = [];

        if ($request->hasFile('images')) {
            
            foreach($request->file('images') as $image){
               $images[] = $this->storeImage($image);
            }

            $currentImages = json_decode($event->images);

            foreach ($currentImages as $image) {
                File::delete('storage/img/' . $image);
            }
        }

        $jsonImages = json_encode($images);
        $jsonCategories = json_encode($request->categories);

        try{

            $event->update([
                'name' => $request->name,
                'description' => $request->description,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'information' => $request->information,
                'start_time' => $request->start_time,
                'start_date' => $request->start_date,
                'images' => $images ? $jsonImages : $event->images,
                'categories' => $jsonCategories,
            ]);
            
            return redirect()->route('events.index')->with('message', ['text' => 'Event updated successfully!', 'class' => 'success']);

        }catch(Exception $e){
            // Log::error($e->getMessage());
            return back()->with('message', ['text' => 'Event failed to update, try again!', 'class' => 'danger']);
        }
    }

    public function destroy(Event $event)
    {
        $images = json_decode($event->images);

        try {
            
            foreach ($images as $image) {
                File::delete('storage/img/' . $image);
            }

            foreach($event->tickets as $ticket){
                $ticket->delete();
            }

            $event->delete();

            return back()->with('message',['text' => 'Event successfully deleted!', 'class' => 'success']);

        } catch (Exception $e) {
            return back()->with('message', ['text' => 'Event failed to delete, try again!', 'class' => 'danger']);
        }
    }

}
