@extends('layouts.app')

@section('content')
<h1>Festival Details</h1>

<p><strong>Naam:</strong> {{ $festival->name }}</p>
<p><strong>Datum:</strong> {{ $festival->date }}</p>
<p><strong>Locatie:</strong> {{ $festival->location }}</p>
<p><strong>Prijs (€):</strong> {{ $festival->price }}</p>
<p><strong>Max. Capaciteit:</strong> {{ $festival->max_capacity }}</p>

<a href="{{ route('festivals.edit', $festival) }}">Bewerken</a> |
<a href="{{ route('festivals.index') }}">Terug naar lijst</a>
@endsection
