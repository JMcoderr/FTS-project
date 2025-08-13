@extends('layouts.app')

@section('content')
<h1>Festivals</h1>

<a href="{{ route('festivals.create') }}">Nieuw Festival Toevoegen</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<!-- Search & Sort Form -->
<form method="GET" action="{{ route('festivals.index') }}" style="margin: 10px 0;">
    <input type="text" name="search" placeholder="Zoek op naam of locatie" value="{{ request('search') }}">
    <select name="sort">
        <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>ID</option>
        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Naam</option>
        <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Datum</option>
        <option value="location" {{ request('sort') == 'location' ? 'selected' : '' }}>Locatie</option>
        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Prijs</option>
        <option value="max_capacity" {{ request('sort') == 'max_capacity' ? 'selected' : '' }}>Max. Capaciteit</option>
    </select>
    <select name="direction">
        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Oplopend</option>
        <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Aflopend</option>
    </select>
    <button type="submit">Filter</button>
</form>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Datum</th>
            <th>Locatie</th>
            <th>Prijs (€)</th>
            <th>Max. Capaciteit</th>
            <th>Acties</th>
        </tr>
    </thead>
    <tbody>
        @forelse($festivals as $festival)
        <tr>
            <td>{{ $festival->id }}</td>
            <td>{{ $festival->name }}</td>
            <td>{{ $festival->date }}</td>
            <td>{{ $festival->location }}</td>
            <td>{{ $festival->price }}</td>
            <td>{{ $festival->max_capacity }}</td>
            <td>
                <a href="{{ route('festivals.show', $festival) }}">Bekijk</a> |
                <a href="{{ route('festivals.edit', $festival) }}">Bewerken</a> |
                <form action="{{ route('festivals.destroy', $festival) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Weet je zeker dat je dit festival wilt verwijderen?')">Verwijderen</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">Geen festivals gevonden.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
