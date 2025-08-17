<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Festival;

class DashboardController extends Controller
{
    public function index()
    {
        $festivals = Festival::with(['buses.bookings' => function($q) {
            $q->where('status', '!=', 'Geannuleerd');
        }, 'buses.bookings.customer', 'bookings'])->get();

        foreach ($festivals as $festival) {
            // Boekingen die niet geannuleerd zijn
            $festival->active_bookings_count = $festival->bookings->where('status', '!=', 'Geannuleerd')->sum('seats');
            $festival->available_seats = $festival->max_capacity - $festival->active_bookings_count;
        }

        $customers = \App\Models\Customer::all();
        $customerBusBookings = [];
        foreach ($customers as $customer) {
            $customerBusBookings[$customer->id] = $customer->bookings()->whereNotNull('bus_id')->exists();
        }
        return view('dashboard.index', compact('festivals', 'customers', 'customerBusBookings'));
    }
}
