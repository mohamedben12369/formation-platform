@extends('dashboard')
@section('dashboard-section')
    <h2>Modifier le domaine</h2>
    <form method="POST" action="{{ route('domaines.update', $domaine) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ $domaine->nom }}" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ $domaine->description }}">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
