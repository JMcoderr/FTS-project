<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    public function index(Request $request)
    {
        $query = Festival::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
        }

        // Sort
        $sort = $request->input('sort', 'id'); // standaard sorteren op ID
        $direction = $request->input('direction', 'asc');
        $query->orderBy($sort, $direction);

        // Paginate, 10 per pagina
        $festivals = $query->paginate(10)->withQueryString();

        return view('festivals.index', compact('festivals'));
    }

    // Form voor nieuw festival
    public function create()
    {
        return view('festivals.create');
    }

    // Opslaan van nieuw festival
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_capacity' => 'required|integer|min:1',
        ]);

        Festival::create($request->all());

        return redirect()->route('festivals.index')->with('success', 'Festival toegevoegd.');
    }

    // Eén festival bekijken
    public function show(Festival $festival)
    {
        return view('festivals.show', compact('festival'));
    }

    // Form voor bewerken
    public function edit(Festival $festival)
    {
        return view('festivals.edit', compact('festival'));
    }

    // Opslaan van bewerking
    public function update(Request $request, Festival $festival)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_capacity' => 'required|integer|min:1',
        ]);

        $festival->update($request->all());

        return redirect()->route('festivals.index')->with('success', 'Festival bijgewerkt.');
    }

    // Verwijderen
    public function destroy(Festival $festival)
    {
        $festival->delete();

        return redirect()->route('festivals.index')->with('success', 'Festival verwijderd.');
    }
}
