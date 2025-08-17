<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Dashboard Festivals & Bussen</h1>

@foreach($festivals as $festival)
    <h2>{{ $festival->name }} ({{ $festival->date }})</h2>
    <p>Locatie: {{ $festival->location }} | Max Capaciteit: {{ $festival->max_capacity }}</p>

    <!-- Totaal aantal tickets verwijderd zoals gevraagd -->

    @if($festival->buses->count())
        @foreach($festival->buses as $bus)
            <h3>{{ $bus->name }} (Zitplaatsen: {{ $bus->bookings->sum('seats') }}/{{ $bus->capacity }})</h3>
            <ul>
                @foreach($bus->bookings as $booking)
                    <li>{{ $booking->customer->first_name }} {{ $booking->customer->last_name }} - Punten: {{ $booking->points_awarded }}</li>
                @endforeach
            </ul>
        @endforeach
    @else
        <p>Geen bussen toegewezen voor dit festival.</p>
    @endif
    <hr>
@endforeach

@endsection
