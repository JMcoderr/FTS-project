@extends('layouts.app')

@section('content')
<h1>Boeking #{{ $booking->id }}</h1>

<p><strong>Klant:</strong> {{ $booking->customer?->first_name }} {{ $booking->customer?->last_name }} ({{ $booking->customer?->email }})</p>
<p><strong>Festival:</strong> {{ $booking->festival?->name }} — {{ $booking->festival?->date }} — {{ $booking->festival?->location }}</p>
<p><strong>Zitplaatsen:</strong> {{ $booking->seats }}</p>
<p><strong>Status:</strong> {{ $booking->status }}</p>
<p><strong>Totaal (€):</strong> {{ number_format($booking->total_price, 2) }}</p>
<p><strong>Punten:</strong> {{ $booking->points_awarded }}</p>
<p><strong>Geboekt op:</strong> {{ $booking->booked_at?->format('Y-m-d H:i') }}</p>

<a href="{{ route('bookings.edit', $booking) }}">Bewerken</a> |
<form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display:inline;">
    @csrf @method('DELETE')
    <button type="submit" onclick="return confirm('Verwijderen?')">Verwijderen</button>
</form> |
<a href="{{ route('bookings.index') }}">Terug naar lijst</a>
@endsection
