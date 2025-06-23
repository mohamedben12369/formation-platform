@extends('layouts.app')

@section('title', 'Modifier le type de document')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Modifier le type de document : {{ $typeDocument->nom }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.type-documents.update', $typeDocument) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="nom" class="form-label">Nom du type de document <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('nom') is-invalid @enderror" 
                                       id="nom" 
                                       name="nom" 
                                       value="{{ old('nom', $typeDocument->nom) }}" 
                                       required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="couleur" class="form-label">Couleur</label>
                                <input type="color" 
                                       class="form-control form-control-color @error('couleur') is-invalid @enderror" 
                                       id="couleur" 
                                       name="couleur" 
                                       value="{{ old('couleur', $typeDocument->couleur ?? '#007bff') }}">
                                @error('couleur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Description du type de document...">{{ old('description', $typeDocument->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="icone" class="form-label">Icône FontAwesome</label>
                                <input type="text" 
                                       class="form-control @error('icone') is-invalid @enderror" 
                                       id="icone" 
                                       name="icone" 
                                       value="{{ old('icone', $typeDocument->icone ?? 'fas fa-file') }}" 
                                       placeholder="fas fa-file">
                                <small class="form-text text-muted">Exemple: fas fa-file-pdf, fas fa-image, etc.</small>
                                @error('icone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="preview" class="form-label">Aperçu</label>
                                <div class="form-control-plaintext">
                                    <i id="icone-preview" class="{{ $typeDocument->icone ?? 'fas fa-file' }} fa-2x" 
                                       style="color: {{ $typeDocument->couleur ?? '#007bff' }};"></i>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="formats_autorises" class="form-label">Formats autorisés <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('formats_autorises') is-invalid @enderror" 
                                       id="formats_autorises" 
                                       name="formats_autorises" 
                                       value="{{ old('formats_autorises', $typeDocument->formats_autorises) }}" 
                                       placeholder="pdf,doc,docx,jpg,png"
                                       required>
                                <small class="form-text text-muted">Séparez les formats par des virgules</small>
                                @error('formats_autorises')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="taille_max_mb" class="form-label">Taille maximale (MB) <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('taille_max_mb') is-invalid @enderror" 
                                       id="taille_max_mb" 
                                       name="taille_max_mb" 
                                       value="{{ old('taille_max_mb', $typeDocument->taille_max_mb) }}" 
                                       min="1" 
                                       max="100"
                                       required>
                                @error('taille_max_mb')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           value="1" 
                                           id="obligatoire" 
                                           name="obligatoire"
                                           {{ old('obligatoire', $typeDocument->obligatoire) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="obligatoire">
                                        Document obligatoire
                                    </label>
                                </div>
                                <small class="form-text text-muted">Les candidats devront obligatoirement fournir ce document</small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           value="1" 
                                           id="actif" 
                                           name="actif"
                                           {{ old('actif', $typeDocument->actif) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="actif">
                                        Type de document actif
                                    </label>
                                </div>
                                <small class="form-text text-muted">Seuls les types actifs sont proposés aux candidats</small>
                            </div>
                        </div>

                        <!-- Statistiques d'utilisation -->
                        @if($typeDocument->candidature_documents_count > 0)
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Ce type de document est utilisé dans <strong>{{ $typeDocument->candidature_documents_count }}</strong> candidature(s).
                        </div>
                        @endif

                        <hr>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard.type-documents.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Mettre à jour
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
    const iconeInput = document.getElementById('icone');
    const couleurInput = document.getElementById('couleur');
    const preview = document.getElementById('icone-preview');
    
    function updatePreview() {
        const icone = iconeInput.value || 'fas fa-file';
        const couleur = couleurInput.value || '#007bff';
        
        preview.className = icone + ' fa-2x';
        preview.style.color = couleur;
    }
    
    iconeInput.addEventListener('input', updatePreview);
    couleurInput.addEventListener('input', updatePreview);
});
</script>
@endsection
