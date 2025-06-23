@extends('layouts.app')

@section('title', 'Candidater à la formation')

@push('styles')
<style>
.alert-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.card.border-danger {
    border-color: #dc3545 !important;
}

.card.border-info {
    border-color: #17a2b8 !important;
}

.file-status {
    min-height: 20px;
}

input[readonly] {
    background-color: #f8f9fa !important;
    cursor: not-allowed !important;
}

.badge {
    font-size: 0.75em;
}

.card-body {
    position: relative;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>
                        Candidater à la formation : {{ $formation->nom }}
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Informations de la formation -->
                    <div class="alert alert-info mb-4">
                        <h6><i class="fas fa-info-circle me-2"></i>Informations sur la formation</h6>
                        <p class="mb-1"><strong>Nom :</strong> {{ $formation->nom }}</p>
                        <p class="mb-1"><strong>Prix :</strong> {{ number_format($formation->prix_total, 0, ',', ' ') }} FCFA</p>
                        <p class="mb-1"><strong>Durée :</strong> {{ $formation->duree_totale }} heures</p>
                        @if($formation->date_debut)
                            <p class="mb-0"><strong>Date de début :</strong> {{ $formation->date_debut->format('d/m/Y') }}</p>
                        @endif
                    </div>

                    <form action="{{ route('candidatures.store', $formation) }}" method="POST" enctype="multipart/form-data" id="candidatureForm">
                        @csrf
                        
                        <!-- Informations personnelles -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-user me-2"></i>Informations personnelles
                                </h6>
                            </div>                            <div class="col-md-6 mb-3">
                                <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('prenom') is-invalid @enderror" 
                                       id="prenom" 
                                       name="prenom" 
                                       value="{{ old('prenom', $user->prenom ?? '') }}" 
                                       {{ $user ? 'readonly' : '' }}
                                       required>
                                @if($user)
                                    <small class="form-text text-muted">Informations récupérées de votre profil</small>
                                @endif
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('nom') is-invalid @enderror" 
                                       id="nom" 
                                       name="nom" 
                                       value="{{ old('nom', $user->nom ?? '') }}" 
                                       {{ $user ? 'readonly' : '' }}
                                       required>
                                @if($user)
                                    <small class="form-text text-muted">Informations récupérées de votre profil</small>
                                @endif
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email ?? '') }}" 
                                       {{ $user ? 'readonly' : '' }}
                                       required>
                                @if($user)
                                    <small class="form-text text-muted">Informations récupérées de votre profil</small>
                                @endif
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                <input type="tel" 
                                       class="form-control @error('telephone') is-invalid @enderror" 
                                       id="telephone" 
                                       name="telephone" 
                                       value="{{ old('telephone', $user->telephone ?? '') }}" 
                                       required>
                                @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Lettre de motivation -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-heart me-2"></i>Motivation
                                </h6>
                                <div class="mb-3">
                                    <label for="motivation" class="form-label">Lettre de motivation</label>
                                    <textarea class="form-control @error('motivation') is-invalid @enderror" 
                                              id="motivation" 
                                              name="motivation" 
                                              rows="5" 
                                              placeholder="Expliquez pourquoi vous souhaitez suivre cette formation...">{{ old('motivation') }}</textarea>
                                    @error('motivation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>                        <!-- Documents -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-paperclip me-2"></i>Documents à joindre
                                </h6>
                                
                                @if($typeDocuments->where('obligatoire', true)->count() > 0)
                                <div class="alert alert-info mb-3">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Documents obligatoires :</strong> {{ $typeDocuments->where('obligatoire', true)->pluck('nom')->join(', ') }}
                                </div>
                                @endif

                                <!-- Documents obligatoires -->
                                @if($typeDocuments->where('obligatoire', true)->count() > 0)
                                <div class="mb-4">
                                    <h6 class="text-danger mb-3">
                                        <i class="fas fa-exclamation-circle me-2"></i>Documents obligatoires
                                    </h6>
                                    <div class="row">
                                        @foreach($typeDocuments->where('obligatoire', true) as $typeDocument)
                                        <div class="col-md-6 mb-3">
                                            <div class="card border-danger">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="{{ $typeDocument->icone ?? 'fas fa-file' }} me-2" 
                                                           style="color: {{ $typeDocument->couleur ?? '#dc3545' }}; font-size: 1.2em;"></i>
                                                        <strong>{{ $typeDocument->nom }}</strong>
                                                        <span class="badge bg-danger ms-2">Obligatoire</span>
                                                    </div>
                                                    @if($typeDocument->description)
                                                        <p class="text-muted small mb-2">{{ $typeDocument->description }}</p>
                                                    @endif
                                                    <input type="file" 
                                                           class="form-control @error('document_' . $typeDocument->id) is-invalid @enderror" 
                                                           id="document_{{ $typeDocument->id }}" 
                                                           name="document_{{ $typeDocument->id }}" 
                                                           accept="{{ $typeDocument->accept }}"
                                                           required>
                                                    <div class="mt-1">
                                                        <small class="text-muted">
                                                            <i class="fas fa-file-alt me-1"></i>{{ strtoupper($typeDocument->formats_autorises) }} 
                                                            | <i class="fas fa-weight-hanging me-1"></i>Max: {{ $typeDocument->taille_max_mb }}MB
                                                        </small>
                                                    </div>
                                                    @error('document_' . $typeDocument->id)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <!-- Documents optionnels -->
                                @if($typeDocuments->where('obligatoire', false)->count() > 0)
                                <div class="mb-3">
                                    <h6 class="text-info mb-3">
                                        <i class="fas fa-plus-circle me-2"></i>Documents optionnels
                                    </h6>
                                    <div class="row">
                                        @foreach($typeDocuments->where('obligatoire', false) as $typeDocument)
                                        <div class="col-md-6 mb-3">
                                            <div class="card border-info">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="{{ $typeDocument->icone ?? 'fas fa-file' }} me-2" 
                                                           style="color: {{ $typeDocument->couleur ?? '#17a2b8' }}; font-size: 1.2em;"></i>
                                                        <strong>{{ $typeDocument->nom }}</strong>
                                                        <span class="badge bg-info ms-2">Optionnel</span>
                                                    </div>
                                                    @if($typeDocument->description)
                                                        <p class="text-muted small mb-2">{{ $typeDocument->description }}</p>
                                                    @endif
                                                    <input type="file" 
                                                           class="form-control @error('document_' . $typeDocument->id) is-invalid @enderror" 
                                                           id="document_{{ $typeDocument->id }}" 
                                                           name="document_{{ $typeDocument->id }}" 
                                                           accept="{{ $typeDocument->accept }}">
                                                    <div class="mt-1">
                                                        <small class="text-muted">
                                                            <i class="fas fa-file-alt me-1"></i>{{ strtoupper($typeDocument->formats_autorises) }} 
                                                            | <i class="fas fa-weight-hanging me-1"></i>Max: {{ $typeDocument->taille_max_mb }}MB
                                                        </small>
                                                    </div>
                                                    @error('document_' . $typeDocument->id)
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if($typeDocuments->count() == 0)
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Aucun type de document n'est configuré pour le moment.
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('formations.show', $formation) }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Retour
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-2"></i>Soumettre ma candidature
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validation des fichiers côté client
    document.querySelectorAll('input[type="file"]').forEach(function(input) {
        input.addEventListener('change', function() {
            const file = this.files[0];
            const card = this.closest('.card');
            const statusDiv = card.querySelector('.file-status') || createStatusDiv(card);
            
            if (file) {
                // Récupérer la taille max depuis l'attribut data ou utiliser une valeur par défaut
                const typeDocumentId = this.name.replace('document_', '');
                const maxSizeMB = parseInt(this.getAttribute('data-max-size')) || {{ $typeDocuments->max('taille_max_mb') ?? 10 }};
                const maxSize = maxSizeMB * 1024 * 1024; // En octets
                
                // Vérifier la taille
                if (file.size > maxSize) {
                    this.value = '';
                    showFileError(statusDiv, 'Fichier trop volumineux. Taille maximum : ' + maxSizeMB + 'MB');
                    return;
                }
                
                // Vérifier le format
                const allowedFormats = this.getAttribute('accept').split(',').map(f => f.trim());
                const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
                if (!allowedFormats.includes(fileExtension)) {
                    this.value = '';
                    showFileError(statusDiv, 'Format non autorisé. Formats acceptés : ' + allowedFormats.join(', '));
                    return;
                }
                
                // Afficher le succès
                showFileSuccess(statusDiv, file);
            } else {
                clearFileStatus(statusDiv);
            }
        });
    });

    function createStatusDiv(card) {
        const statusDiv = document.createElement('div');
        statusDiv.className = 'file-status mt-2';
        card.querySelector('.card-body').appendChild(statusDiv);
        return statusDiv;
    }

    function showFileError(statusDiv, message) {
        statusDiv.innerHTML = `
            <div class="alert alert-danger alert-sm py-1 px-2 mb-0">
                <i class="fas fa-exclamation-triangle me-1"></i>
                <small>${message}</small>
            </div>
        `;
    }

    function showFileSuccess(statusDiv, file) {
        const fileSizeKB = Math.round(file.size / 1024);
        const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);
        const displaySize = fileSizeKB < 1024 ? fileSizeKB + ' KB' : fileSizeMB + ' MB';
        
        statusDiv.innerHTML = `
            <div class="alert alert-success alert-sm py-1 px-2 mb-0">
                <i class="fas fa-check-circle me-1"></i>
                <small><strong>${file.name}</strong> (${displaySize})</small>
            </div>
        `;
    }

    function clearFileStatus(statusDiv) {
        if (statusDiv) {
            statusDiv.innerHTML = '';
        }
    }

    // Confirmation avant soumission
    document.getElementById('candidatureForm').addEventListener('submit', function(e) {
        const obligatoireFiles = document.querySelectorAll('input[type="file"][required]');
        let missingFiles = [];
        
        obligatoireFiles.forEach(function(input) {
            if (!input.files[0]) {
                const label = input.closest('.card').querySelector('strong').textContent;
                missingFiles.push(label);
            }
        });
        
        if (missingFiles.length > 0) {
            e.preventDefault();
            alert('Veuillez fournir les documents obligatoires manquants : ' + missingFiles.join(', '));
            return;
        }
        
        if (!confirm('Êtes-vous sûr de vouloir soumettre votre candidature ?')) {
            e.preventDefault();
        }
    });

    // Amélioration visuelle pour les utilisateurs connectés
    @if($user)
    const readonlyFields = document.querySelectorAll('input[readonly]');
    readonlyFields.forEach(function(field) {
        field.style.backgroundColor = '#f8f9fa';
        field.style.cursor = 'not-allowed';
    });
    @endif
});
</script>
@endsection
