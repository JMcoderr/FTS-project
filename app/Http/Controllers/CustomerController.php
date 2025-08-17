<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // Toon reisgeschiedenis van een klant
    public function history($id)
    {
        $customer = \App\Models\Customer::findOrFail($id);
        $festivals = $customer->bookings()->with('festival')->get()->pluck('festival')->unique('id');
        return view('customers.history', compact('customer', 'festivals'));
    }
    // Toon het puntenoverzicht van een klant
    public function points($id)
    {
        $customer = \App\Models\Customer::findOrFail($id);
        return view('customers.points', compact('customer'));
    }

    // Verwerk het inwisselen van punten
    public function redeemPoints(Request $request, $id)
    {
        $customer = \App\Models\Customer::findOrFail($id);
        $redeemType = $request->input('redeem_type');
        $requiredPoints = $redeemType === 'vip' ? 100 : 50; // voorbeeld: 100 voor VIP, 50 voor korting
        if (($customer->loyalty_points ?? 0) >= $requiredPoints) {
            $customer->loyalty_points -= $requiredPoints;
            $customer->save();
            $message = $redeemType === 'vip' ? 'VIP-ticket toegekend!' : 'Korting toegekend!';
            return redirect()->route('customers.points', $customer->id)->with('success', $message);
        } else {
            return redirect()->route('customers.points', $customer->id)->with('error', 'Niet genoeg punten om in te wisselen.');
        }
    }


    public function index()
    {
    $customers = \App\Models\Customer::all();
    return view('customers.index', compact('customers'));
    }

    public function create()
    {
    return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'required|email|unique:customers,email',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Klant toegevoegd.');
    }

        // Toon formulier om klant te bewerken
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    // Verwerk de update van klantgegevens
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:customers,email,'.$id,
        ]);

        $customer = Customer::findOrFail($id);
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Klant succesvol bijgewerkt.');
    }

        public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Klant succesvol verwijderd.');
    }
}
