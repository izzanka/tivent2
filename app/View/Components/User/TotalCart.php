<?php

namespace App\View\Components\User;

use App\Models\Order;
use Illuminate\View\Component;

class TotalCart extends Component
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
        $totalOrder = Order::where('user_id', auth()->id())->count();
        return view('components.user.total-cart', compact('totalOrder'));
    }
}
