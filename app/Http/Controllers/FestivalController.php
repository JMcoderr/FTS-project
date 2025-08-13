<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    // Lijst van festivals met search & sort
    public function index(Request $request)
    {
        $query = Festival::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
        }

        // Sort
        $sort = $request->get('sort', 'id'); // standaard sorteren op id
        $direction = $request->get('direction', 'asc'); // standaard oplopend

        // Alleen veilige kolommen
        if (!in_array($sort, ['id','name','date','location','price','max_capacity'])) {
            $sort = 'id';
        }
        if (!in_array($direction, ['asc','desc'])) {
            $direction = 'asc';
        }

        $festivals = $query->orderBy($sort, $direction)->get();

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
