<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Festival;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['customer','festival']);

        // (optioneel) kleine filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $customers = Customer::orderBy('first_name')->get();
        $festivals  = Festival::orderBy('date')->get();
        return view('bookings.create', compact('customers','festivals'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'festival_id' => 'required|exists:festivals,id',
            'seats'       => 'required|integer|min:1',
            'status'      => 'required|in:pending,confirmed,cancelled',
        ]);

        // total_price = seats * festival->price
        $festival = Festival::findOrFail($data['festival_id']);
        $data['total_price'] = $festival->price * $data['seats'];

        // simpele puntenregel: 1 punt per €10 uitgegeven (rond naar beneden)
        $data['points_awarded'] = (int) floor($data['total_price'] / 10);

        $booking = Booking::create($data);

        return redirect()->route('bookings.index')->with('success', 'Boeking aangemaakt.');
    }

    public function show(Booking $booking)
    {
        $booking->load(['customer','festival']);
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $booking->load(['customer','festival']);
        $customers = Customer::orderBy('first_name')->get();
        $festivals  = Festival::orderBy('date')->get();
        return view('bookings.edit', compact('booking','customers','festivals'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'festival_id' => 'required|exists:festivals,id',
            'seats'       => 'required|integer|min:1',
            'status'      => 'required|in:pending,confirmed,cancelled',
        ]);

        $festival = Festival::findOrFail($data['festival_id']);
        $data['total_price'] = $festival->price * $data['seats'];
        $data['points_awarded'] = (int) floor($data['total_price'] / 10);

        $booking->update($data);

        return redirect()->route('bookings.index')->with('success', 'Boeking bijgewerkt.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Boeking verwijderd.');
    }
}
