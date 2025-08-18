@extends('layouts.app')
@section('content')
<h2>{{ $festival->name }}</h2>
<p><strong>Datum:</strong> {{ $festival->date }}</p>
<p><strong>Locatie:</strong> {{ $festival->location }}</p>
<p><strong>Prijs:</strong> €{{ $festival->price }}</p>
<p><strong>Max capaciteit:</strong> {{ $festival->max_capacity }}</p>
<p><strong>Beschrijving:</strong> {{ $festival->description ?? 'Geen beschrijving beschikbaar.' }}</p>
<a href="/customer/bookings/create?festival_id={{ $festival->id }}"><button>Boek dit festival</button></a>
<a href="/customer/festivals"><button>Terug naar festivals</button></a>
@endsection
