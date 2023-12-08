<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('register');

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [App\Http\Controllers\AuthController::class, 'me'])->name('me');
});

Route::group([

//    'middleware' => 'api',
    'prefix' => 'event'

], function ($router) {

    Route::post('create', [App\Http\Controllers\EventController::class, 'create'])->name('create');
    Route::put('update', [App\Http\Controllers\EventController::class, 'update'])->name('update');
    Route::delete('delete', [App\Http\Controllers\EventController::class, 'delete'])->name('delete');
    Route::get('get-all', [App\Http\Controllers\EventController::class, 'getAll'])->name('get-all');
    Route::get('get-by-proprietor', [App\Http\Controllers\EventController::class, 'getByProprietor'])->name('get-by-proprietor');
    Route::get('get-by-address', [App\Http\Controllers\EventController::class, 'getByAddress'])->name('get-by-address');
    Route::get('get-by-date', [App\Http\Controllers\EventController::class, 'getByDate'])->name('get-by-date');
    Route::get('get-by-name', [App\Http\Controllers\EventController::class, 'getByName'])->name('get-by-name');
    Route::get('{id}', [App\Http\Controllers\EventController::class, 'getById'])->name('get-by-id');
});

Route::group([
    'prefix' => 'reservation'
    ], function ($router) {
        Route::post('checkout', [App\Http\Controllers\ReservationController::class, 'create'])->name('create');
        Route::put('update', [App\Http\Controllers\ReservationController::class, 'update'])->name('update');
        Route::delete('delete', [App\Http\Controllers\ReservationController::class, 'delete'])->name('delete');
        Route::get('get-all', [App\Http\Controllers\ReservationController::class, 'getAll'])->name('get-all');
        Route::get('get-by-user', [App\Http\Controllers\ReservationController::class, 'getByUser'])->name('get-by-user');
        Route::get('get-by-event', [App\Http\Controllers\ReservationController::class, 'getByEvent'])->name('get-by-event');
        Route::get('get-by-date', [App\Http\Controllers\ReservationController::class, 'getByDate'])->name('get-by-date');
        Route::get('get-by-name', [App\Http\Controllers\ReservationController::class, 'getByName'])->name('get-by-name');
        Route::get('{id}', [App\Http\Controllers\ReservationController::class, 'getById'])->name('get-by-id');
});
