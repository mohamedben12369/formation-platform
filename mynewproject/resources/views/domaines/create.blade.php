@extends('dashboard')
@section('dashboard-section')
    <h2>Ajouter un domaine</h2>
    <form method="POST" action="{{ route('domaines.store') }}">
        @csrf
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
@endsection
