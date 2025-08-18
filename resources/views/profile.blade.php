<!-- resources/views/profile.blade.php -->
@extends('layouts.app')
@section('content')
<h2>Mijn Profiel</h2>
@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif
<p>Welkom, {{ Auth::user()->name }}!</p>
<p>Email: {{ Auth::user()->email }}</p>
<p>Rol: {{ Auth::user()->role }}</p>
<p>Loyalty punten: {{ Auth::user()->loyalty_points ?? 0 }}</p>

<h3>Reisgeschiedenis</h3>
@if(Auth::user()->bookings && count(Auth::user()->bookings))
<ul>
@foreach(Auth::user()->bookings as $booking)
    <li>{{ $booking->festival->name ?? 'Onbekend festival' }} - {{ $booking->booked_at }} - {{ $booking->status }} - Kaartjes: {{ $booking->seats }}</li>
@endforeach
</ul>
@else
<p>Geen boekingen gevonden.</p>
@endif

<h3>Profiel wijzigen</h3>
<form method="POST" action="/customer/profile/update">
    @csrf
    <label>Naam:</label>
    <input type="text" name="name" value="{{ Auth::user()->name }}" required><br>
    <label>Nieuw wachtwoord:</label>
    <input type="password" name="password"><br>
    <button type="submit">Opslaan</button>
</form>
<a href="/customer/festivals"><button>Terug naar festivals</button></a>
<form method="POST" action="/logout">@csrf<button type="submit">Uitloggen</button></form>
@endsection
