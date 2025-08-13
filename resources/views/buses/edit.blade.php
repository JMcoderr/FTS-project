<!-- resources/views/buses/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Bus Bewerken</h1>

<form method="POST" action="{{ route('buses.update', $bus) }}">
    @csrf
    @method('PUT')

    <label>Naam:</label><br>
    <input type="text" name="name" value="{{ $bus->name }}" required><br><br>

    <label>Capaciteit:</label><br>
    <input type="number" name="capacity" value="{{ $bus->capacity }}" min="1" required><br><br>

    <label>Festival:</label><br>
    <select name="festival_id" required>
        @foreach($festivals as $festival)
            <option value="{{ $festival->id }}" @if($bus->festival_id==$festival->id) selected @endif>
                {{ $festival->name }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Opslaan</button>
</form>
@endsection
