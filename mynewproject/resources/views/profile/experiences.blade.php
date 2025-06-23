@extends('layouts.profhead')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-warning text-dark border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-briefcase me-2"></i>
                            <div>
                                <h4 class="mb-0">Gérer les Expériences</h4>
                                <small class="opacity-75">Ajoutez, modifiez ou supprimez vos expériences professionnelles</small>
                            </div>
                        </div>
                        <div class="bg-dark bg-opacity-20 rounded-circle p-3">
                            <i class="fas fa-user-tie text-dark"></i>
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
        <!-- Add Experience Form -->
        <div class="col-lg-5 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-plus-circle me-2"></i>
                        <h5 class="mb-0">Ajouter une nouvelle expérience</h5>
                    </div>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.experiences.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="titre" class="form-label">
                                <i class="fas fa-briefcase text-primary me-2"></i>
                                Titre du poste *
                            </label>
                            <input type="text" name="titre" id="titre" 
                                   class="form-control @error('titre') is-invalid @enderror" 
                                   placeholder="Ex: Développeur Full Stack..."
                                   value="{{ old('titre') }}" required>
                            @error('titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="entreprise" class="form-label">
                                <i class="fas fa-building text-primary me-2"></i>
                                Entreprise *
                            </label>
                            <input type="text" name="entreprise" id="entreprise" 
                                   class="form-control @error('entreprise') is-invalid @enderror" 
                                   placeholder="Ex: Google, Microsoft..."
                                   value="{{ old('entreprise') }}" required>
                            @error('entreprise')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type_experience_id" class="form-label">
                                <i class="fas fa-tags text-primary me-2"></i>
                                Type d'expérience *
                            </label>
                            <select name="type_experience_id" id="type_experience_id" 
                                    class="form-select @error('type_experience_id') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un type --</option>
                                @foreach($typeExperiences as $type)
                                    <option value="{{ $type->id }}" {{ old('type_experience_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_experience_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="date_debut" class="form-label">
                                        <i class="fas fa-calendar text-primary me-2"></i>
                                        Date de début *
                                    </label>
                                    <input type="date" name="date_debut" id="date_debut" 
                                           class="form-control @error('date_debut') is-invalid @enderror"
                                           value="{{ old('date_debut') }}" required>
                                    @error('date_debut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="date_fin" class="form-label">
                                        <i class="fas fa-calendar-check text-primary me-2"></i>
                                        Date de fin
                                    </label>
                                    <input type="date" name="date_fin" id="date_fin" 
                                           class="form-control @error('date_fin') is-invalid @enderror"
                                           value="{{ old('date_fin') }}">
                                    <div class="form-text">Laisser vide si toujours en cours</div>
                                    @error('date_fin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left text-primary me-2"></i>
                                Description
                            </label>
                            <textarea name="description" id="description" rows="4"
                                      class="form-control @error('description') is-invalid @enderror" 
                                      placeholder="Décrivez vos missions, responsabilités et réalisations...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>
                                Ajouter l'expérience
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Experiences List -->
        <div class="col-lg-7">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-list me-2"></i>
                            <h5 class="mb-0">Vos Expériences</h5>
                        </div>
                        <span class="badge bg-dark text-white">
                            Total: {{ $experiences->count() }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    @if($experiences->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-briefcase text-warning mb-3" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">Aucune expérience trouvée</h5>
                            <p class="text-muted">Ajoutez votre première expérience professionnelle en utilisant le formulaire ci-dessus !</p>
                        </div>
                    @else
                        <div class="row">
                            @foreach($experiences as $experience)
                                <div class="col-12 mb-3">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <h6 class="card-title text-warning mb-2">
                                                        <i class="fas fa-briefcase me-2"></i>
                                                        {{ $experience->titre }}
                                                    </h6>
                                                    
                                                    <div class="mb-2">
                                                        <span class="badge bg-primary me-2">
                                                            <i class="fas fa-building me-1"></i>
                                                            {{ $experience->entreprise }}
                                                        </span>
                                                        <span class="badge bg-secondary">
                                                            <i class="fas fa-calendar me-1"></i>
                                                            {{ \Carbon\Carbon::parse($experience->date_debut)->format('m/Y') }} - 
                                                            {{ $experience->date_fin ? \Carbon\Carbon::parse($experience->date_fin)->format('m/Y') : 'Présent' }}
                                                        </span>
                                                    </div>
                                                    
                                                    <div class="text-muted small">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <i class="fas fa-tags text-info me-2"></i>
                                                            {{ $experience->typeExperience->nom ?? 'N/A' }}
                                                        </div>
                                                        @if($experience->description)
                                                            <div class="mt-2">
                                                                <p class="mb-0 text-justify">{{ Str::limit($experience->description, 150) }}</p>
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
                                                            <a class="dropdown-item" href="{{ route('profile.experiences.edit', $experience->id) }}">
                                                                <i class="fas fa-edit me-2"></i>Modifier
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{ route('profile.experiences.destroy', $experience->id) }}" method="POST" 
                                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette expérience ?');">
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
                        <i class="fas fa-briefcase text-green-500 form-icon"></i>
                        Titre du poste
                    </label>
                    <input type="text" name="titre" id="titre" 
                           class="form-control" 
                           placeholder="Ex: Développeur Full-Stack..."
                           value="{{ old('titre') }}"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-building text-green-500 form-icon"></i>
                        Entreprise
                    </label>
                    <input type="text" name="entreprise" id="entreprise" 
                           class="form-control" 
                           placeholder="Nom de l'entreprise"
                           value="{{ old('entreprise') }}"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calendar text-green-500 form-icon"></i>
                        Date de début
                    </label>
                    <input type="date" name="date_debut" id="date_debut" 
                           class="form-control" 
                           value="{{ old('date_debut') }}"
                           required>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calendar text-green-500 form-icon"></i>
                        Date de fin
                    </label>
                    <input type="date" name="date_fin" id="date_fin" 
                           class="form-control" 
                           value="{{ old('date_fin') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tag text-green-500 form-icon"></i>
                        Type d'expérience
                    </label>
                    <select name="type_experience_id" id="type_experience_id" class="form-control" required>
                        <option value="">-- Sélectionnez un type --</option>
                        @foreach($typeExperiences as $type)
                            <option value="{{ $type->id }}" {{ old('type_experience_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-file-pdf text-green-500 form-icon"></i>
                        Attestation (PDF)
                    </label>
                    <input type="file" name="attestation" id="attestation" 
                           class="form-control" 
                           accept=".pdf">
                    <p class="text-xs text-gray-500 mt-1">Format accepté : PDF. Taille max : 10 MB</p>
                </div>

                <div class="form-group md:col-span-2">
                    <label class="form-label">
                        <i class="fas fa-align-left text-green-500 form-icon"></i>
                        Description
                    </label>
                    <textarea name="description" id="description" 
                              class="form-control" 
                              rows="4"
                              placeholder="Décrivez vos responsabilités, réalisations...">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-success">
                    <i class="fas fa-plus-circle"></i>
                    <span>Ajouter l'expérience</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Experiences List -->
    <div class="profile-card">
        <div class="section-header">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                <span class="icon-wrapper" style="background: #bbf7d0; margin-right:1rem;">
                    <i class="fas fa-list text-green-600 text-xl"></i>
                </span>
                Vos Expériences
            </h2>
            <span class="badge badge-green">
                Total: {{ $experiences->count() }}
            </span>
        </div>

        @if($experiences->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-lightbulb text-green-400 text-4xl"></i>
                </div>
                <p class="empty-state-text">Aucune expérience trouvée. Ajoutez-en une ci-dessus !</p>
            </div>
        @else
            <div class="item-list">
                @foreach($experiences as $experience)
                    <div class="list-item">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow">
                                <h3 class="item-header">{{ $experience->titre }}</h3>
                                <div class="space-y-3">
                                    <div class="flex flex-wrap gap-2">
                                        <span class="badge badge-green">
                                            <i class="fas fa-building mr-2"></i>
                                            {{ $experience->entreprise }}
                                        </span>
                                        <span class="badge badge-yellow">
                                            <i class="fas fa-calendar mr-2"></i>
                                            {{ \Carbon\Carbon::parse($experience->date_debut)->format('d/m/Y') }} - {{ $experience->date_fin ? \Carbon\Carbon::parse($experience->date_fin)->format('d/m/Y') : 'Présent' }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        @if($experience->description)
                                            <p class="mb-2">{{ $experience->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-start space-x-2">
                                @if($experience->attestation)
                                    <a href="{{ route('profile.experiences.attestation', $experience->id) }}" 
                                       class="btn btn-sm btn-outline-info" target="_blank">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                @endif
                                
                                <div class="dropdown relative">
                                    <button class="p-2 hover:bg-green-50 rounded-xl transition-all duration-200" 
                                            onclick="toggleDropdown('dropdown-{{ $experience->id }}')">
                                        <i class="fas fa-ellipsis-v text-gray-500 hover:text-green-500"></i>
                                    </button>
                                    <div id="dropdown-{{ $experience->id }}" class="dropdown-menu hidden">
                                        <a href="{{ route('profile.experiences.edit', $experience->id) }}" 
                                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">
                                            <i class="fas fa-edit mr-2"></i>Modifier
                                        </a>
                                        <form action="{{ route('profile.experiences.destroy', $experience->id) }}" 
                                              method="POST"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette expérience ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                <i class="fas fa-trash-alt mr-2"></i>Supprimer
                                            </button>
                                        </form>
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

@push('scripts')
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        dropdown.classList.toggle('hidden');
        
        if (!dropdown.classList.contains('hidden')) {
            dropdown.classList.add('scale-100', 'opacity-100');
            dropdown.classList.remove('scale-95', 'opacity-0');
        } else {
            dropdown.classList.add('scale-95', 'opacity-0');
            dropdown.classList.remove('scale-100', 'opacity-100');
        }
    }

    // Close dropdowns when clicking outside
    window.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden', 'scale-95', 'opacity-0');
                menu.classList.remove('scale-100', 'opacity-100');
            });
        }
    });
</script>
@endpush

@endsection