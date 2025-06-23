@extends('dashboard')
@section('dashboard-section')
<div class="container mt-4">
    <h2>Détail du sous domaine</h2>
    <ul>
        <li><strong>Code:</strong> {{ $sousDomaine->code }}</li>
        <li><strong>Description:</strong> {{ $sousDomaine->description }}</li>
        <li><strong>Domaine:</strong> {{ optional($sousDomaine->domaine)->nom }}</li>
    </ul>
    <a href="{{ route('sous-domaines.edit', $sousDomaine->id) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('sous-domaines.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
