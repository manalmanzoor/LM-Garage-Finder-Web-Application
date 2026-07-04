<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*//*
|--------------------------------------------------------------------------
| Default Route
|-use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home', [GarageController::class, 'index'])->name('home');
    
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::view('/profile', 'profile')->name('profile');

    Route::get('/garages', [GarageController::class, 'index'])->name('garages.index');

    Route::get('/garages/create', [GarageController::class, 'create'])
        ->name('garages.create');

Route::post('/garages/store', [GarageController::class, 'store'])
    ->name('garages.store');
    Route::get('/services/create', [ServiceController::class, 'create'])
        ->name('services.create');
Route::get('/garages/{garage}/edit', [GarageController::class, 'edit'])
    ->name('garages.edit');
    Route::delete('/garages/{garage}', [GarageController::class, 'destroy'])
    ->name('garages.destroy');

Route::delete('/services/{service}', [ServiceController::class, 'destroy'])
    ->name('services.destroy')
    ->middleware('auth');

Route::put('/garages/{garage}', [GarageController::class, 'update'])
    ->name('garages.update');

    Route::post('/services', [ServiceController::class, 'store'])
        ->name('services.store');

    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])
        ->name('services.destroy');

   Route::get('/bookings', [BookingController::class, 'index'])
    ->name('bookings.index');


    Route::post('/bookings', [BookingController::class, 'store'])
        ->name('bookings.store');
      Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])
    ->name('bookings.destroy');

});

 
/*
|--------------------------------------------------------------------------
| Garage Public Pages (ORDER MATTERS)
|--------------------------------------------------------------------------
*/

// MUST BE FIRST
Route::get('/garages/{garage}/services', [ServiceController::class, 'show'])
    ->name('services.show');

// MUST BE LAST
Route::get('/garages/{garage}', [GarageController::class, 'show'])
    ->name('garages.show');
Route::post('/orders/{id}/status', [BookingController::class, 'updateStatus'])->name('orders.updateStatus');