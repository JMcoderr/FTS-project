<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Festival;
use App\Services\BusService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
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
        ]);

        $booking = Booking::create($request->all());

        // Assign a bus to the booking for the selected festival
        $bus = \App\Models\Bus::where('festival_id', $request->festival_id)->first();
        if ($bus) {
            $booking->bus_id = $bus->id;
            $booking->save();
        }

        return redirect()->route('bookings.index')->with('success', 'Boeking aangemaakt en bus toegewezen!');
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
        ]);

        $booking = \App\Models\Booking::findOrFail($id);
        $booking->update($request->all());

        // (optioneel) Bus toewijzen na update
        $festival = \App\Models\Festival::find($request->festival_id);
        $this->busService::assignBuses($festival);

        return redirect()->route('bookings.index')->with('success', 'Boeking bijgewerkt!');
    }
}
