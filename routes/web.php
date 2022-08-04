<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['auth']], function(){

    //Home
    Route::controller(HomeController::class)->group(function(){
        Route::get('/','index');
        Route::get('/home','index');
    });
    
    //Event
    Route::get('/event/{event}/detail',[EventController::class,'detail'])->name('event.detail');
});
