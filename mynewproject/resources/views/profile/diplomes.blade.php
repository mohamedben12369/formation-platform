@extends('layouts.profhead')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-graduation-cap me-2"></i>
                            <div>
                                <h4 class="mb-0">Gérer les Diplômes</h4>
                                <small class="opacity-75">Ajoutez, modifiez ou supprimez vos diplômes et certifications</small>
                            </div>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-circle p-3">
                            <i class="fas fa-certificate text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3"></i>
                <div>
                    <strong>Succès!</strong>
                    <div>{{ session('success') }}</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-start">
                <i class="fas fa-exclamation-triangle me-3 mt-1"></i>
                <div>
                    <strong>Attention!</strong>
                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Add Diplome Form - HIDDEN -->
        <div class="col-lg-5 mb-4" id="addDiplomeForm" style="display: none;">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-plus-circle me-2"></i>
                            <h5 class="mb-0">Ajouter un nouveau diplôme</h5>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-light" onclick="toggleAddForm()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.diplomes.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nom" class="form-label">
                                <i class="fas fa-scroll text-primary me-2"></i>
                                Nom du diplôme *
                            </label>
                            <input type="text" name="nom" id="nom" 
                                   class="form-control @error('nom') is-invalid @enderror" 
                                   placeholder="Ex: Master en Informatique..."
                                   value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type_diplome_id" class="form-label">
                                <i class="fas fa-bookmark text-primary me-2"></i>
                                Type de diplôme *
                            </label>
                            <select name="type_diplome_id" id="type_diplome_id" 
                                    class="form-select @error('type_diplome_id') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un type --</option>
                                @foreach($typeDiplomes as $type)
                                    <option value="{{ $type->id }}" {{ old('type_diplome_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_diplome_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="etablissement_id" class="form-label">
                                <i class="fas fa-university text-primary me-2"></i>
                                Établissement *
                            </label>
                            <select name="etablissement_id" id="etablissement_id" 
                                    class="form-select @error('etablissement_id') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un établissement --</option>
                                @foreach($etablissements as $etablissement)
                                    <option value="{{ $etablissement->id }}" {{ old('etablissement_id') == $etablissement->id ? 'selected' : '' }}>
                                        {{ $etablissement->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('etablissement_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="domaine_id" class="form-label">
                                <i class="fas fa-layer-group text-primary me-2"></i>
                                Domaine *
                            </label>
                            <select name="domaine_id" id="domaine_id" 
                                    class="form-select @error('domaine_id') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un domaine --</option>
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

                        <div class="mb-3">
                            <label for="date_obtention" class="form-label">
                                <i class="fas fa-calendar text-primary me-2"></i>
                                Date d'obtention *
                            </label>
                            <input type="date" name="date_obtention" id="date_obtention" 
                                   class="form-control @error('date_obtention') is-invalid @enderror"
                                   value="{{ old('date_obtention') }}" required>
                            @error('date_obtention')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="certificat" class="form-label">
                                <i class="fas fa-file-pdf text-primary me-2"></i>
                                Certificat (PDF)
                            </label>
                            <input type="file" name="certificat" id="certificat" 
                                   class="form-control @error('certificat') is-invalid @enderror"
                                   accept=".pdf">
                            <div class="form-text">Format accepté : PDF. Taille max : 10 MB</div>
                            @error('certificat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>
                                Ajouter le diplôme
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Diplomes List -->
        <div class="col-lg-7" id="diplomesList">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-list me-2"></i>
                            <h5 class="mb-0">Mes Diplômes</h5>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-light text-dark">
                                Total: {{ $diplomes->count() }}
                            </span>
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="toggleAddForm()">
                                <i class="fas fa-plus me-2"></i>Ajouter un diplôme
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if($diplomes->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-graduation-cap text-success mb-3" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">Aucun diplôme trouvé</h5>
                            <p class="text-muted mb-4">Commencez à construire votre profil professionnel en ajoutant vos diplômes et certifications !</p>
                            <button type="button" class="btn btn-success btn-lg" onclick="toggleAddForm()">
                                <i class="fas fa-plus-circle me-2"></i>Ajouter mon premier diplôme
                            </button>
                        </div>
                    @else
                        <div class="row">
                            @foreach($diplomes as $diplome)
                                <div class="col-12 mb-3">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <h6 class="card-title text-success mb-2">
                                                        <i class="fas fa-graduation-cap me-2"></i>
                                                        {{ $diplome->nom }}
                                                    </h6>
                                                    
                                                    <div class="mb-2">
                                                        <span class="badge bg-success me-2">
                                                            <i class="fas fa-bookmark me-1"></i>
                                                            {{ $diplome->typeDiplome->nom ?? 'N/A' }}
                                                        </span>
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="fas fa-calendar me-1"></i>
                                                            {{ \Carbon\Carbon::parse($diplome->date_obtention)->format('Y') }}
                                                        </span>
                                                    </div>
                                                    
                                                    <div class="text-muted small">
                                                        <div class="d-flex align-items-center mb-1">
                                                            @if($diplome->etablissement && $diplome->etablissement->logo)
                                                                <img src="{{ asset('storage/' . $diplome->etablissement->logo) }}" 
                                                                     alt="Logo {{ $diplome->etablissement->nom ?? 'Établissement' }}" 
                                                                     class="me-2 rounded"
                                                                     style="width: 20px; height: 20px; object-fit: cover;">
                                                            @else
                                                                <i class="fas fa-university text-info me-2"></i>
                                                            @endif
                                                            {{ $diplome->etablissement->nom ?? 'N/A' }}
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-layer-group text-primary me-2"></i>
                                                            {{ $diplome->domaine->nom ?? 'N/A' }}
                                                        </div>
                                                        @if($diplome->certificat)
                                                            <div class="d-flex align-items-center mt-1">
                                                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                                                <a href="{{ Storage::url($diplome->certificat) }}" class="text-decoration-none">
                                                                    Voir le certificat
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary" type="button" 
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('profile.diplomes.edit', $diplome->id) }}">
                                                                <i class="fas fa-edit me-2"></i>Modifier
                                                            </a>
                                                        </li>
                                                        @if($diplome->certificat)
                                                            <li>
                                                                <a class="dropdown-item" href="{{ Storage::url($diplome->certificat) }}">
                                                                    <i class="fas fa-file-pdf me-2"></i>Voir certificat
                                                                </a>
                                                            </li>
                                                        @endif
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{ route('profile.diplomes.destroy', $diplome->id) }}" method="POST" 
                                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce diplôme ?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="fas fa-trash-alt me-2"></i>Supprimer
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleAddForm() {
    const addForm = document.getElementById('addDiplomeForm');
    const diplomesList = document.getElementById('diplomesList');
    
    if (addForm.style.display === 'none' || addForm.style.display === '') {
        // Afficher le formulaire
        addForm.style.display = 'block';
        diplomesList.className = 'col-lg-7';
        
        // Scroll vers le formulaire
        addForm.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'start' 
        });
        
        // Focus sur le premier champ
        setTimeout(() => {
            const firstInput = addForm.querySelector('input[name="nom"]');
            if (firstInput) {
                firstInput.focus();
            }
        }, 300);
    } else {
        // Masquer le formulaire
        addForm.style.display = 'none';
        diplomesList.className = 'col-lg-12';
        
        // Réinitialiser le formulaire
        const form = addForm.querySelector('form');
        if (form) {
            form.reset();
            // Supprimer les classes d'erreur
            form.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            form.querySelectorAll('.invalid-feedback').forEach(el => {
                el.style.display = 'none';
            });
        }
    }
}

// Fonction pour ouvrir le formulaire si il y a des erreurs de validation
document.addEventListener('DOMContentLoaded', function() {
    const hasErrors = document.querySelector('.alert-danger');
    if (hasErrors) {
        toggleAddForm();
    }
});
</script>

<style>
.btn-outline-light:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-color: white;
}

#addDiplomeForm {
    transition: all 0.3s ease-in-out;
}

#diplomesList {
    transition: all 0.3s ease-in-out;
}

.card-header .btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.gap-3 {
    gap: 1rem !important;
}
</style>
@endsection
