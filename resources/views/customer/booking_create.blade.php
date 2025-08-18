@extends('layouts.app')
@section('content')
<h2>Boeking maken</h2>
@if(isset($festival))
    <form method="POST" action="/customer/bookings">
        @csrf
        <input type="hidden" name="festival_id" value="{{ $festival->id }}">
        <p>Festival: <strong>{{ $festival->name }}</strong></p>
        <p>Datum: {{ $festival->date }}</p>
        <p>Locatie: {{ $festival->location }}</p>
        <label>Aantal kaartjes:</label>
        <input type="number" name="seats" min="1" max="{{ $festival->max_capacity }}" value="1" required><br>
        <button type="submit">Boek nu</button>
    </form>
@else
    <p>Geen festival geselecteerd.</p>
@endif
@endsection
