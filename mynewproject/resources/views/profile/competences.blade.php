@extends('layouts.profhead')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-info text-white border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-cogs me-2"></i>
                            <div>
                                <h4 class="mb-0">Gérer les Compétences</h4>
                                <small class="opacity-75">Développez votre profil professionnel en ajoutant vos compétences</small>
                            </div>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-circle p-3">
                            <i class="fas fa-brain text-white"></i>
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
        <!-- Add Competence Form -->
        <div class="col-lg-5 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-plus-circle me-2"></i>
                        <h5 class="mb-0">Ajouter une nouvelle compétence</h5>
                    </div>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.competences.store') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nom" class="form-label">
                                <i class="fas fa-tag text-primary me-2"></i>
                                Nom de la compétence *
                            </label>
                            <input type="text" name="nom" id="nom" 
                                   class="form-control @error('nom') is-invalid @enderror" 
                                   placeholder="Ex: Développement Web, Design UX/UI..."
                                   value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="niveau_id" class="form-label">
                                <i class="fas fa-chart-line text-primary me-2"></i>
                                Niveau *
                            </label>
                            <select name="niveau_id" id="niveau_id" 
                                    class="form-select @error('niveau_id') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un niveau --</option>
                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->id }}" {{ old('niveau_id') == $niveau->id ? 'selected' : '' }}>
                                        {{ $niveau->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('niveau_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sous_domaines_id" class="form-label">
                                <i class="fas fa-code-branch text-primary me-2"></i>
                                Sous-domaine *
                            </label>
                            <select name="sous_domaines_id" id="sous_domaines_id" 
                                    class="form-select @error('sous_domaines_id') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un sous-domaine --</option>
                                @foreach($sousDomaines as $sousDomaine)
                                    <option value="{{ $sousDomaine->id }}" {{ old('sous_domaines_id') == $sousDomaine->id ? 'selected' : '' }}>
                                        {{ $sousDomaine->description }} ({{ $sousDomaine->code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('sous_domaines_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>
                                Ajouter la compétence
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Competences List -->
        <div class="col-lg-7">
            <div class="card shadow border-0">
                <div class="card-header bg-info text-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-list me-2"></i>
                            <h5 class="mb-0">Vos Compétences</h5>
                        </div>
                        <span class="badge bg-light text-dark">
                            Total: {{ $competences->count() }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    @if($competences->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-lightbulb text-info mb-3" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">Aucune compétence trouvée</h5>
                            <p class="text-muted">Ajoutez votre première compétence en utilisant le formulaire ci-dessus !</p>
                        </div>
                    @else
                        <div class="row">
                            @foreach($competences as $competence)
                                <div class="col-12 mb-3">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <h6 class="card-title text-primary mb-2">
                                                        <i class="fas fa-cog me-2"></i>
                                                        {{ $competence->nom }}
                                                    </h6>
                                                    
                                                    <div class="mb-2">
                                                        <span class="badge bg-primary me-2">
                                                            <i class="fas fa-chart-line me-1"></i>
                                                            {{ $competence->niveau->nom ?? 'N/A' }}
                                                        </span>
                                                    </div>
                                                    
                                                    <div class="text-muted small">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <i class="fas fa-code-branch text-info me-2"></i>
                                                            {{ $competence->sousDomaine->description ?? 'N/A' }}
                                                        </div>
                                                        <div class="ms-4 text-muted">
                                                            Code: {{ $competence->sousDomaine->code ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary" type="button" 
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('profile.competences.edit', $competence->id) }}">
                                                                <i class="fas fa-edit me-2"></i>Modifier
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{ route('profile.competences.destroy', $competence->id) }}" method="POST" 
                                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette compétence ?');">
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
@endsection
