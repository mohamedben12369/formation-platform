@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Créer un rôle</h2>
    <form action="{{ route('dashboard.roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du rôle</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="permissions" class="form-label">Permissions</label>
            <select multiple class="form-control" id="permissions" name="permissions[]">
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{ route('dashboard.roles.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
