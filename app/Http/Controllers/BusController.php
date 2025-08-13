<?php

// app/Http/Controllers/BusController.php
namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Festival;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::with('festival')->get();
        return view('buses.index', compact('buses'));
    }

    public function create()
    {
        $festivals = Festival::all();
        return view('buses.create', compact('festivals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'festival_id' => 'required|exists:festivals,id',
        ]);

        Bus::create($request->all());
        return redirect()->route('buses.index')->with('success', 'Bus toegevoegd!');
    }

    public function edit(Bus $bus)
    {
        $festivals = Festival::all();
        return view('buses.edit', compact('bus', 'festivals'));
    }

    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'festival_id' => 'required|exists:festivals,id',
        ]);

        $bus->update($request->all());
        return redirect()->route('buses.index')->with('success', 'Bus bijgewerkt!');
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();
        return redirect()->route('buses.index')->with('success', 'Bus verwijderd!');
    }
}
