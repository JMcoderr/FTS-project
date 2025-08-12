<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    // Removed duplicate store method to fix redeclaration error.

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:customers,email',
    ]);

    \App\Models\Customer::create([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->route('customers.index')->with('success', 'Klant toegevoegd!');
    }
}
