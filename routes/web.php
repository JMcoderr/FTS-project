<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TicketController;

Route::resource('customers', CustomerController::class);
Route::resource('trips', TripController::class);
Route::resource('tickets', TicketController::class);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
Route::get('/customer', function () {
    return view('customer');
});
});
