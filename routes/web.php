<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\HomeController;

use App\Models\Festival;
use App\Models\Booking;

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Home & Dashboard routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'));
Route::get('/welcome', fn() => view('welcome'));

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', function() {
    if (!Auth::check()) return redirect('/login');
    return view('auth.dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin routes (customers management)
|--------------------------------------------------------------------------
*/
Route::get('/customer-list', function() {
    $customers = \App\Models\Customer::all();
    return view('customer_list.index', compact('customers'));
})->name('customers.index');


// Customer aanmaken (admin)
Route::get('/customer-list/create', fn() => view('customer_list.create'))->name('customers.create');
Route::post('/customer-list', function(Request $request) {
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:customers,email|unique:users,email',
        'phone' => 'nullable',
        'password' => 'required|min:6',
    ]);
    // Maak klant aan
    $customer = \App\Models\Customer::create($request->only(['first_name', 'last_name', 'email', 'phone']));
    // Maak user aan zodat klant kan inloggen
    \App\Models\User::create([
        'name' => $request->first_name . ' ' . $request->last_name,
        'email' => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        'role' => 'customer',
    ]);
    return redirect()->route('customers.index')->with('success', 'Klant succesvol aangemaakt!');
})->name('customers.store');


Route::get('/customer-list/{id}/edit', function($id) {
    $customer = \App\Models\Customer::findOrFail($id);
    return view('customer_list.edit', compact('customer'));
})->name('customers.edit');

// Klant bijwerken (admin)
Route::put('/customer-list/{id}', function(Request $request, $id) {
    $customer = \App\Models\Customer::findOrFail($id);
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'phone' => 'nullable',
    ]);
    $customer->update($request->only(['first_name', 'last_name', 'email', 'phone']));
    return redirect()->route('customers.index')->with('success', 'Klant bijgewerkt!');
})->name('customers.update');


Route::get('/customer-list/{id}/points', function($id) {
    $customer = \App\Models\Customer::findOrFail($id);
    return view('customer_list.points', compact('customer'));
})->name('customers.points');

// Loyaltypunten toevoegen (admin)
Route::post('/customer-list/{id}/redeem', function(Request $request, $id) {
    $customer = \App\Models\Customer::findOrFail($id);
    $points = intval($request->input('points', 0));
    if ($points > 0) {
        $customer->loyalty_points += $points;
        $customer->save();
        return redirect()->route('customers.points', $id)->with('success', 'Punten succesvol toegevoegd!');
    }
    return redirect()->route('customers.points', $id)->with('error', 'Ongeldig aantal punten.');
})->name('customers.redeem');

Route::get('/customer-list/{id}/history', function($id) {
    $customer = \App\Models\Customer::findOrFail($id);
    $festivals = $customer->bookings()->with('festival')->get()->pluck('festival')->unique('id');
    return view('customer_list.history', compact('customer', 'festivals'));
})->name('customers.history');

Route::get('/customer-list/customer', fn() => view('customer_list.customer'));

Route::delete('/customer-list/{id}', function($id) {
    $customer = \App\Models\Customer::findOrFail($id);
    $customer->delete();
    return redirect()->route('customers.index')->with('success', 'Klant verwijderd!');
})->name('customers.destroy');

/*
|--------------------------------------------------------------------------
| Customer routes (ingelogde gebruikers)
|--------------------------------------------------------------------------
*/
Route::get('/profile', fn() => view('customer.profile'));

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

Route::get('/festival-list', function() {
    $festivals = Festival::all();
    return view('customer.festivals_list', compact('festivals'));
});

Route::get('/customers/festivals', function() {
    $festivals = \App\Models\Festival::all();
    return view('customer.festivals_list', compact('festivals'));
})->name('customer.festivals');

Route::get('/customers/festivals/{id}', function($id) {
    $festival = Festival::findOrFail($id);
    return view('customer.festival_detail', compact('festival'));
});

Route::get('/customers/tickets', function() {
    $user = Auth::user();
    if (!$user) return redirect('/login');

    $customer = \App\Models\Customer::where('email', $user->email)->first();
    $bookings = $customer ? $customer->bookings()->with(['festival', 'bus'])->get() : collect();

    $loyalty_points = $customer->loyalty_points ?? 0;
    $discount = 0;
    if ($loyalty_points >= 200) $discount = 0.5;
    elseif ($loyalty_points >= 100) $discount = 0.25;

    return view('customer.tickets', compact('bookings', 'customer', 'discount'));
});

Route::get('/customers/bookings/create', fn() => view('customer.booking_simple'));

Route::post('/customers/bookings', function(Request $request) {
    $request->validate([
        'festival_id' => 'required|exists:festivals,id',
        'seats' => 'required|integer|min:1',
    ]);

    $user = Auth::user();
    $customer = \App\Models\Customer::where('email', $user->email)->first();

    if (!$customer) {
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
    $awarded = ($discount > 0) ? 0 : intval($price / 10);

    $booking = Booking::create([
        'customer_id' => $customer->id,
        'festival_id' => $festival->id,
        'bus_id' => $bus?->id,
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

Route::get('/customer/dashboard', function() {
    $user = Auth::user();
    if (!$user) return redirect('/login');

    $customer = \App\Models\Customer::where('email', $user->email)->first();
    return view('customer.dashboard', compact('customer'));
});

/*
|--------------------------------------------------------------------------
| Resource routes
|--------------------------------------------------------------------------
*/
Route::resource('trips', TripController::class);
Route::resource('tickets', TicketController::class);
Route::resource('festivals', FestivalController::class);
Route::resource('bookings', BookingController::class);
Route::resource('buses', BusController::class);

Route::get('/about', fn() => view('about'));
Route::get('/support', function () {
    return view('support');
});
Route::get('/contact', function () {
    return view('support');
});
