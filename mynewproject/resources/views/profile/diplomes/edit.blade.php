@extends('layouts.profhead')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800 mb-0">
                <i class="fas fa-edit text-primary me-2"></i>
                Modifier le Diplôme
            </h1>
            <p class="text-muted mb-0">Modifiez les informations de votre diplôme</p>
        </div>        <div>
            <a href="{{ route('profile.diplomes.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour
            </a>
        </div>
    </div>

    <!-- Alerts -->
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

    <!-- Edit Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-graduation-cap me-2"></i>
                        <h5 class="mb-0">Informations du diplôme</h5>
                    </div>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.diplomes.update', $diplome->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="nom" class="form-label">
                                    <i class="fas fa-scroll text-primary me-2"></i>
                                    Nom du diplôme *
                                </label>
                                <input type="text" name="nom" id="nom" 
                                       class="form-control @error('nom') is-invalid @enderror" 
                                       value="{{ old('nom', $diplome->nom) }}"
                                       placeholder="Ex: Master en Informatique..."
                                       required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Le nom exact de votre diplôme
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="type_diplome_id" class="form-label">
                                    <i class="fas fa-tags text-primary me-2"></i>
                                    Type de diplôme *
                                </label>
                                <select name="type_diplome_id" id="type_diplome_id" 
                                        class="form-select @error('type_diplome_id') is-invalid @enderror" 
                                        required>
                                    <option value="">-- Choisir un type --</option>
                                    @foreach($typeDiplomes as $type)
                                        <option value="{{ $type->id }}" 
                                                {{ old('type_diplome_id', $diplome->type_diplome_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_diplome_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Sélectionnez le type de diplôme correspondant
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="etablissement_id" class="form-label">
                                    <i class="fas fa-university text-primary me-2"></i>
                                    Établissement *
                                </label>
                                <select name="etablissement_id" id="etablissement_id" 
                                        class="form-select @error('etablissement_id') is-invalid @enderror" 
                                        required>
                                    <option value="">-- Choisir un établissement --</option>
                                    @foreach($etablissements as $etablissement)
                                        <option value="{{ $etablissement->id }}" 
                                                {{ old('etablissement_id', $diplome->etablissement_id) == $etablissement->id ? 'selected' : '' }}>
                                            {{ $etablissement->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('etablissement_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    L'établissement qui a délivré le diplôme
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="niveau_id" class="form-label">
                                    <i class="fas fa-layer-group text-primary me-2"></i>
                                    Niveau
                                </label>
                                <select name="niveau_id" id="niveau_id" 
                                        class="form-select @error('niveau_id') is-invalid @enderror">
                                    <option value="">-- Choisir un niveau (optionnel) --</option>
                                    @foreach($niveaux as $niveau)
                                        <option value="{{ $niveau->id }}" 
                                                {{ old('niveau_id', $diplome->niveau_id) == $niveau->id ? 'selected' : '' }}>
                                            {{ $niveau->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('niveau_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Le niveau d'études du diplôme
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="date_obtention" class="form-label">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    Date d'obtention *
                                </label>
                                <input type="date" name="date_obtention" id="date_obtention" 
                                       class="form-control @error('date_obtention') is-invalid @enderror" 
                                       value="{{ old('date_obtention', $diplome->date_obtention ? $diplome->date_obtention->format('Y-m-d') : '') }}"
                                       max="{{ date('Y-m-d') }}"
                                       required>
                                @error('date_obtention')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    La date à laquelle vous avez obtenu ce diplôme
                                </div>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="certificat" class="form-label">
                                    <i class="fas fa-file-pdf text-primary me-2"></i>
                                    Certificat/Diplôme (PDF)
                                </label>
                                <input type="file" name="certificat" id="certificat" 
                                       class="form-control @error('certificat') is-invalid @enderror" 
                                       accept=".pdf">
                                @error('certificat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Fichier PDF uniquement (max: 2MB)
                                    @if($diplome->certificat)
                                        <br><i class="fas fa-check-circle text-success me-1"></i>
                                        Fichier actuel: 
                                        <a href="{{ Storage::url($diplome->certificat) }}" class="text-decoration-none">
                                            Voir le certificat actuel
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left text-primary me-2"></i>
                                Description (optionnelle)
                            </label>
                            <textarea name="description" id="description" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="4" 
                                      placeholder="Ajoutez une description de votre diplôme, mention obtenue, spécialité...">{{ old('description', $diplome->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Informations complémentaires sur votre diplôme (spécialité, mention, etc.)
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('profile.diplomes.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Annuler
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

<style>
.form-label {
    font-weight: 600;
    color: #495057;
}

.form-control:focus, .form-select:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.card {
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    padding: 0.5rem 1.5rem;
}

.form-text {
    font-size: 0.875rem;
    color: #6c757d;
}

.invalid-feedback {
    font-size: 0.875rem;
}
</style>
@endsection
            <label for="domaine_id">Domaine</label>
            <select name="domaine_id" id="domaine_id" class="form-control @error('domaine_id') is-invalid @enderror" required>
                <option value="">-- Sélectionnez un domaine --</option>
                @foreach($domaines as $domaine)
                    <option value="{{ $domaine->id }}" {{ old('domaine_id', $diplome->domaine_id) == $domaine->id ? 'selected' : '' }}>
                        {{ $domaine->nom }}
                    </option>
                @endforeach
            </select>
            @error('domaine_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_obtention">Date d'obtention</label>
            <input type="date" name="date_obtention" id="date_obtention" class="form-control @error('date_obtention') is-invalid @enderror" value="{{ old('date_obtention', $diplome->date_obtention) }}" required>
            @error('date_obtention')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="certificat">Certificat (PDF)</label>
            <input type="file" name="certificat" id="certificat" class="form-control @error('certificat') is-invalid @enderror" accept=".pdf">
            @error('certificat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if($diplome->certificat)
                <small class="form-text text-muted">Un certificat est déjà uploadé. En uploadant un nouveau, l'ancien sera remplacé.</small>
            @endif
        </div>        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Mettre à jour le diplôme</button>
            <a href="{{ route('profile.diplomes.index') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>

    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="date"], select, input[type="file"] {
            display: block;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</div>
@endsection
