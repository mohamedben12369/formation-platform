@extends('dashboard')
@section('dashboard-section')
<div class="container mt-4">
    <h2>Modifier le thème de formation</h2>
    <form method="POST" action="{{ route('dashboard.theme-formations.update', $theme->idtheme) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="titre" class="form-control" value="{{ $theme->titre }}" required>
        </div>
        <div class="mb-3">
            <label>Sous Domaine</label>
            <select name="sous_domaine_code" class="form-control" required>
                @foreach($sous_domaines as $sousDomaine)
                    <option value="{{ $sousDomaine->code }}" @if($theme->sous_domaine_code == $sousDomaine->code) selected @endif>{{ $sousDomaine->code }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Axe</label>
            <select name="axes_id" class="form-control" required>
                @foreach($axes as $axe)
                    <option value="{{ $axe->id }}" @if($theme->axes_id == $axe->id) selected @endif>{{ $axe->nom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('dashboard.theme-formations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
