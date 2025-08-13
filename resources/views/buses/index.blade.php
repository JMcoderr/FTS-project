<!-- resources/views/buses/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Bussen</h1>
<a href="{{ route('buses.create') }}">Nieuwe Bus Toevoegen</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Capaciteit</th>
            <th>Festival</th>
            <th>Acties</th>
        </tr>
    </thead>
    <tbody>
        @foreach($buses as $bus)
            <tr>
                <td>{{ $bus->id }}</td>
                <td>{{ $bus->name }}</td>
                <td>{{ $bus->capacity }}</td>
                <td>{{ $bus->festival->name }}</td>
                <td>
                    <a href="{{ route('buses.edit', $bus) }}">Bewerken</a> |
                    <form action="{{ route('buses.destroy', $bus) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Weet je zeker dat je deze bus wilt verwijderen?')">Verwijderen</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
