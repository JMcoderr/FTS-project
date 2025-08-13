<!-- resources/views/buses/create.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Nieuwe Bus Toevoegen</h1>

<form method="POST" action="{{ route('buses.store') }}">
    @csrf
    <label>Naam:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Capaciteit:</label><br>
    <input type="number" name="capacity" min="1" required><br><br>

    <label>Festival:</label><br>
    <select name="festival_id" required>
        @foreach($festivals as $festival)
            <option value="{{ $festival->id }}">{{ $festival->name }}</option>
        @endforeach
    </select><br><br>

    <button type="submit">Opslaan</button>
</form>
@endsection
