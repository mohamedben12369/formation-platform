@extends('layouts.profhead')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Modifier l'expérience
                    </h5>
                </div>
                
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation:</h6>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('profile.experiences.update', $experience->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="titre" class="form-label fw-semibold">
                                    <i class="fas fa-briefcase text-warning me-2"></i>Titre du poste
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('titre') is-invalid @enderror" 
                                       id="titre" 
                                       name="titre" 
                                       value="{{ old('titre', $experience->titre) }}"
                                       placeholder="Ex: Développeur Full Stack"
                                       required>
                                @error('titre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="type_experience_id" class="form-label fw-semibold">
                                    <i class="fas fa-tags text-warning me-2"></i>Type d'expérience
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('type_experience_id') is-invalid @enderror" 
                                        id="type_experience_id" 
                                        name="type_experience_id" 
                                        required>
                                    <option value="">Sélectionnez un type</option>
                                    @foreach($typeExperiences as $type)
                                        <option value="{{ $type->id }}" 
                                            {{ old('type_experience_id', $experience->type_experience_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_experience_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="entreprise" class="form-label fw-semibold">
                                    <i class="fas fa-building text-warning me-2"></i>Entreprise
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('entreprise') is-invalid @enderror" 
                                       id="entreprise" 
                                       name="entreprise" 
                                       value="{{ old('entreprise', $experience->entreprise) }}"
                                       placeholder="Ex: Google France"
                                       required>
                                @error('entreprise')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="date_debut" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-alt text-warning me-2"></i>Date de début
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control @error('date_debut') is-invalid @enderror" 
                                       id="date_debut" 
                                       name="date_debut" 
                                       value="{{ old('date_debut', $experience->date_debut ? $experience->date_debut->format('Y-m-d') : '') }}"
                                       required>
                                @error('date_debut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="date_fin" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-check text-warning me-2"></i>Date de fin
                                </label>
                                <input type="date" 
                                       class="form-control @error('date_fin') is-invalid @enderror" 
                                       id="date_fin" 
                                       name="date_fin" 
                                       value="{{ old('date_fin', $experience->date_fin ? $experience->date_fin->format('Y-m-d') : '') }}">
                                <div class="form-text">Laissez vide si c'est votre poste actuel</div>
                                @error('date_fin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">
                                    <i class="fas fa-align-left text-warning me-2"></i>Description
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="5"
                                          placeholder="Décrivez vos missions, responsabilités, réalisations...">{{ old('description', $experience->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="attestation" class="form-label fw-semibold">
                                    <i class="fas fa-file-upload text-warning me-2"></i>Attestation
                                </label>
                                @if($experience->attestation)
                                    <div class="mb-2">
                                        <div class="alert alert-info py-2">
                                            <i class="fas fa-paperclip me-2"></i>
                                            Fichier actuel: 
                                            <a href="{{ route('profile.experiences.attestation', $experience->id) }}" 
                                               target="_blank" class="text-decoration-none">
                                                {{ basename($experience->attestation) }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <input type="file" 
                                       class="form-control @error('attestation') is-invalid @enderror" 
                                       id="attestation" 
                                       name="attestation" 
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Formats acceptés: PDF, JPG, PNG - Taille max: 10MB
                                    @if($experience->attestation)
                                        <br><small class="text-muted">Sélectionnez un nouveau fichier pour remplacer l'actuel</small>
                                    @endif
                                </div>
                                @error('attestation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('profile.experiences.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Retour
                            </a>
                            <button type="submit" class="btn btn-warning text-dark">
                                <i class="fas fa-save me-2"></i>Mettre à jour l'expérience
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    border-radius: 10px;
}

.card-header {
    border-radius: 10px 10px 0 0;
}

.btn {
    border-radius: 6px;
    padding: 10px 20px;
}

.btn:hover {
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.text-danger {
    color: #dc3545 !important;
}

.fw-semibold {
    font-weight: 600;
}

/* FORCE LA VISIBILITÉ ABSOLUE DU FORMULAIRE */
.card-body {
    background: #ffffff !important;
    color: #000000 !important;
}

.form-label {
    color: #000000 !important;
    font-weight: 600 !important;
    display: block !important;
}

.form-control,
.form-select {
    background: #ffffff !important;
    color: #000000 !important;
    border: 2px solid #ced4da !important;
    border-radius: 6px !important;
}

.form-control:focus,
.form-select:focus {
    background: #ffffff !important;
    color: #000000 !important;
    border-color: #ffc107 !important;
    box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.25) !important;
}

.form-control::placeholder {
    color: #666666 !important;
    opacity: 1 !important;
}

select option {
    background: #ffffff !important;
    color: #000000 !important;
}

.btn-primary {
    background: #0d6efd !important;
    border-color: #0d6efd !important;
    color: #ffffff !important;
}

.btn-secondary {
    background: #6c757d !important;
    border-color: #6c757d !important;
    color: #ffffff !important;
}

.alert-danger {
    background: #f8d7da !important;
    color: #721c24 !important;
    border: 1px solid #f5c6cb !important;
}

.invalid-feedback {
    color: #dc3545 !important;
    display: block !important;
}

.is-invalid {
    border-color: #dc3545 !important;
}

/* Force tous les textes à être visibles */
* {
    color: inherit !important;
}

.card * {
    color: #000000 !important;
}

.card-header * {
    color: #000000 !important;
}

.form-text {
    color: #666666 !important;
}
</style>
@endpush