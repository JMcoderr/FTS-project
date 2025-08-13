@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/customers.css') }}">
@section('content')
<body class="customer-bg">
    <div class="customer-container">
        <div class="customer-accent"></div>
        <h1 class="customer-header">Nieuwe klant toevoegen</h1>
        <form method="POST" action="{{ route('customers.store') }}" class="customer-form">
            @csrf
            <label for="first_name">Voornaam:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Achternaam:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit" class="customer-btn">Opslaan</button>
        </form>
    </div>
</body>
@endsection
