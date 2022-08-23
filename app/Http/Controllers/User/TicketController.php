<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function __construct(){
        $this->middleware('can:eventCrud,event')->only(['create','store','edit','update','destroy']);
    }

    public function collectionType($type)
    {
        $types = [];
        
        $ticketsCollection = collect($type);
        $types[] = $ticketsCollection->contains('type','Reguler');
        $types[] = $ticketsCollection->contains('type','One-Day Pass');
        $types[] = $ticketsCollection->contains('type','Multi-Day Pass');
        $types[] = $ticketsCollection->contains('type','VIP');

        return [collect($types), $types];
    }

    public function create(Event $event)
    {   
        $checkType = $this->collectionType($event->tickets);
        $types = $checkType[1];

        if($checkType[0]->doesntContain(false)){
            return back()->with('message', ['text' => 'All type of tickets already created!', 'class' => 'warning']);
        }

        return view('user.ticket.create', compact('event','types'));
    }

    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'description' => 'max:125',
            'price' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);

        try {

            $event->tickets()->create($validated);
            return redirect()->route('events.show', $event)->with('message', ['text' => 'Ticket created successfully!', 'class' => 'success']);

        } catch (\Exception $e) {

            return back()->with('message', ['text' => 'Ticket failed to create!', 'class' => 'danger']);

        }
    }

    public function edit(Event $event, Ticket $ticket)
    {
        return view('user.ticket.edit', compact('event','ticket'));
    }

    public function update(Request $request, Event $event, Ticket $ticket)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'description' => 'max:125',
            'price' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);

        try {

            $event->tickets()->update($validated);
            return redirect()->route('events.show', $event)->with('message', ['text' => 'Ticket updated successfully!', 'class' => 'success']);

        } catch (\Exception $e) {

            return back()->with('message', ['text' => 'Ticket failed to update!', 'class' => 'danger']);

        }
    }

    public function destroy(Event $event, Ticket $ticket)
    {
        try {

            $ticket->delete();

            return redirect()->route('events.show', $event)->with('message', ['text' => 'Ticket deleted successfully!', 'class' => 'success']);

        } catch (\Exception $e) {

            return back()->with('message', ['text' => 'Ticket failed to delete!', 'class' => 'danger']);

        }
    }
}
