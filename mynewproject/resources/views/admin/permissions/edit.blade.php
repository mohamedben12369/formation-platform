@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Modifier la permission</h2>
    <form action="{{ route('dashboard.permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la permission</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $permission->nom) }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('dashboard.permissions.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
