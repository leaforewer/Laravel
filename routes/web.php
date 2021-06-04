<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Hash;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', function() {
    $hash = Hash::make('black-saber');
    var_dump($hash);
    var_dump(Hash::check('black-saber', $hash));
    var_dump(Hash::needsRehash($hash));
    $oldHash = Hash::make('black-saber', ['rounds' => 5]);
    var_dump($oldHash);
    var_dump(Hash::needsRehash($oldHash));
    var_dump(Hash::make('black-saber'));
    
})->middleware('verified');

// Route::get('/rooms/{roomType?}', [\App\Http\Controllers\ShowRoomsController::class, '__invoke'])
//     ->where('name', '[A-Za-z]+');

Route::get('/rooms/{roomType?}', '\App\Http\Controllers\ShowRoomsController');

Route::get('bookings', [App\Http\Controllers\BookingController::class])->name('bookings');

Route::resource('/bookings','\App\Http\Controllers\BookingController');

Route::get('/rooms', 'App\Http\Controllers\ShowRoomsController')->name('rooms');

Route::resource('/room_types','\App\Http\Controllers\RoomTypeController');