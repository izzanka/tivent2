<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUser()
    {
        return auth()->user();
    }

    public function redirect($route, $text, $class)
    {
        if(!$route){
            return back()->with('message', ['text' => $text, 'class' => $class]);
        }

        return redirect()->route($route)->with('message', ['text' => $text, 'class' => $class]);
    }
}
