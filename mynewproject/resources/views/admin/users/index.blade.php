@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Utilisateurs</h2>
        <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary">Ajouter un utilisateur</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Date de naissance</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Question sécurité</th>
                    <th>Réponse</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->nom }}</td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->tel }}</td>
                    <td>{{ $user->date_de_naissance ? $user->date_de_naissance->format('Y-m-d') : '' }}</td>
                    <td>{{ $user->role ? $user->role->nom : '-' }}</td>
                    <td>
                        @if($user->is_active)
                            <span class="badge bg-success">Actif</span>
                        @else
                            <span class="badge bg-secondary">Inactif</span>
                        @endif
                    </td>
                    <td>{{ $user->securiteQuestion->question ?? '' }}</td>
                    <td>{{ $user->reponse }}</td>
                    <td>
                        @foreach($user->permissions as $permission)
                            <span class="badge bg-info text-dark">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-sm btn-warning">Éditer</a>
                        <form action="{{ route('dashboard.users.destroy', $user) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
