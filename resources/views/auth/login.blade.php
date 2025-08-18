<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')
@section('content')
<h2>Login</h2>
@if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="/login">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Wachtwoord:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<p>Nog geen account? <a href="/register">Registreer hier</a></p>
@endsection
