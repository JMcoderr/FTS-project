@extends('layouts.app')
@section('content')
@if(Auth::check())
    <h2>Welkom, {{ Auth::user()->name }}!</h2>
    @if(Auth::user()->role === 'admin')
        <ul>
            <li><a href="/festivals">Alle festivals beheren</a></li>
            <li><a href="/bookings">Alle boekingen beheren</a></li>
            <li><a href="/buses">Bussen beheren</a></li>
            <li><a href="/customer-list">Gebruikers beheren</a></li>
            <li><form method="POST" action="/logout">@csrf <button type="submit">Uitloggen</button></form></li>
        </ul>
    @else
        <ul>
            <li><a href="/festival-list">Festivals bekijken</a></li>
            <li><a href="/customers/bookings/create">Boeking maken</a></li>
            <li><a href="/profile">Mijn profiel</a></li>
            <li><a href="/customers/tickets">Mijn tickets</a></li>
            <li><form method="POST" action="/logout">@csrf <button type="submit">Uitloggen</button></form></li>
        </ul>
    @endif
@else
    <h2>Je bent niet ingelogd.</h2>
    <a href="/login">Log in</a>
@endif
@endsection
