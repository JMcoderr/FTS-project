@extends('layouts.app')
@section('content')
<h2>Mijn Profiel</h2>
<p>Welkom, {{ Auth::user()->name }}!</p>
<p>Email: {{ Auth::user()->email }}</p>
<p>Rol: {{ Auth::user()->role }}</p>
@php
    $customer = \App\Models\Customer::where('email', Auth::user()->email)->first();
@endphp
<p>Loyalty punten: {{ $customer->loyalty_points ?? 0 }}</p>

<h3>Reisgeschiedenis</h3>
<ul>
@foreach(Auth::user()->bookings as $booking)
    <li>{{ $booking->festival->name }} - {{ $booking->booked_at }} - {{ $booking->status }} - Kaartjes: {{ $booking->seats }}</li>
@endforeach
</ul>

<h3>Profiel wijzigen</h3>
<form method="POST" action="/customer/profile/update">
    @csrf
    <label>Naam:</label>
    <input type="text" name="name" value="{{ Auth::user()->name }}" required><br>
    <label>Nieuw wachtwoord:</label>
    <input type="password" name="password"><br>
    <button type="submit">Opslaan</button>
</form>
<button type="button" onclick="window.history.back()">Terug</button>
<form method="POST" action="/logout">@csrf<button type="submit">Uitloggen</button>
</form>
@endsection
