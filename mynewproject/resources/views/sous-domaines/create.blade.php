@extends('dashboard')
@section('dashboard-section')
<div class="container mt-4">
    <h2>Ajouter un sous domaine</h2>
    <form method="POST" action="{{ route('sous-domaines.store') }}">
        @csrf
        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control">
        </div>
        <div class="mb-3">
            <label>Domaine</label>
            <select name="domaine_code" class="form-control" required>
                <option value="">Sélectionner un domaine</option>
                @foreach($domaines as $domaine)
                    <option value="{{ $domaine->id }}">{{ $domaine->nom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="{{ route('sous-domaines.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
