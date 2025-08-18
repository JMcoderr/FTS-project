@extends('layouts.app')
@section('content')
<h2>Boeking maken</h2>
@if(session('success'))
    <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
@endif
<form method="POST" action="/customers/bookings" style="background: #f9f9f9; padding: 20px; border-radius: 8px; max-width: 400px;">
    @csrf
    <label for="festival_id"><strong>Festival:</strong></label><br>
    <select name="festival_id" required style="width: 100%; margin-bottom: 10px;">
        <option value="">-- Kies een festival --</option>
        @foreach(App\Models\Festival::all() as $festival)
            <option value="{{ $festival->id }}">
                {{ $festival->name }} | {{ $festival->date }} | €{{ $festival->price }}
            </option>
        @endforeach
    </select><br>

    <label for="bus_id"><strong>Bus:</strong></label><br>
    <select name="bus_id" required style="width: 100%; margin-bottom: 10px;">
        <option value="">-- Kies een bus --</option>
        @foreach(App\Models\Bus::all() as $bus)
            <option value="{{ $bus->id }}">{{ $bus->name }} ({{ $bus->type }})</option>
        @endforeach
    </select><br>

    <label for="seat_type"><strong>Stoeltype:</strong></label><br>
    <select name="seat_type" required style="width: 100%; margin-bottom: 10px;">
        <option value="">-- Kies stoeltype --</option>
        <option value="standaard">Standaard</option>
        <option value="comfort">Comfort</option>
        <option value="premium">Premium</option>
    </select><br>

    <label for="seats"><strong>Aantal kaartjes:</strong></label><br>
    <input type="number" name="seats" min="1" value="1" required style="width: 100%; margin-bottom: 10px;"><br>

    @php
        $customer = \App\Models\Customer::where('email', Auth::user()->email)->first();
        $points = $customer->loyalty_points ?? 0;
    @endphp
    <label for="loyalty_points"><strong>Loyalty punten gebruiken:</strong></label><br>
    <select name="loyalty_points" style="width: 100%; margin-bottom: 10px;">
        <option value="0">Geen korting</option>
        @if($points >= 100)
            <option value="100">Gebruik 100 punten voor 25% korting</option>
        @endif
        @if($points >= 200)
            <option value="200">Gebruik 200 punten voor 50% korting</option>
        @endif
    </select>
    <small>Je hebt <strong>{{ $points }}</strong> punten beschikbaar.</small><br>

    <label for="remarks"><strong>Opmerkingen:</strong></label><br>
    <textarea name="remarks" rows="2" style="width: 100%; margin-bottom: 10px;"></textarea><br>

<button type="submit">Boek nu</button>
<a href="/dashboard">Terug naar dashboard</a>
</form>
@endsection
