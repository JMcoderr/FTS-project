@extends('layouts.app')

@section('content')
<h1>Boekingen</h1>

<a href="{{ route('bookings.create') }}">Nieuwe Boeking</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form method="GET" action="{{ route('bookings.index') }}" style="margin:10px 0;">
    <label>Status:</label>
    <select name="status">
        <option value="">-- alle --</option>
        @foreach(['pending','confirmed','cancelled'] as $st)
            <option value="{{ $st }}" {{ request('status')===$st?'selected':'' }}>{{ ucfirst($st) }}</option>
        @endforeach
    </select>
    <button type="submit">Filter</button>
</form>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Klant</th>
            <th>Festival</th>
            <th>Zitplaatsen</th>
            <th>Status</th>
            <th>Totaal (€)</th>
            <th>Punten</th>
            <th>Aangemaakt</th>
            <th>Acties</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bookings as $b)
        <tr>
            <td>{{ $b->id }}</td>
            <td>{{ $b->customer?->first_name }} {{ $b->customer?->last_name }}</td>
            <td>{{ $b->festival?->name }}</td>
            <td>{{ $b->seats }}</td>
            <td>{{ $b->status }}</td>
            <td>{{ number_format($b->total_price, 2) }}</td>
            <td>{{ $b->points_awarded }}</td>
            <td>{{ $b->created_at->format('Y-m-d H:i') }}</td>
            <td>
                <a href="{{ route('bookings.show', $b) }}">Bekijk</a> |
                <a href="{{ route('bookings.edit', $b) }}">Bewerken</a> |
                <form action="{{ route('bookings.destroy', $b) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Verwijderen?')">Verwijderen</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="9">Geen boekingen gevonden.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $bookings->links() }}
@endsection
