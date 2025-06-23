@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Gestion des Niveaux</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Bouton pour ouvrir le modal d'ajout -->
    <button class="btn btn-success mb-3 w-100" data-bs-toggle="modal" data-bs-target="#addNiveauModal">
        <img src="{{ asset('images/add.webp') }}" alt="Ajouter" width="18" height="18">
    </button>
    
    <!-- Modal d'ajout -->
    <div class="modal fade" id="addNiveauModal" tabindex="-1" aria-labelledby="addNiveauModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('dashboard.niveaux.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNiveauModalLabel">Ajouter un Niveau</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="niveau-nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="niveau-nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="niveau-description" class="form-label">Description</label>
                            <textarea class="form-control" id="niveau-description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($niveaux ?? [] as $niveau)
            <tr>
                <td>{{ $niveau->nom }}</td>
                <td>{{ $niveau->description }}</td>
                <td>
                    <!-- Bouton pour ouvrir le modal d'édition -->
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editNiveauModal{{ $niveau->id }}">
                        <img src="{{ asset('images/edit.webp') }}" alt="Modifier" width="18" height="18">
                    </button>
                    <form action="{{ route('dashboard.niveaux.destroy', $niveau->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce niveau ?')">
                            <img src="{{ asset('images/delete.webp') }}" alt="Supprimer" width="18" height="18">
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Modal d'édition -->
            <div class="modal fade" id="editNiveauModal{{ $niveau->id }}" tabindex="-1" aria-labelledby="editNiveauModalLabel{{ $niveau->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('dashboard.niveaux.update', $niveau->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editNiveauModalLabel{{ $niveau->id }}">Modifier Niveau</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nom{{ $niveau->id }}" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom{{ $niveau->id }}" name="nom" value="{{ $niveau->nom }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description{{ $niveau->id }}" class="form-label">Description</label>
                                    <textarea class="form-control" id="description{{ $niveau->id }}" name="description" rows="3">{{ $niveau->description }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <img src="{{ asset('images/close.webp') }}" alt="Annuler" width="18" height="18">
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <img src="{{ asset('images/confirm.png') }}" alt="Enregistrer" width="18" height="18">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-sm {
        margin-right: 5px;
    }
</style>
@endpush 