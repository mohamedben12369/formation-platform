@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Ajouter une Formation</h5>
                    <a href="{{ route('dashboard.formations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif                    <form method="POST" action="{{ route('dashboard.formations.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Nom de la formation -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la formation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Informations de base -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="dateDebut" class="form-label">Date de début <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('dateDebut') is-invalid @enderror" 
                                       id="dateDebut" name="dateDebut" value="{{ old('dateDebut') }}" required>
                                @error('dateDebut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dateFin" class="form-label">Date de fin <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('dateFin') is-invalid @enderror" 
                                       id="dateFin" name="dateFin" value="{{ old('dateFin') }}" required>
                                @error('dateFin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="lieu" class="form-label">Lieu <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lieu') is-invalid @enderror" 
                                       id="lieu" name="lieu" value="{{ old('lieu') }}" required>
                                @error('lieu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="DatedeCreation" class="form-label">Date de création</label>
                                <input type="date" class="form-control @error('DatedeCreation') is-invalid @enderror" 
                                       id="DatedeCreation" name="DatedeCreation" value="{{ old('DatedeCreation', date('Y-m-d')) }}">
                                @error('DatedeCreation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Effectifs -->
                        <h6 class="text-primary mb-3"><i class="fas fa-users me-2"></i>Effectifs cibles</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nombre_ouvriers" class="form-label">Nombre d'ouvriers</label>
                                <input type="number" class="form-control @error('nombre_ouvriers') is-invalid @enderror" 
                                       id="nombre_ouvriers" name="nombre_ouvriers" value="{{ old('nombre_ouvriers', 0) }}" min="0">
                                @error('nombre_ouvriers')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nombre_encadrants" class="form-label">Nombre d'encadrants</label>
                                <input type="number" class="form-control @error('nombre_encadrants') is-invalid @enderror" 
                                       id="nombre_encadrants" name="nombre_encadrants" value="{{ old('nombre_encadrants', 0) }}" min="0">
                                @error('nombre_encadrants')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nombre_cadres" class="form-label">Nombre de cadres</label>
                                <input type="number" class="form-control @error('nombre_cadres') is-invalid @enderror" 
                                       id="nombre_cadres" name="nombre_cadres" value="{{ old('nombre_cadres', 0) }}" min="0">
                                @error('nombre_cadres')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Sélecteurs principaux -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="type_formation_id" class="form-label">Type de formation <span class="text-danger">*</span></label>
                                <select class="form-control @error('type_formation_id') is-invalid @enderror" 
                                        id="type_formation_id" name="type_formation_id" required>
                                    <option value="">Sélectionner un type</option>
                                    @foreach($typeFormations as $type)
                                        <option value="{{ $type->id }}" {{ old('type_formation_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_formation_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="statut_formation_id" class="form-label">Statut <span class="text-danger">*</span></label>
                                <select class="form-control @error('statut_formation_id') is-invalid @enderror" 
                                        id="statut_formation_id" name="statut_formation_id" required>
                                    <option value="">Sélectionner un statut</option>
                                    @foreach($statutFormations as $statut)
                                        <option value="{{ $statut->id }}" {{ old('statut_formation_id') == $statut->id ? 'selected' : '' }}>
                                            {{ $statut->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('statut_formation_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="domaine_id" class="form-label">Domaine <span class="text-danger">*</span></label>
                                <select class="form-control @error('domaine_id') is-invalid @enderror" 
                                        id="domaine_id" name="domaine_id" required>
                                    <option value="">Sélectionner un domaine</option>
                                    @foreach($domaines as $domaine)
                                        <option value="{{ $domaine->id }}" {{ old('domaine_id') == $domaine->id ? 'selected' : '' }}>
                                            {{ $domaine->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('domaine_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="entreprise_id" class="form-label">Entreprise <span class="text-danger">*</span></label>
                                <select class="form-control @error('entreprise_id') is-invalid @enderror" 
                                        id="entreprise_id" name="entreprise_id" required>
                                    <option value="">Sélectionner une entreprise</option>
                                    @foreach($entreprises as $entreprise)
                                        <option value="{{ $entreprise->id }}" {{ old('entreprise_id') == $entreprise->id ? 'selected' : '' }}>
                                            {{ $entreprise->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('entreprise_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Moyennes -->
                        <div class="mb-3">
                            <label for="moyennes" class="form-label">Moyennes attendues</label>
                            <textarea class="form-control @error('moyennes') is-invalid @enderror" 
                                      id="moyennes" name="moyennes" rows="2" 
                                      placeholder="Moyennes d'évaluation attendues...">{{ old('moyennes') }}</textarea>
                            @error('moyennes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Thèmes de formation -->
                        <div class="mb-3">
                            <label class="form-label">Thèmes de formation <span class="text-danger">*</span></label>
                            <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                @foreach($themeFormations as $theme)
                                    <div class="form-check">
                                        <input class="form-check-input theme-checkbox" type="checkbox" 
                                               name="themes[]" value="{{ $theme->idtheme }}" 
                                               id="theme{{ $theme->idtheme }}"
                                               data-prix="{{ $theme->prix }}" 
                                               data-duree="{{ $theme->duree }}"
                                               {{ in_array($theme->idtheme, old('themes', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="theme{{ $theme->idtheme }}">
                                            {{ $theme->titre }} 
                                            <small class="text-muted">({{ $theme->prix }} DH - {{ $theme->duree }}h)</small>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('themes')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Formateurs -->
                        <div class="mb-3">
                            <label class="form-label">Formateurs</label>
                            <div class="border rounded p-3" style="max-height: 150px; overflow-y: auto;">
                                @foreach($formateurs as $formateur)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               name="formateurs[]" value="{{ $formateur->id }}" 
                                               id="formateur{{ $formateur->id }}"
                                               {{ in_array($formateur->id, old('formateurs', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="formateur{{ $formateur->id }}">
                                            {{ $formateur->name }} {{ $formateur->prenom }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>                        <!-- Textes descriptifs -->
                        <div class="mb-3">
                            <label for="programme" class="form-label">Programme <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('programme') is-invalid @enderror" 
                                      id="programme" name="programme" rows="4" 
                                      placeholder="Détail du programme de formation..." required>{{ old('programme') }}</textarea>
                            @error('programme')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="objectifs" class="form-label">Objectifs <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('objectifs') is-invalid @enderror" 
                                      id="objectifs" name="objectifs" rows="3" 
                                      placeholder="Objectifs pédagogiques de la formation..." required>{{ old('objectifs') }}</textarea>
                            @error('objectifs')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fichiers -->
                        <h6 class="text-primary mb-3"><i class="fas fa-file me-2"></i>Documents</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Image de la formation</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       id="image" name="image" accept="image/*">
                                <small class="form-text text-muted">Formats acceptés: JPG, PNG, GIF (max: 2MB)</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="document_pdf" class="form-label">Document PDF</label>
                                <input type="file" class="form-control @error('document_pdf') is-invalid @enderror" 
                                       id="document_pdf" name="document_pdf" accept=".pdf">
                                <small class="form-text text-muted">Format accepté: PDF (max: 10MB)</small>
                                @error('document_pdf')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>                        <!-- Résumé calculé -->
                        <div class="alert alert-info">
                            <h6><i class="fas fa-calculator me-2"></i>Résumé calculé</h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Prix total :</strong> <span id="prix-total">0.00</span> DH
                                </div>
                                <div class="col-md-3">
                                    <strong>Durée totale :</strong> <span id="duree-totale">0</span> heures
                                </div>
                                <div class="col-md-3">
                                    <strong>Thèmes sélectionnés :</strong> <span id="nombre-themes">0</span>
                                </div>
                                <div class="col-md-3">
                                    <strong>Total participants :</strong> <span id="total-participants">0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard.formations.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const themeCheckboxes = document.querySelectorAll('.theme-checkbox');
    const prixTotalSpan = document.getElementById('prix-total');
    const dureeTotaleSpan = document.getElementById('duree-totale');
    const nombreThemesSpan = document.getElementById('nombre-themes');
    const totalParticipantsSpan = document.getElementById('total-participants');
    
    // Champs pour calculer le total des participants
    const nombreOuvriers = document.getElementById('nombre_ouvriers');
    const nombreEncadrants = document.getElementById('nombre_encadrants');
    const nombreCadres = document.getElementById('nombre_cadres');

    function updateCalculatedValues() {
        let totalPrix = 0;
        let totalDuree = 0;
        let nombreThemes = 0;

        themeCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                totalPrix += parseFloat(checkbox.dataset.prix) || 0;
                totalDuree += parseInt(checkbox.dataset.duree) || 0;
                nombreThemes++;
            }
        });

        prixTotalSpan.textContent = totalPrix.toFixed(2);
        dureeTotaleSpan.textContent = totalDuree;
        nombreThemesSpan.textContent = nombreThemes;
        
        updateTotalParticipants();
    }

    function updateTotalParticipants() {
        const ouvriers = parseInt(nombreOuvriers.value) || 0;
        const encadrants = parseInt(nombreEncadrants.value) || 0;
        const cadres = parseInt(nombreCadres.value) || 0;
        const total = ouvriers + encadrants + cadres;
        
        totalParticipantsSpan.textContent = total;
    }

    // Event listeners pour les thèmes
    themeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCalculatedValues);
    });

    // Event listeners pour les effectifs
    [nombreOuvriers, nombreEncadrants, nombreCadres].forEach(input => {
        input.addEventListener('input', updateTotalParticipants);
    });

    // Calcul initial
    updateCalculatedValues();
    updateTotalParticipants();
});
</script>
@endsection
