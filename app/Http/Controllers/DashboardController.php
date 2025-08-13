<?php

// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Festival;

class DashboardController extends Controller
{
    public function index()
    {
        $festivals = Festival::with('buses.bookings.customer')->get();
        $customers = \App\Models\Customer::all();
        $customerBusBookings = [];
        foreach ($customers as $customer) {
            $customerBusBookings[$customer->id] = $customer->bookings()->whereNotNull('bus_id')->exists();
        }
        return view('dashboard.index', compact('festivals', 'customers', 'customerBusBookings'));
    }
}
