<!-- resources/views/admin.blade.php -->
@extends('layouts.app')
@section('content')
<h2>Admin Dashboard</h2>
<p>Welkom, {{ Auth::user()->name }} (Admin)</p>
<ul>
    <li><a href="/festivals">Festivals beheren</a></li>
    <li><a href="/customers">Klanten beheren</a></li>
    <li><a href="/buses">Bussen beheren</a></li>
</ul>
<form method="POST" action="/logout">@csrf<button type="submit">Uitloggen</button></form>
@endsection
