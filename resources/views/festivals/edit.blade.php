@extends('layouts.app')

@section('content')
<h1>Festival Bewerken</h1>

<form method="POST" action="{{ route('festivals.update', $festival) }}">
    @csrf
    @method('PUT')
    <label>Naam:</label><br>
    <input type="text" name="name" value="{{ old('name', $festival->name) }}" required><br><br>

    <label>Datum:</label><br>
    <input type="date" name="date" value="{{ old('date', $festival->date) }}" required><br><br>

    <label>Locatie:</label><br>
    <input type="text" name="location" value="{{ old('location', $festival->location) }}" required><br><br>

    <label>Prijs (€):</label><br>
    <input type="number" name="price" value="{{ old('price', $festival->price) }}" step="0.01" required><br><br>

    <label>Max. Capaciteit:</label><br>
    <input type="number" name="max_capacity" value="{{ old('max_capacity', $festival->max_capacity) }}" required><br><br>

    <button type="submit">Bijwerken</button>
</form>
@endsection
