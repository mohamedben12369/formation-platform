@extends('layouts.profhead')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-briefcase me-2"></i>Mes Expériences Professionnelles
            </h5>
            <a href="{{ route('profile.experiences.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus me-2"></i>Ajouter une expérience
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($experiences->isEmpty())
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-briefcase fa-4x text-muted opacity-50"></i>
                    </div>
                    <h6 class="text-muted">Aucune expérience professionnelle</h6>
                    <p class="text-muted mb-4">Vous n'avez pas encore ajouté d'expériences professionnelles.</p>
                    <a href="{{ route('profile.experiences.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Ajouter votre première expérience
                    </a>
                </div>
            @else
                <div class="row">
                    @foreach($experiences as $experience)
                        <div class="col-lg-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm experience-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="flex-grow-1">
                                            <h5 class="card-title mb-1 text-primary">{{ $experience->titre }}</h5>
                                            <h6 class="card-subtitle text-muted mb-2">
                                                <i class="fas fa-building me-1"></i>{{ $experience->entreprise }}
                                            </h6>
                                        </div>
                                        @if($experience->typeExperience)
                                            <span class="badge bg-info">{{ $experience->typeExperience->nom }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="mb-3">
                                        <p class="card-text mb-2">
                                            <i class="fas fa-calendar-alt me-2 text-muted"></i>
                                            <strong>Période:</strong> 
                                            {{ \Carbon\Carbon::parse($experience->date_debut)->format('M Y') }} - 
                                            {{ $experience->date_fin ? \Carbon\Carbon::parse($experience->date_fin)->format('M Y') : 'Présent' }}
                                        </p>
                                        
                                        @if($experience->date_debut && $experience->date_fin)
                                            @php
                                                $debut = \Carbon\Carbon::parse($experience->date_debut);
                                                $fin = \Carbon\Carbon::parse($experience->date_fin);
                                                $duree = $debut->diffInMonths($fin);
                                                $annees = intval($duree / 12);
                                                $mois = $duree % 12;
                                            @endphp
                                            <p class="card-text text-muted small">
                                                <i class="fas fa-clock me-2"></i>
                                                Durée: 
                                                @if($annees > 0)
                                                    {{ $annees }} an{{ $annees > 1 ? 's' : '' }}
                                                @endif
                                                @if($mois > 0)
                                                    {{ $mois }} mois
                                                @endif
                                            </p>
                                        @endif
                                    </div>

                                    @if($experience->description)
                                        <div class="mb-3">
                                            <p class="card-text">
                                                {{ Str::limit($experience->description, 150) }}
                                                @if(strlen($experience->description) > 150)
                                                    <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#descriptionModal{{ $experience->id }}">
                                                        Lire plus...
                                                    </a>
                                                @endif
                                            </p>
                                        </div>
                                    @endif

                                    @if($experience->attestation)
                                        <div class="mb-3">
                                            <a href="{{ route('profile.experiences.attestation', $experience->id) }}" 
                                               class="btn btn-sm btn-outline-info" target="_blank">
                                                <i class="fas fa-file-pdf me-2"></i>Voir l'attestation
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-footer bg-transparent border-0">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('profile.experiences.edit', $experience->id) }}" 
                                           class="btn btn-outline-warning btn-sm flex-grow-1">
                                            <i class="fas fa-edit me-2"></i>Modifier
                                        </a>
                                        <form action="{{ route('profile.experiences.destroy', $experience->id) }}" 
                                              method="POST" class="flex-grow-1" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette expérience ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                                <i class="fas fa-trash me-2"></i>Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal pour la description complète -->
                        @if($experience->description && strlen($experience->description) > 150)
                            <div class="modal fade" id="descriptionModal{{ $experience->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $experience->titre }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="text-muted mb-3">{{ $experience->entreprise }}</h6>
                                            <p>{{ $experience->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="mt-4 text-center">
                    <p class="text-muted">
                        <i class="fas fa-info-circle me-2"></i>
                        Total: {{ $experiences->count() }} expérience{{ $experiences->count() > 1 ? 's' : '' }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.experience-card {
    transition: all 0.3s ease;
    border-radius: 10px;
}

.experience-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.card {
    border-radius: 10px;
}

.btn {
    border-radius: 6px;
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.badge {
    font-size: 0.75em;
    padding: 0.4em 0.6em;
}

.card-title {
    font-weight: 600;
    font-size: 1.1em;
}

.card-subtitle {
    font-size: 0.9em;
}

.text-primary {
    color: #667eea !important;
}

.btn-outline-warning:hover {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-info:hover {
    background-color: #0dcaf0;
    border-color: #0dcaf0;
}
</style>
@endpush
