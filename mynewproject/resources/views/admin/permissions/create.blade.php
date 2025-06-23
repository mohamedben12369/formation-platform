@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Créer une permission</h2>
    <form action="{{ route('dashboard.permissions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la permission</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{ route('dashboard.permissions.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
