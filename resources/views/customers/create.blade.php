@extends('layouts.app')

@section('content')
<h1>Nieuwe Klant Toevoegen</h1>

<form method="POST" action="{{ route('customers.store') }}">
    @csrf
    <label for="name">Naam:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <button type="submit">Opslaan</button>
</form>

@endsection
