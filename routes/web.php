<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FestivalController;

Route::resource('customers', CustomerController::class);
Route::resource('trips', TripController::class);
Route::resource('tickets', TicketController::class);
Route::resource('festivals', FestivalController::class);

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
Route::get('/customer', function () {
    return view('customer');
});
});
