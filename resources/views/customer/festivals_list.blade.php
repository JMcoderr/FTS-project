@extends('layouts.app')
@section('content')
<h2>Festival List</h2>
@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif
<a href="/customers/tickets" style="display:inline-block; margin-bottom:20px; background:#28a745; color:white; padding:8px 16px; border-radius:4px; text-decoration:none;">Mijn tickets bekijken</a>
<form method="GET" action="{{ route('customer.festivals') }}" style="margin-bottom: 18px;">
    <label for="search">Zoek op naam of locatie</label>
    <input type="text" id="search" name="search" placeholder="Zoek op naam of locatie" value="{{ request('search') }}">
    <label for="min_bookings">Minimaal aantal boekingen</label>
    <input type="number" id="min_bookings" name="min_bookings" value="{{ request('min_bookings') }}" min="0">
    <button type="submit">Zoeken/Filteren</button>
</form>
@php
    $festivalBookings = [];
    foreach($festivals as $festival) {
        $festivalBookings[$festival->id] = \App\Models\Booking::where('festival_id', $festival->id)->count();
    }
@endphp
<div style="margin: 20px 0;">
    <h3>Aantal boekingen per festival</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Festival</th>
            <th>Aantal boekingen</th>
        </tr>
        @foreach($festivals as $festival)
            @if((!request('min_bookings') || $festivalBookings[$festival->id] >= request('min_bookings')) && (!request('search') || str_contains(strtolower($festival->name . $festival->location), strtolower(request('search')))))
            <tr>
                <td>{{ $festival->name }}</td>
                <td>{{ $festivalBookings[$festival->id] }}</td>
            </tr>
            @endif
        @endforeach
    </table>
</div>
<ul>
@foreach($festivals as $festival)
    <li style="margin-bottom: 20px;">
        <strong>{{ $festival->name }}</strong> <br>
        Datum: {{ $festival->date }}<br>
        Locatie: {{ $festival->location }}<br>
        Prijs: €{{ $festival->price }}<br>
        <a href="/customer/festivals/{{ $festival->id }}"><button>Meer informatie</button></a>
    </li>
@endforeach
</ul>
<a href="/dashboard">Terug naar dashboard</a>
@endsection
