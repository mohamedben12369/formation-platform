@extends('dashboard')
@section('dashboard-section')
<div class="dashboard-card">
    <h3>Ajouter un rôle</h3>
    <form method="POST" action="{{ route('roles.store') }}">
        @csrf
        <input type="text" name="nom" placeholder="Nom du rôle" required>
        <input type="text" name="permession" placeholder="Permission (optionnel)">
        <input type="text" name="color" placeholder="Couleur (optionnel)">
        <input type="text" name="icon" placeholder="Icône (optionnel)">
        <button type="submit">Ajouter</button>
    </form>
</div>
<div class="dashboard-card">
    <h3>Rôles</h3>
    <table class="dashboard-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Permission</th>
                <th>Couleur</th>
                <th>Icône</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->nom }}</td>
                <td>{{ $role->permession }}</td>
                <td>{{ $role->color }}</td>
                <td>{{ $role->icon }}</td>
                <td>
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce rôle ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('styles')
    @vite('resources/css/roles-section.css')
@endpush
