@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/admin.css">
<div class="admin-dashboard-outer" style="position:relative;display:flex;justify-content:center;align-items:flex-start;min-height:80vh;">
	<div class="admin-dashboard-container" style="margin-top:60px; animation:fadeInUp 1.2s cubic-bezier(.77,0,.175,1); box-shadow: 0 8px 32px rgba(255,106,136,0.12); background: linear-gradient(120deg, #fff 90%, #ffcc70 100%); border-radius: 32px; max-width:400px; width:100%;">
		<div class="admin-dashboard-title" style="animation:fadeInDown 1.2s cubic-bezier(.77,0,.175,1); text-align:center; display:flex;justify-content:center;align-items:center;gap:12px;">
			<span style="font-size:2.2rem;">✏️</span> Klant bewerken
		</div>
		<form method="POST" action="/customer-list/{{ $customer->id }}" class="admin-form" style="margin-top:18px;">
			@csrf
			@method('PUT')
			<label for="first_name">Naam veranderen</label>
			<input type="text" id="first_name" name="first_name" value="{{ $customer->first_name }}" required style="box-shadow:0 2px 12px rgba(255,106,136,0.09);">

			<label for="email">E-mail</label>
			<input type="email" id="email" name="email" value="{{ $customer->email }}" required style="box-shadow:0 2px 12px rgba(255,106,136,0.09);">

			<label for="password">Wachtwoord</label>
			<input type="password" id="password" name="password" placeholder="Nieuw wachtwoord" style="box-shadow:0 2px 12px rgba(255,106,136,0.09);">

			<button type="submit" class="admin-btn save-btn" style="margin-top:24px;">
				<span style="font-size:1.2rem;vertical-align:middle;">💾</span> Opslaan
			</button>
		</form>
		<div style="display:flex;justify-content:center;margin-top:32px;">
			<a href="/admin/customers" class="admin-btn save-btn" style="margin-top:0;padding:8px 32px;min-width:180px;text-align:center;">
				<span style="font-size:1.1rem;vertical-align:middle;">←</span> Terug naar klantenlijst
			</a>
		</div>
	</div>
</div>
@endsection
