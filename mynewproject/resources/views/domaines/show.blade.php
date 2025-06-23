@extends('dashboard')
@section('dashboard-section')
    <h2>Détail du domaine</h2>
    <ul>
        <li><strong>ID:</strong> {{ $domaine->id }}</li>
        <li><strong>Nom:</strong> {{ $domaine->nom }}</li>
        <li><strong>Description:</strong> {{ $domaine->description }}</li>
    </ul>
    <a href="{{ route('dashboard.index', $domaine) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Retour</a>
@endsection
