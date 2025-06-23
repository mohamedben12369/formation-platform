@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Liste des permissions</h2>
    <a href="{{ route('dashboard.permissions.create') }}" class="btn btn-success mb-3">Ajouter une permission</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->nom }}</td>
                    <td>
                        <a href="{{ route('dashboard.permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
