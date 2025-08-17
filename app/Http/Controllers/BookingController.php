<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Festival;
use App\Services\BusService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Verwijder een boeking
    public function destroy($id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Boeking verwijderd!');
    }

    protected $busService;

    public function __construct(BusService $busService)
    {
        $this->busService = $busService;
    }

    // Lijst van alle boekingen
    public function index()
    {
        $bookings = Booking::with(['customer', 'festival', 'bus'])->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    // Maak een nieuwe boeking
    public function create()
    {
    $festivals = Festival::all();
    $customers = \App\Models\Customer::all();
    return view('bookings.create', compact('festivals', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'festival_id' => 'required|exists:festivals,id',
            'seats' => 'required|integer|min:1',
        ]);

        $festival = \App\Models\Festival::findOrFail($request->festival_id);
        $seats = (int)$request->seats;
        $total_price = $seats * ($festival->price ?? 0);
        $points_awarded = (int)($total_price / 10); // 1 punt per €10

        $booking = Booking::create([
            'customer_id' => $request->customer_id,
            'festival_id' => $request->festival_id,
            'seats' => $seats,
            'total_price' => $total_price,
            'points_awarded' => $points_awarded,
            'status' => 'Bevestigd',
            'booked_at' => now(),
        ]);

        // Assign a bus to the booking for the selected festival
        $bus = \App\Models\Bus::where('festival_id', $request->festival_id)->first();
        if ($bus) {
            $booking->bus_id = $bus->id;
            $booking->save();
        }

        // Award points to customer
        $customer = \App\Models\Customer::find($request->customer_id);
        $customer->loyalty_points = ($customer->loyalty_points ?? 0) + $points_awarded;
        $customer->save();

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Boeking aangemaakt! Totaal prijs: €' . number_format($total_price, 2) . '. Punten toegekend: ' . $points_awarded);
    }

    // Toon details van een specifieke boeking
    public function show($id)
    {
        $booking = \App\Models\Booking::with(['customer', 'festival', 'bus'])->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    // Bewerk een bestaande boeking
    public function edit($id)
    {
        $booking = \App\Models\Booking::with(['customer', 'festival', 'bus'])->findOrFail($id);
        $festivals = \App\Models\Festival::all();
        $customers = \App\Models\Customer::all();
        return view('bookings.edit', compact('booking', 'festivals', 'customers'));
    }

    // Werk een bestaande boeking bij
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'festival_id' => 'required|exists:festivals,id',
            'seats' => 'required|integer|min:1',
            'status' => 'required|in:Bevestigd,Geannuleerd',
        ]);

        $booking = \App\Models\Booking::findOrFail($id);
        $oldStatus = $booking->status;
        $booking->update($request->all());

        // Remove points if cancelled
        if ($request->status === 'Geannuleerd' && $oldStatus !== 'Geannuleerd') {
            $customer = \App\Models\Customer::find($booking->customer_id);
            $customer->loyalty_points = max(0, ($customer->loyalty_points ?? 0) - ($booking->points_awarded ?? 0));
            $customer->save();
        }

        // (optioneel) Bus toewijzen na update
        $festival = \App\Models\Festival::find($request->festival_id);
        $this->busService::assignBuses($festival);

        return redirect()->route('bookings.index')->with('success', 'Boeking bijgewerkt!');
    }
}
