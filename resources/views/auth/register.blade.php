<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')
@section('content')
<h2>Registreren</h2>
<form method="POST" action="/register">
    @csrf
    <label>Naam:</label>
    <input type="text" name="name" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Wachtwoord:</label>
    <input type="password" name="password" required><br>
    <label>Herhaal wachtwoord:</label>
    <input type="password" name="password_confirmation" required><br>
    <button type="submit">Registreer</button>
</form>
<p>Al een account? <a href="/login">Login hier</a></p>
@endsection
