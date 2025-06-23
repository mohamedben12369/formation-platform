@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Gestion des Types de Diplômes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Bouton pour ouvrir le modal d'ajout -->
    <button class="btn btn-primary mb-3 w-100" data-bs-toggle="modal" data-bs-target="#addTypeDiplomeModal">Ajouter un Type de Diplôme</button>
    <!-- Modal d'ajout -->
    <div class="modal fade" id="addTypeDiplomeModal" tabindex="-1" aria-labelledby="addTypeDiplomeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('dashboard.type-diplomes.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTypeDiplomeModalLabel">Ajouter un Type de Diplôme</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
            <tr>
                <td>{{ $type->nom }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTypeDiplomeModal{{ $type->id }}">Modifier</button>
                    <form action="{{ route('dashboard.type-diplomes.destroy', $type->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de diplôme ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            <!-- Modal d'édition -->
            <div class="modal fade" id="editTypeDiplomeModal{{ $type->id }}" tabindex="-1" aria-labelledby="editTypeDiplomeModalLabel{{ $type->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('dashboard.type-diplomes.update', $type->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTypeDiplomeModalLabel{{ $type->id }}">Modifier Type de Diplôme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit_nom{{ $type->id }}" class="form-label">Nom</label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="edit_nom{{ $type->id }}" name="nom" value="{{ old('nom', $type->nom) }}" required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
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