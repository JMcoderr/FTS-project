@extends('layouts.app')

@section('content')
<h1>Festivals</h1>

<a href="{{ route('festivals.create') }}">Nieuw Festival Toevoegen</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

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
        @foreach($festivals as $festival)
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
        @endforeach
    </tbody>
</table>
@endsection
