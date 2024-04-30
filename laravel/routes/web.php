<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/informasi', function () {
    return view('informasi');
});

// Route::get(url:'test', function() {
//     $recipient = auth()->user();

//     \Filament\Notifications\Notification::make()
//     ->title(title:'Sending test notification')
//     ->sendToDatabase($recipient);

//     dd('done sending');
// })->middleware(middleware:'auth');

