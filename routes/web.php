<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BusController;

Route::resource('customers', CustomerController::class);
Route::get('/customers/{customer}/points', [CustomerController::class, 'points'])->name('customers.points');
Route::post('/customers/{customer}/redeem', [CustomerController::class, 'redeemPoints'])->name('customers.redeem');
Route::resource('trips', TripController::class);
Route::resource('tickets', TicketController::class);
Route::resource('festivals', FestivalController::class);
Route::resource('bookings', BookingController::class);
Route::resource('buses', BusController::class);

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('festivals', [FestivalController::class, 'index'])->name('festivals.index');
Route::resource('festivals', FestivalController::class)->except(['index']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
Route::get('/customer', function () {
    return view('customer');
});
});
