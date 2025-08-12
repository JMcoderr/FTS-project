@extends('layouts.app')

@section('content')
<h1>Nieuwe klant toevoegen</h1>

<form method="POST" action="{{ route('customers.store') }}">
    @csrf

    <label for="first_name">Voornaam:</label><br>
    <input type="text" id="first_name" name="first_name" required><br><br>

    <label for="last_name">Achternaam:</label><br>
    <input type="text" id="last_name" name="last_name" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <button type="submit">Opslaan</button>
</form>
@endsection
