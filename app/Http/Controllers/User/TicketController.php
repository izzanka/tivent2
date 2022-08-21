<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
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
            return back()->with('message', ['text' => 'All Type Of Ticket Already Created!', 'class' => 'warning']);
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

        $checkType = $this->collectionType($event->tickets);
        
        if($checkType->contains($request->type)){
            return back()->with('message', ['text' => ' ' . $type .'  Ticket Already Created!', 'class' => 'warning']);
        }

        try {

            $event->tickets()->create($validated);
            return redirect()->route('events.show', $event)->with('message', ['text' => 'Ticket created successfully!', 'class' => 'success']);

        } catch (Exception $e) {

            return back()->with('message', ['text' => 'Ticket failed to create!', 'class' => 'danger']);

        }
    }

    public function edit(Event $event, Ticket $ticket)
    {
        return view('user.ticket.edit', compact('event','ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {

    }

    public function destroy(Ticket $ticket)
    {

    }
}
