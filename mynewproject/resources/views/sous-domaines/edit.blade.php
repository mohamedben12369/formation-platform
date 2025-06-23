@extends('dashboard')
@section('dashboard-section')
<div class="container mt-4">
    <h2>Modifier le sous domaine</h2>
    <form method="POST" action="{{ route('sous-domaines.update', $sousDomaine->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" value="{{ $sousDomaine->code }}" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ $sousDomaine->description }}">
        </div>
        <div class="mb-3">
            <label>Domaine</label>
            <select name="domaine_code" class="form-control" required>
                @foreach($domaines as $domaine)
                    <option value="{{ $domaine->id }}" @if($sousDomaine->domaine_code == $domaine->id) selected @endif>{{ $domaine->nom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('sous-domaines.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
