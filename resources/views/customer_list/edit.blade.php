@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/customers.css') }}">
@section('content')
<body class="customer-bg">
    <div class="customer-container">
        <div class="customer-accent"></div>
        <h1 class="customer-header">Klant bewerken</h1>
        @if ($errors->any())
            <div style="color:red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('customers.update', $customer->id) }}" class="customer-form">
            @csrf
            @method('PUT')
            <label for="first_name">Voornaam:</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $customer->first_name) }}" required>

            <label for="last_name">Achternaam:</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $customer->last_name) }}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}" required>

            <button type="submit" class="customer-btn">Bijwerken</button>
        </form>
    </div>
</body>
@endsection
