@extends('layouts.app')
@section('content')
<h2>Festivals voor klanten</h2>
<ul>
@foreach($festivals as $festival)
    <li>
        <strong>{{ $festival->name }}</strong> - {{ $festival->date }}<br>
        Locatie: {{ $festival->location }}<br>
        Prijs: €{{ $festival->price }}<br>
        <a href="/customer/bookings/create?festival_id={{ $festival->id }}">Boek nu</a>
    </li>
@endforeach
</ul>
@endsection
