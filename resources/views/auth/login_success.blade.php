@extends('layouts.app')
@section('content')
<h2>Login succesvol!</h2>
@if(Auth::user()->role === 'admin')
    <p>Welkom, {{ Auth::user()->name }} (Admin)</p>
    <ul>
        <li><a href="/customers">Gebruikers toevoegen/bekijken</a></li>
        <li><a href="/festivals">Festivals toevoegen/bekijken</a></li>
        <li><a href="/buses">Bussen toevoegen/bekijken</a></li>
        <li><a href="/dashboard">Dashboard</a></li>
        <li><a href="/bookings">Boekingen beheren</a></li>
    </ul>
@else
    <p>Welkom, {{ Auth::user()->name }}!</p>
    <ul>
        <li><a href="/customers/festivals">Festivals bekijken</a></li>
        <li><a href="/customers/bookings/create">Boeking maken</a></li>
        <li><a href="/profile">Mijn profiel</a></li>
    </ul>
@endif
<form method="POST" action="/logout">@csrf<button type="submit">Uitloggen</button></form>
@endsection
