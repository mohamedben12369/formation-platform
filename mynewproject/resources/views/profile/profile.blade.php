@extends('layouts.profhead')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-primary text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-circle me-2"></i>
                        <h4 class="mb-0">Mon Profil</h4>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center mb-3 mb-md-0">
                            <div class="position-relative">
                                @if(Auth::user()->photo)
                                    <img src="{{ Storage::url(Auth::user()->photo) }}" 
                                         alt="Photo de profil" 
                                         class="rounded-circle shadow-lg"
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center shadow-lg"
                                         style="width: 120px; height: 120px;">
                                        <i class="fas fa-user text-white" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h3 class="text-primary mb-2">{{ Auth::user()->name }}</h3>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-envelope text-muted me-2"></i>
                                <span class="text-muted">{{ Auth::user()->email }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-calendar-alt text-muted me-2"></i>
                                <span class="text-muted">Membre depuis le {{ Auth::user()->created_at->format('d/m/Y') }}</span>
                            </div>
                            @if(Auth::user()->phone)
                            <div class="d-flex align-items-center">
                                <i class="fas fa-phone text-muted me-2"></i>
                                <span class="text-muted">{{ Auth::user()->phone }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <div class="col-md-3 text-end">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-edit me-2"></i>
                                Modifier le profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Mes Compétences -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow border-0">
                <div class="card-header bg-info text-white border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-cogs me-2"></i>
                            <h5 class="mb-0">Mes Compétences</h5>
                        </div>
                        <span class="badge bg-light text-dark">{{ Auth::user()->competences->count() }}</span>
                    </div>
                </div>
                
                <div class="card-body">
                    <p class="text-muted mb-3">Liste de vos compétences enregistrées</p>
                    
                    @forelse(Auth::user()->competences->take(3) as $competence)
                        <div class="d-flex align-items-center justify-content-between mb-3 p-3 bg-light rounded">
                            <div>
                                <h6 class="mb-1 text-primary">{{ $competence->nom }}</h6>
                                <small class="text-muted">
                                    <span class="badge bg-primary me-1">{{ $competence->niveau->nom ?? 'N/A' }}</span>
                                    <span class="badge bg-success">{{ $competence->sousDomaine->nom ?? 'N/A' }}</span>
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-circle text-muted mb-2" style="font-size: 2rem;"></i>
                            <p class="text-muted">Aucune compétence enregistrée</p>
                        </div>
                    @endforelse
                    
                    @if(Auth::user()->competences->count() > 3)
                        <div class="text-center mb-3">
                            <small class="text-muted">Et {{ Auth::user()->competences->count() - 3 }} autres...</small>
                        </div>
                    @endif
                </div>
                
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('profile.competences.index') }}" class="btn btn-info w-100">
                        <i class="fas fa-cog me-2"></i>
                        Gérer mes compétences
                    </a>
                </div>
            </div>
        </div>

        <!-- Mes Diplômes -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow border-0">
                <div class="card-header bg-success text-white border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-graduation-cap me-2"></i>
                            <h5 class="mb-0">Mes Diplômes</h5>
                        </div>
                        <span class="badge bg-light text-dark">{{ Auth::user()->diplomes->count() }}</span>
                    </div>
                </div>
                
                <div class="card-body">
                    <p class="text-muted mb-3">Liste de vos diplômes enregistrés</p>
                    
                    @forelse(Auth::user()->diplomes->take(3) as $diplome)
                        <div class="d-flex align-items-center justify-content-between mb-3 p-3 bg-light rounded">
                            <div>
                                <h6 class="mb-1 text-success">{{ $diplome->nom }}</h6>
                                <small class="text-muted">
                                    <span class="badge bg-success me-1">{{ $diplome->etablissement->nom ?? $diplome->etablissement }}</span>
                                    <span class="badge bg-warning text-dark">{{ $diplome->annee ?? $diplome->date_obtention }}</span>
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-circle text-muted mb-2" style="font-size: 2rem;"></i>
                            <p class="text-muted">Aucun diplôme enregistré</p>
                        </div>
                    @endforelse
                    
                    @if(Auth::user()->diplomes->count() > 3)
                        <div class="text-center mb-3">
                            <small class="text-muted">Et {{ Auth::user()->diplomes->count() - 3 }} autres...</small>
                        </div>
                    @endif
                </div>
                
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('profile.diplomes.index') }}" class="btn btn-success w-100">
                        <i class="fas fa-graduation-cap me-2"></i>
                        Gérer mes diplômes
                    </a>
                </div>
            </div>
        </div>

        <!-- Mes Expériences -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow border-0">
                <div class="card-header bg-warning text-dark border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-briefcase me-2"></i>
                            <h5 class="mb-0">Mes Expériences</h5>
                        </div>
                        <span class="badge bg-dark text-white">{{ Auth::user()->experiences->count() }}</span>
                    </div>
                </div>
                
                <div class="card-body">
                    <p class="text-muted mb-3">Liste de vos expériences professionnelles</p>
                    
                    @forelse(Auth::user()->experiences->take(3) as $experience)
                        <div class="d-flex align-items-center justify-content-between mb-3 p-3 bg-light rounded">
                            <div>
                                <h6 class="mb-1 text-warning">{{ $experience->titre }}</h6>
                                <small class="text-muted">
                                    <span class="badge bg-primary me-1">{{ $experience->entreprise }}</span>
                                    <span class="badge bg-secondary">{{ \Carbon\Carbon::parse($experience->date_debut)->format('Y') }} - {{ $experience->date_fin ? \Carbon\Carbon::parse($experience->date_fin)->format('Y') : 'Présent' }}</span>
                                </small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-circle text-muted mb-2" style="font-size: 2rem;"></i>
                            <p class="text-muted">Aucune expérience enregistrée</p>
                        </div>
                    @endforelse
                    
                    @if(Auth::user()->experiences->count() > 3)
                        <div class="text-center mb-3">
                            <small class="text-muted">Et {{ Auth::user()->experiences->count() - 3 }} autres...</small>
                        </div>
                    @endif
                </div>
                
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('profile.experiences.index') }}" class="btn btn-warning w-100">
                        <i class="fas fa-briefcase me-2"></i>
                        Gérer mes expériences
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
