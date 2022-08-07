<?php

namespace App\View\Components\User;

use App\Models\Event;
use Illuminate\View\Component;

class TotalEvent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $totalEvents = Event::where('user_id', auth()->id())->count();
        return view('components.user.total-event',compact('totalEvents'));
    }
}
