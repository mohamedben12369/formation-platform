@extends('layouts.app')
@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="container mt-4">
    <h1>Gestion des Thèmes de Formation</h1>

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
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addThemeModal">
        <img src="{{ asset('images/add.webp') }}" alt="Ajouter" width="20" height="20" class="me-1">
        Ajouter un Thème
    </button>

    <!-- Tableau des thèmes -->
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Prix</th>
                    <th>Durée</th>
                    <th>Prérequis</th>
                    <th>Compétences visées</th>
                    <th>Sous-Domaine</th>
                    <th>Axe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($themes as $theme)
                <tr>
                    <td>{{ $theme->idtheme }}</td>
                    <td>{{ $theme->titre }}</td>
                    <td>{{ $theme->prix ? number_format($theme->prix, 2) . ' DH' : 'Non défini' }}</td>
                    <td>{{ $theme->duree ? $theme->duree . ' heures' : 'Non défini' }}</td>
                    <td data-full-text="{{ $theme->prerequis }}" data-bs-toggle="tooltip">{{ $theme->prerequis ? Str::limit($theme->prerequis, 50) : 'Aucun' }}</td>
                    <td data-full-text="{{ $theme->competence_visees }}" data-bs-toggle="tooltip">{{ $theme->competence_visees ? Str::limit($theme->competence_visees, 50) : 'Non défini' }}</td>
                    <td>{{ $theme->sousDomaine ? $theme->sousDomaine->description : 'Non défini' }}</td>
                    <td>{{ $theme->axe ? $theme->axe->nom : 'Non défini' }}</td>
                    <td>
                        <button class="btn btn-sm btn-light me-1" data-bs-toggle="modal" data-bs-target="#editThemeModal{{ $theme->idtheme }}" title="Modifier">
                            <img src="{{ asset('images/edit.webp') }}" alt="Modifier" width="16" height="16">
                        </button>
                        <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#deleteThemeModal{{ $theme->idtheme }}" title="Supprimer">
                            <img src="{{ asset('images/delete.webp') }}" alt="Supprimer" width="16" height="16">
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal d'ajout -->
    <div class="modal fade" id="addThemeModal" tabindex="-1" aria-labelledby="addThemeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('dashboard.theme-formations.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-gradient-info text-white">
                        <h5 class="modal-title" id="addThemeModalLabel">Ajouter un nouveau thème</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titre" class="form-label">Titre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="titre" name="titre" required value="{{ old('titre') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="sous_domaine_code" class="form-label">Sous-Domaine <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control mb-2" id="search_sous_domaine" placeholder="Rechercher un sous-domaine...">
                                    <select class="form-select" id="sous_domaine_code" name="sous_domaine_code" required size="5">
                                        <option value="">Sélectionner un sous-domaine</option>
                                        @foreach($sous_domaines as $sousDomaine)
                                            <option value="{{ $sousDomaine->code }}" {{ old('sous_domaine_code') == $sousDomaine->code ? 'selected' : '' }}>
                                                {{ $sousDomaine->code }} - {{ $sousDomaine->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="axes_id" class="form-label">Axe <span class="text-danger">*</span></label>
                                    <select class="form-select" id="axes_id" name="axes_id" required>
                                        <option value="">Sélectionner un axe</option>
                                        @foreach($axes as $axe)
                                            <option value="{{ $axe->id }}" {{ old('axes_id') == $axe->id ? 'selected' : '' }}>
                                                {{ $axe->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="prix" class="form-label">Prix (DH)</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="prix" name="prix" value="{{ old('prix') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="duree" class="form-label">Durée (heures)</label>
                                    <input type="number" min="1" class="form-control" id="duree" name="duree" value="{{ old('duree') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prerequis" class="form-label">Prérequis</label>
                                    <textarea class="form-control" id="prerequis" name="prerequis" rows="3">{{ old('prerequis') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="competence_visees" class="form-label">Compétences visées</label>
                                    <textarea class="form-control" id="competence_visees" name="competence_visees" rows="3">{{ old('competence_visees') }}</textarea>
                                </div>
                            </div>
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
    
    <!-- Modals d'édition -->
    @foreach($themes as $theme)
    <div class="modal fade" id="editThemeModal{{ $theme->idtheme }}" tabindex="-1" aria-labelledby="editThemeModalLabel{{ $theme->idtheme }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('dashboard.theme-formations.update', $theme->idtheme) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-gradient-info text-white">
                        <h5 class="modal-title" id="editThemeModalLabel{{ $theme->idtheme }}">Modifier le thème</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_titre{{ $theme->idtheme }}" class="form-label">Titre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_titre{{ $theme->idtheme }}" name="titre" required value="{{ $theme->titre }}">
                                </div>

                                <div class="mb-3">
                                    <label for="edit_sous_domaine_code{{ $theme->idtheme }}" class="form-label">Sous-Domaine <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control mb-2" id="edit_search_sous_domaine{{ $theme->idtheme }}" placeholder="Rechercher un sous-domaine...">
                                    <select class="form-select" id="edit_sous_domaine_code{{ $theme->idtheme }}" name="sous_domaine_code" required size="5">
                                        <option value="">Sélectionner un sous-domaine</option>
                                        @foreach($sous_domaines as $sousDomaine)
                                            <option value="{{ $sousDomaine->code }}" {{ $theme->sous_domaine_code == $sousDomaine->code ? 'selected' : '' }}>
                                                {{ $sousDomaine->code }} - {{ $sousDomaine->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_axes_id{{ $theme->idtheme }}" class="form-label">Axe <span class="text-danger">*</span></label>
                                    <select class="form-select" id="edit_axes_id{{ $theme->idtheme }}" name="axes_id" required>
                                        <option value="">Sélectionner un axe</option>
                                        @foreach($axes as $axe)
                                            <option value="{{ $axe->id }}" {{ $theme->axes_id == $axe->id ? 'selected' : '' }}>
                                                {{ $axe->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_prix{{ $theme->idtheme }}" class="form-label">Prix (DH)</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="edit_prix{{ $theme->idtheme }}" name="prix" value="{{ $theme->prix }}">
                                </div>

                                <div class="mb-3">
                                    <label for="edit_duree{{ $theme->idtheme }}" class="form-label">Durée (heures)</label>
                                    <input type="number" min="1" class="form-control" id="edit_duree{{ $theme->idtheme }}" name="duree" value="{{ $theme->duree }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_prerequis{{ $theme->idtheme }}" class="form-label">Prérequis</label>
                                    <textarea class="form-control" id="edit_prerequis{{ $theme->idtheme }}" name="prerequis" rows="3">{{ $theme->prerequis }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_competence_visees{{ $theme->idtheme }}" class="form-label">Compétences visées</label>
                                    <textarea class="form-control" id="edit_competence_visees{{ $theme->idtheme }}" name="competence_visees" rows="3">{{ $theme->competence_visees }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modals de suppression -->
    @foreach($themes as $theme)
    <div class="modal fade" id="deleteThemeModal{{ $theme->idtheme }}" tabindex="-1" aria-labelledby="deleteThemeModalLabel{{ $theme->idtheme }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.theme-formations.destroy', $theme->idtheme) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteThemeModalLabel{{ $theme->idtheme }}">Confirmer la suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer le thème : <strong>{{ $theme->titre }}</strong> ?</p>
                        <p class="text-danger"><small>Cette action est irréversible.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour initialiser la recherche sur un select de sous-domaines
    function initSousDomaineSearch(searchInputId, selectId) {
        const searchInput = document.getElementById(searchInputId);
        const sousDomaineSelect = document.getElementById(selectId);
        
        if (searchInput && sousDomaineSelect) {
            // Sauvegarder toutes les options originales
            const originalOptions = Array.from(sousDomaineSelect.options);
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                // Vider le select
                sousDomaineSelect.innerHTML = '';
                
                // Filtrer et afficher les options correspondantes
                originalOptions.forEach(option => {
                    const text = option.textContent.toLowerCase();
                    const value = option.value.toLowerCase();
                    
                    if (text.includes(searchTerm) || value.includes(searchTerm) || searchTerm === '') {
                        sousDomaineSelect.appendChild(option.cloneNode(true));
                    }
                });
                
                // Si aucun résultat, afficher un message
                if (sousDomaineSelect.options.length === 0) {
                    const noResult = document.createElement('option');
                    noResult.textContent = 'Aucun résultat trouvé';
                    noResult.value = '';
                    noResult.disabled = true;
                    sousDomaineSelect.appendChild(noResult);
                }
            });
            
            // Au clic sur le select, vider la recherche pour tout voir
            sousDomaineSelect.addEventListener('focus', function() {
                if (searchInput.value === '') {
                    // Réafficher toutes les options
                    sousDomaineSelect.innerHTML = '';
                    originalOptions.forEach(option => {
                        sousDomaineSelect.appendChild(option.cloneNode(true));
                    });
                }
            });
        }
    }
    
    // Initialiser la recherche pour le modal d'ajout
    initSousDomaineSearch('search_sous_domaine', 'sous_domaine_code');
    
    // Initialiser la recherche pour tous les modals d'édition
    @foreach($themes as $theme)
        initSousDomaineSearch('edit_search_sous_domaine{{ $theme->idtheme }}', 'edit_sous_domaine_code{{ $theme->idtheme }}');
    @endforeach
    
    // Gestion des erreurs de validation
    @if($errors->any())
        var addThemeModal = new bootstrap.Modal(document.getElementById('addThemeModal'));
        addThemeModal.show();
    @endif
});
</script>
@endpush
@endsection