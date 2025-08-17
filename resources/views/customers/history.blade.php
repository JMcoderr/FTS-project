@extends('layouts.app')

@section('content')
<h1>Reisgeschiedenis van {{ $customer->first_name }} {{ $customer->last_name }}</h1>
@if($festivals->count())
    <ul>
        @foreach($festivals as $festival)
            <li>{{ $festival->name }} — {{ $festival->date }} — {{ $festival->location }}</li>
        @endforeach
    </ul>
@else
    <p>Deze klant heeft nog geen festivals bezocht.</p>
@endif
<a href="{{ route('customers.index') }}">Terug naar klantenlijst</a>
@endsection
