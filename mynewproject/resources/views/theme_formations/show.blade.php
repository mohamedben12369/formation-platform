@extends('dashboard')
@section('dashboard-section')
<div class="container mt-4">
    <h2>Détail du thème de formation</h2>
    <ul>
        <li><strong>Titre:</strong> {{ $theme->titre }}</li>
        <li><strong>Sous Domaine:</strong> {{ optional($theme->sousDomaine)->code }}</li>
        <li><strong>Axe:</strong> {{ optional($theme->axe)->nom }}</li>
    </ul>
    <a href="{{ route('dashboard.theme-formations.edit', $theme->idtheme) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('dashboard.theme-formations.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
