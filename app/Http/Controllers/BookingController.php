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

        // Genereer vaste stoelnummers
        $seatNumbers = [];
        $festivalBuses = \App\Models\Bus::where('festival_id', $festival->id)->orderBy('id')->get();
        $seatsToAssign = $seats;
        $busNumber = $festivalBuses->count() + 1;
        $bus = null;
        while ($seatsToAssign > 0) {
            $bus = $festivalBuses->last();
            $busCapacity = $bus ? $bus->capacity : null;
            $bookedSeats = $bus ? \App\Models\Booking::where('bus_id', $bus->id)->where('status', 'Bevestigd')->sum('seats') : 0;
            $freeSeats = $bus ? ($busCapacity - $bookedSeats) : 0;
            if (!$bus || $freeSeats <= 0) {
                $possibleSizes = range(50, 150, 25);
                $busCapacity = $possibleSizes[array_rand($possibleSizes)];
                // Genereer uniek busnummer tussen 1-50
                $usedNumbers = $festivalBuses->map(function($b) {
                    preg_match('/Bus #(\d+)/', $b->name, $matches);
                    return isset($matches[1]) ? intval($matches[1]) : null;
                })->filter()->toArray();
                $availableNumbers = array_diff(range(1, 50), $usedNumbers);
                $randomBusNumber = $availableNumbers ? $availableNumbers[array_rand($availableNumbers)] : ($busNumber);
                $bus = \App\Models\Bus::create([
                    'festival_id' => $festival->id,
                    'name' => $festival->name . ' Bus #' . $randomBusNumber,
                    'capacity' => $busCapacity,
                ]);
                $festivalBuses->push($bus);
                $busNumber++;
                $freeSeats = $busCapacity;
            }
            $assignSeats = min($seatsToAssign, $freeSeats);
            $startSeat = $bookedSeats + 1;
            $seatNumbers = array_merge($seatNumbers, range($startSeat, $startSeat + $assignSeats - 1));
            $booking = Booking::create([
                'customer_id' => $request->customer_id,
                'festival_id' => $request->festival_id,
                'bus_id' => $bus->id,
                'seats' => $assignSeats,
                'total_price' => $assignSeats * ($festival->price ?? 0),
                'points_awarded' => (int)(($assignSeats * ($festival->price ?? 0)) / 10),
                'status' => 'Bevestigd',
                'booked_at' => now(),
                'seat_numbers' => implode(',', range($startSeat, $startSeat + $assignSeats - 1)),
                'seat_type' => $request->seat_type,
            ]);
            $seatsToAssign -= $assignSeats;
        }

        // Bus assignment logic: capacity 50-150 (intervals of 25), bus #1, #2, etc.
        $festivalBuses = \App\Models\Bus::where('festival_id', $festival->id)->orderBy('id')->get();
        $seatsToAssign = $seats;
        $busNumber = $festivalBuses->count() + 1;
        while ($seatsToAssign > 0) {
            $bus = $festivalBuses->last();
            $busCapacity = $bus ? $bus->capacity : null;
            $bookedSeats = $bus ? \App\Models\Booking::where('bus_id', $bus->id)->where('status', 'Bevestigd')->sum('seats') : 0;
            $freeSeats = $bus ? ($busCapacity - $bookedSeats) : 0;
            if (!$bus || $freeSeats <= 0) {
                // Always random bus capacity between 50 and 150 (intervals of 25)
                $possibleSizes = range(50, 150, 25);
                $busCapacity = $possibleSizes[array_rand($possibleSizes)];
                $bus = \App\Models\Bus::create([
                    'festival_id' => $festival->id,
                    'name' => $festival->name . ' Bus #' . $busNumber,
                    'capacity' => $busCapacity,
                ]);
                $festivalBuses->push($bus);
                $busNumber++;
                $freeSeats = $busCapacity;
            }
            $assignSeats = min($seatsToAssign, $freeSeats);
            $booking->bus_id = $bus->id;
            $booking->seats = $assignSeats;
            $booking->save();
            $seatsToAssign -= $assignSeats;
            if ($seatsToAssign > 0) {
                $booking = Booking::create([
                    'customer_id' => $request->customer_id,
                    'festival_id' => $request->festival_id,
                    'seats' => $seatsToAssign,
                    'total_price' => $seatsToAssign * ($festival->price ?? 0),
                    'points_awarded' => (int)(($seatsToAssign * ($festival->price ?? 0)) / 10),
                    'status' => 'Betaald',
                    'booked_at' => now(),
                ]);
            }
        }

        // Award points to customer
        $customer = \App\Models\Customer::find($request->customer_id);
        $customer->loyalty_points = ($customer->loyalty_points ?? 0) + $points_awarded;
        $customer->save();


        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Boeking aangemaakt! Totaal prijs: €' . number_format($total_price, 2) . '. Punten toegekend: ' . $points_awarded);
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
