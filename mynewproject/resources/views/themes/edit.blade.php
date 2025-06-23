@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-edit me-2"></i>Modifier le thème de formation
                        </h4>
                        <a href="{{ route('dashboard.theme-formations.index') }}" class="btn btn-dark btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation :</h6>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Informations actuelles -->
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle me-2"></i>Informations actuelles :</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>ID:</strong> {{ $theme->idtheme }}</p>
                                <p class="mb-1"><strong>Titre actuel:</strong> {{ $theme->titre }}</p>
                                <p class="mb-0"><strong>Prix actuel:</strong> {{ $theme->prix ? number_format($theme->prix, 2) . ' DH' : 'Non défini' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Durée actuelle:</strong> {{ $theme->duree ? $theme->duree . ' heures' : 'Non défini' }}</p>
                                <p class="mb-1"><strong>Axe actuel:</strong> {{ $theme->axe ? $theme->axe->nom : 'Non défini' }}</p>
                                <p class="mb-0"><strong>Sous-domaine actuel:</strong> {{ $theme->sousDomaine ? $theme->sousDomaine->description : 'Non défini' }}</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('dashboard.theme-formations.update', $theme->idtheme) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titre" class="form-label">
                                        Titre <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('titre') is-invalid @enderror" 
                                           id="titre" 
                                           name="titre" 
                                           value="{{ old('titre', $theme->titre) }}" 
                                           required
                                           placeholder="Saisir le titre du thème">
                                    @error('titre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sous_domaine_code" class="form-label">
                                        Sous-Domaine <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control mb-2" 
                                           id="search_sous_domaine" 
                                           placeholder="Rechercher un sous-domaine...">
                                    <select class="form-select @error('sous_domaine_code') is-invalid @enderror" 
                                            id="sous_domaine_code" 
                                            name="sous_domaine_code" 
                                            required 
                                            size="5">
                                        <option value="">Sélectionner un sous-domaine</option>
                                        @foreach($sous_domaines as $sousDomaine)
                                            <option value="{{ $sousDomaine->code }}" 
                                                    {{ old('sous_domaine_code', $theme->sous_domaine_code) == $sousDomaine->code ? 'selected' : '' }}>
                                                {{ $sousDomaine->code }} - {{ $sousDomaine->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sous_domaine_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="axes_id" class="form-label">
                                        Axe <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('axes_id') is-invalid @enderror" 
                                            id="axes_id" 
                                            name="axes_id" 
                                            required>
                                        <option value="">Sélectionner un axe</option>
                                        @foreach($axes as $axe)
                                            <option value="{{ $axe->id }}" 
                                                    {{ old('axes_id', $theme->axes_id) == $axe->id ? 'selected' : '' }}>
                                                {{ $axe->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('axes_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="prix" class="form-label">Prix (DH)</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               step="0.01" 
                                               min="0" 
                                               class="form-control @error('prix') is-invalid @enderror" 
                                               id="prix" 
                                               name="prix" 
                                               value="{{ old('prix', $theme->prix) }}"
                                               placeholder="0.00">
                                        <span class="input-group-text">DH</span>
                                        @error('prix')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="duree" class="form-label">Durée (heures)</label>
                                    <div class="input-group">
                                        <input type="number" 
                                               min="1" 
                                               class="form-control @error('duree') is-invalid @enderror" 
                                               id="duree" 
                                               name="duree" 
                                               value="{{ old('duree', $theme->duree) }}"
                                               placeholder="Nombre d'heures">
                                        <span class="input-group-text">h</span>
                                        @error('duree')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prerequis" class="form-label">
                                        Prérequis
                                        <small class="text-muted">(optionnel)</small>
                                    </label>
                                    <textarea class="form-control @error('prerequis') is-invalid @enderror" 
                                              id="prerequis" 
                                              name="prerequis" 
                                              rows="4"
                                              placeholder="Décrivez les prérequis nécessaires...">{{ old('prerequis', $theme->prerequis) }}</textarea>
                                    @error('prerequis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <small>Maximum 1000 caractères</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="competence_visees" class="form-label">
                                        Compétences visées
                                        <small class="text-muted">(optionnel)</small>
                                    </label>
                                    <textarea class="form-control @error('competence_visees') is-invalid @enderror" 
                                              id="competence_visees" 
                                              name="competence_visees" 
                                              rows="4"
                                              placeholder="Décrivez les compétences visées...">{{ old('competence_visees', $theme->competence_visees) }}</textarea>
                                    @error('competence_visees')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <small>Maximum 1000 caractères</small>
                                    </div>
                                </div>

                                <!-- Comparaison avant/après -->
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="fas fa-exchange-alt me-2"></i>Comparaison
                                        </h6>
                                        <div id="comparison-content">
                                            <div class="row">
                                                <div class="col-6">
                                                    <small class="text-muted">Avant</small>
                                                    <p class="mb-1"><strong>{{ $theme->titre }}</strong></p>
                                                    <p class="mb-1">{{ $theme->prix ? number_format($theme->prix, 2) . ' DH' : 'Prix non défini' }}</p>
                                                    <p class="mb-0">{{ $theme->duree ? $theme->duree . 'h' : 'Durée non définie' }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Après</small>
                                                    <p class="mb-1" id="new-titre"><strong>{{ $theme->titre }}</strong></p>
                                                    <p class="mb-1" id="new-prix">{{ $theme->prix ? number_format($theme->prix, 2) . ' DH' : 'Prix non défini' }}</p>
                                                    <p class="mb-0" id="new-duree">{{ $theme->duree ? $theme->duree . 'h' : 'Durée non définie' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('dashboard.theme-formations.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i>Annuler
                                    </a>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-save me-1"></i>Enregistrer les modifications
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour initialiser la recherche sur le select de sous-domaines
    function initSousDomaineSearch() {
        const searchInput = document.getElementById('search_sous_domaine');
        const sousDomaineSelect = document.getElementById('sous_domaine_code');
        
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
    
    // Initialiser la recherche
    initSousDomaineSearch();
    
    // Comparaison en temps réel
    function updateComparison() {
        const titre = document.getElementById('titre').value || '{{ $theme->titre }}';
        const prix = document.getElementById('prix').value;
        const duree = document.getElementById('duree').value;
        
        document.getElementById('new-titre').innerHTML = '<strong>' + titre + '</strong>';
        document.getElementById('new-prix').textContent = prix ? prix + ' DH' : 'Prix non défini';
        document.getElementById('new-duree').textContent = duree ? duree + 'h' : 'Durée non définie';
        
        // Mise en évidence des changements
        const originalTitre = '{{ $theme->titre }}';
        const originalPrix = '{{ $theme->prix }}';
        const originalDuree = '{{ $theme->duree }}';
        
        if (titre !== originalTitre) {
            document.getElementById('new-titre').classList.add('text-warning');
        } else {
            document.getElementById('new-titre').classList.remove('text-warning');
        }
        
        if (prix !== originalPrix) {
            document.getElementById('new-prix').classList.add('text-warning');
        } else {
            document.getElementById('new-prix').classList.remove('text-warning');
        }
        
        if (duree !== originalDuree) {
            document.getElementById('new-duree').classList.add('text-warning');
        } else {
            document.getElementById('new-duree').classList.remove('text-warning');
        }
    }
    
    // Écouter les modifications des champs
    document.getElementById('titre').addEventListener('input', updateComparison);
    document.getElementById('prix').addEventListener('input', updateComparison);
    document.getElementById('duree').addEventListener('input', updateComparison);
    
    // Compteur de caractères pour les textareas
    function addCharacterCounter(textareaId, maxLength) {
        const textarea = document.getElementById(textareaId);
        const counter = document.createElement('small');
        counter.className = 'text-muted';
        counter.style.float = 'right';
        
        textarea.parentNode.appendChild(counter);
        
        function updateCounter() {
            const length = textarea.value.length;
            counter.textContent = `${length}/${maxLength} caractères`;
            
            if (length > maxLength * 0.9) {
                counter.className = 'text-warning';
            } else if (length > maxLength) {
                counter.className = 'text-danger';
            } else {
                counter.className = 'text-muted';
            }
        }
        
        textarea.addEventListener('input', updateCounter);
        updateCounter();
    }
    
    // Ajouter les compteurs
    addCharacterCounter('prerequis', 1000);
    addCharacterCounter('competence_visees', 1000);
    
    // Initialiser la comparaison
    updateComparison();
});
</script>
@endpush

@push('styles')
<style>
.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.is-invalid {
    border-color: #dc3545;
}

.is-invalid:focus {
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.input-group-text {
    background-color: #e9ecef;
    border-color: #ced4da;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.text-muted {
    color: #6c757d !important;
}

.text-warning {
    color: #f57c00 !important;
    font-weight: bold;
}

.alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
}

#comparison-content p {
    font-size: 0.9em;
}
</style>
@endpush
@endsection
