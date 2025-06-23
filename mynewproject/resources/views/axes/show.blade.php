@extends('dashboard')
@section('dashboard-section')
    <h2>Détail de l'axe</h2>
    <ul>
        <li><strong>ID:</strong> {{ $axe->id }}</li>
        <li><strong>Nom:</strong> {{ $axe->nom }}</li>
        <li><strong>Description:</strong> {{ $axe->description }}</li>
    </ul>
    <a href="{{ route('axes.edit', $axe) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('axes.index') }}" class="btn btn-secondary">Retour</a>
@endsection
