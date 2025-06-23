@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Gestion des Types de Diplômes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Bouton pour ouvrir le modal d'ajout -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTypeDiplomeModal">Ajouter un Type de Diplôme</button>

    <!-- Tableau des types de diplômes -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($typeDiplomes as $typeDiplome)
                <tr>
                    <td>{{ $typeDiplome->nom }}</td>
                    <td>{{ $typeDiplome->description }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTypeDiplomeModal{{ $typeDiplome->id }}">
                            Modifier
                        </button>
                        <form action="{{ route('dashboard.type-diplomes.destroy', $typeDiplome->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de diplôme ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal d'ajout -->
    <div class="modal fade" id="addTypeDiplomeModal" tabindex="-1" aria-labelledby="addTypeDiplomeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.type-diplomes.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-gradient-info text-white">
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
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-info text-white">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modals d'édition -->
    @foreach($typeDiplomes as $typeDiplome)
    <div class="modal fade" id="editTypeDiplomeModal{{ $typeDiplome->id }}" tabindex="-1" aria-labelledby="editTypeDiplomeModalLabel{{ $typeDiplome->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.type-diplomes.update', $typeDiplome->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-gradient-info text-white">
                        <h5 class="modal-title" id="editTypeDiplomeModalLabel{{ $typeDiplome->id }}">Modifier le Type de Diplôme</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_nom{{ $typeDiplome->id }}" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="edit_nom{{ $typeDiplome->id }}" name="nom" value="{{ old('nom', $typeDiplome->nom) }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edit_description{{ $typeDiplome->id }}" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="edit_description{{ $typeDiplome->id }}" name="description" rows="3">{{ old('description', $typeDiplome->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-info text-white">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection 