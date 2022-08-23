<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\EventController;
use App\Http\Controllers\User\TicketController;

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
        Route::get('/home','index')->name('home');
    });

    //Profile
    Route::view('/profile','user.profile.index')->name('profile.index');
    
    Route::group(['middleware' => ['can:isUser,App\Models\User']], function(){

        //Event
        Route::resource('events', EventController::class);
  
        //Ticket
        Route::controller(TicketController::class)->group(function(){
            Route::get('/events/{event}/tickets/create', 'create')->name('tickets.create');
            Route::post('/events/{event}/tickets', 'store')->name('tickets.store');
            Route::get('/events/{event}/tickets/{ticket}/edit', 'edit')->name('tickets.edit');
            Route::put('/events/{event}/tickets/{ticket}', 'update')->name('tickets.update');
            Route::delete('/events/{event}/tickets/{ticket}', 'destroy')->name('tickets.destroy');
        });
    });
   
});
