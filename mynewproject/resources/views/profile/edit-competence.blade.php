@extends('layouts.profhead')

@section('content')
<div class="container">
    <h1>Edit Competence</h1>

    <form method="POST" action="{{ route('profile.competences.update', $competence->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Competence Name</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $competence->nom }}" required>
        </div>

        <div class="form-group">
            <label for="niveau_id">Select Niveau</label>
            <select name="niveau_id" id="niveau_id" class="form-control" required>
                @foreach($niveaux as $niveau)
                    <option value="{{ $niveau->id }}" {{ $competence->niveau_id == $niveau->id ? 'selected' : '' }}>{{ $niveau->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="sous_domaines_id">Select Sous Domaine</label>
            <select name="sous_domaines_id" id="sous_domaines_id" class="form-control" required>
                @foreach($sousDomaines as $sousDomaine)
                    <option value="{{ $sousDomaine->id }}" {{ $competence->sous_domaines_id == $sousDomaine->id ? 'selected' : '' }}>{{ $sousDomaine->description }} ({{ $sousDomaine->code }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Competence</button>
    </form>
</div>
@endsection
