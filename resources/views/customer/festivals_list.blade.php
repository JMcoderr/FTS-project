@extends('layouts.app')
@section('content')
<h2>Festival List</h2>
@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif
<a href="/customers/tickets" style="display:inline-block; margin-bottom:20px; background:#28a745; color:white; padding:8px 16px; border-radius:4px; text-decoration:none;">Mijn tickets bekijken</a>
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
<a href="/dashboard">Terug naar admin dashboard</a>
@endsection
