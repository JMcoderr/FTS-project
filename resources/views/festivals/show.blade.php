@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/festivals.css') }}">
@section('content')
<body class="festival-bg">
	<div class="festival-container">
		<div class="festival-accent"></div>
		<h1 class="festival-header">Festival Details</h1>
		<div class="festival-card">
			<h2>{{ $festival->name }}</h2>
			<p><strong>Datum:</strong> {{ $festival->date }}</p>
			<p><strong>Locatie:</strong> {{ $festival->location }}</p>
			<p><strong>Prijs (€):</strong> {{ $festival->price }}</p>
			<p><strong>Max. Capaciteit:</strong> {{ $festival->max_capacity }}</p>
			<div class="festival-btn-group" style="margin-top:2rem;">
				<a class="festival-btn" href="{{ route('festivals.edit', $festival) }}">Bewerken</a>
				<form action="{{ route('festivals.destroy', $festival) }}" method="POST">
					@csrf
					@method('DELETE')
					<button type="submit" class="festival-btn delete" onclick="return confirm('Weet je zeker dat je dit festival wilt verwijderen?')">Verwijderen</button>
				</form>
				<a class="festival-btn" href="{{ route('festivals.index') }}">Terug naar lijst</a>
			</div>
		</div>
	</div>
</body>
@endsection
