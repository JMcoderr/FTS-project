<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\AuthController;
use App\Models\Festival;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Admin-only routes
Route::get('/customers', function() {
    $festivals = Festival::all();
    return view('customer.festivals_list', compact('festivals'));
});
Route::resource('trips', TripController::class);
Route::resource('tickets', TicketController::class);
Route::resource('festivals', FestivalController::class);
Route::resource('bookings', BookingController::class);
Route::resource('buses', BusController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Klant-only routes
Route::get('/profile', function() {
    return view('customer.profile');
});
Route::get('/customers/festivals', function() {
    $festivals = Festival::all();
    return view('customer.festivals_list', compact('festivals'));
});
Route::get('/customers/festivals/{id}', function($id) {
    $festival = Festival::findOrFail($id);
    return view('customer.festival_detail', compact('festival'));
});
// Mijn tickets voor ingelogde klant
Route::get('/customers/tickets', function() {
    $user = Auth::user();
    if (!$user) return redirect('/login');
    $customer = \App\Models\Customer::where('email', $user->email)->first();
    $bookings = $customer ? $customer->bookings()->with(['festival', 'bus'])->get() : collect();
    // Loyalty reward berekening
    $loyalty_points = $customer->loyalty_points ?? 0;
    $discount = 0;
    if ($loyalty_points >= 200) $discount = 0.5;
    elseif ($loyalty_points >= 100) $discount = 0.25;
    return view('customer.tickets', compact('bookings', 'customer', 'discount'));
});
Route::get('/customers/bookings/create', function() {
    return view('customer.booking_simple');
});
Route::post('/customers/bookings', function(Request $request) {
    $request->validate([
        'festival_id' => 'required|exists:festivals,id',
        'seats' => 'required|integer|min:1',
    ]);
    $user = Auth::user();
    // Probeer bijbehorende customer record te vinden
    $customer = \App\Models\Customer::where('email', $user->email)->first();
    if (!$customer) {
        // Maak een customer aan als die nog niet bestaat
        $customer = \App\Models\Customer::create([
            'first_name' => $user->name,
            'last_name' => '',
            'email' => $user->email,
            'phone' => '',
        ]);
    }
    $festival = \App\Models\Festival::find($request->festival_id);
    $bus = \App\Models\Bus::where('festival_id', $festival->id)->first();
    $seat_type = $request->seat_type ?? 'standaard';
    $remarks = $request->remarks ?? '';
    $loyalty_points = $customer->loyalty_points ?? 0;
    $korting = intval($request->input('loyalty_points', 0));
    $discount = 0;
    if ($korting == 200 && $loyalty_points >= 200) {
        $discount = 0.5;
        $customer->loyalty_points -= 200;
    } elseif ($korting == 100 && $loyalty_points >= 100) {
        $discount = 0.25;
        $customer->loyalty_points -= 100;
    }
    $price = $festival->price * $request->seats * (1 - $discount);
    $awarded = ($discount > 0) ? 0 : intval($price / 10); // Geen punten als korting gebruikt
    $booking = \App\Models\Booking::create([
        'customer_id' => $customer->id,
        'festival_id' => $festival->id,
        'bus_id' => $bus ? $bus->id : null,
        'seats' => $request->seats,
        'seat_type' => $seat_type,
        'status' => 'pending',
        'total_price' => $price,
        'booked_at' => now(),
        'points_awarded' => $awarded,
        'remarks' => $remarks,
    ]);
    $customer->loyalty_points += $awarded;
    $customer->save();
    return redirect('/customers/tickets')->with('success', 'Boeking succesvol!');
});
Route::post('/profile/update', function(Request $request) {
    $user = Auth::user();
    $request->validate([
        'name' => 'required',
        'password' => 'nullable|min:6',
    ]);
    $user->name = $request->name;
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }
    $user->save();
    return redirect('/profile')->with('success', 'Profiel bijgewerkt!');
});

// Dashboard na inloggen
Route::get('/dashboard', function() {
    if (!Auth::check()) return redirect('/login');
    return view('auth.dashboard');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/welcome', function() {
    return view('welcome');
});;

// Klant dashboard
Route::get('/customer/dashboard', function() {
    $user = Auth::user();
    if (!$user) return redirect('/login');
    $customer = \App\Models\Customer::where('email', $user->email)->first();
    return view('customer.dashboard', compact('customer'));
});