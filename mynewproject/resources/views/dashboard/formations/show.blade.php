@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-12">
            <div class="card">                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-eye me-2"></i>Détails de la Formation</h5>
                    <div>
                        <a href="{{ route('candidatures.create', $formation) }}" class="btn btn-success me-2">
                            <i class="fas fa-user-plus me-1"></i>Candidater
                        </a>
                        <a href="{{ route('dashboard.formations.edit', $formation->id) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-1"></i>Modifier
                        </a>
                        <a href="{{ route('dashboard.formations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Colonne gauche : Informations principales -->
                        <div class="col-md-8">
                            <h4 class="text-primary mb-3">{{ $formation->nom }}</h4>
                            
                            <!-- Informations générales -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="text-muted">Dates</h6>
                                    <p><strong>Début :</strong> {{ \Carbon\Carbon::parse($formation->dateDebut)->format('d/m/Y') }}</p>
                                    <p><strong>Fin :</strong> {{ \Carbon\Carbon::parse($formation->dateFin)->format('d/m/Y') }}</p>
                                    @if($formation->DatedeCreation)
                                        <p><strong>Créée le :</strong> {{ \Carbon\Carbon::parse($formation->DatedeCreation)->format('d/m/Y') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted">Lieu et modalité</h6>
                                    <p><strong>Lieu :</strong> {{ $formation->lieu }}</p>
                                    @if($formation->entreprise)
                                        <p><strong>Entreprise :</strong> {{ $formation->entreprise->nom }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Effectifs -->
                            @if($formation->nombre_ouvriers || $formation->nombre_encadrants || $formation->nombre_cadres)
                            <div class="mb-4">
                                <h6 class="text-muted">Effectifs cibles</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="text-center p-2 bg-light rounded">
                                            <strong>{{ $formation->nombre_ouvriers ?? 0 }}</strong><br>
                                            <small>Ouvriers</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center p-2 bg-light rounded">
                                            <strong>{{ $formation->nombre_encadrants ?? 0 }}</strong><br>
                                            <small>Encadrants</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center p-2 bg-light rounded">
                                            <strong>{{ $formation->nombre_cadres ?? 0 }}</strong><br>
                                            <small>Cadres</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-2">
                                    <span class="badge bg-primary fs-6">
                                        Total : {{ ($formation->nombre_ouvriers ?? 0) + ($formation->nombre_encadrants ?? 0) + ($formation->nombre_cadres ?? 0) }} participants
                                    </span>
                                </div>
                            </div>
                            @endif

                            <!-- Programme et objectifs -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-muted">Programme</h6>
                                    <div class="p-3 bg-light rounded">
                                        {!! nl2br(e($formation->programme)) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-muted">Objectifs</h6>
                                    <div class="p-3 bg-light rounded">
                                        {!! nl2br(e($formation->objectifs)) !!}
                                    </div>
                                </div>
                            </div>                            <!-- Compétences visées (calculées à partir des thèmes) -->
                            @if($formation->competences_visees)
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-muted">Compétences visées</h6>
                                    <div class="p-3 bg-light rounded">
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach(explode(',', $formation->competences_visees) as $competence)
                                                @if(trim($competence))
                                                    <span class="badge bg-primary">{{ trim($competence) }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Prérequis calculés (à partir des thèmes) -->
                            @if($formation->prerequis_calcules)
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-muted">Prérequis</h6>
                                    <div class="p-3 bg-light rounded">
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach(explode(',', $formation->prerequis_calcules) as $prerequis)
                                                @if(trim($prerequis))
                                                    <span class="badge bg-warning text-dark">{{ trim($prerequis) }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($formation->moyennes)
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-muted">Moyennes attendues</h6>
                                    <div class="p-3 bg-light rounded">
                                        {!! nl2br(e($formation->moyennes)) !!}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Colonne droite : Informations supplémentaires -->
                        <div class="col-md-4">
                            <!-- Image -->
                            @if($formation->image)
                            <div class="mb-4">
                                <h6 class="text-muted">Image</h6>
                                <img src="{{ asset($formation->image) }}" alt="Image de la formation" 
                                     class="img-fluid rounded shadow-sm" style="max-height: 200px; width: 100%; object-fit: cover;">
                            </div>
                            @endif

                            <!-- Statistiques -->
                            <div class="mb-4">
                                <h6 class="text-muted">Statistiques</h6>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Prix total</span>
                                        <span class="badge bg-success fs-6">{{ number_format($formation->prix_total, 2) }} DH</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Durée totale</span>
                                        <span class="badge bg-info fs-6">{{ $formation->duree_totale }} h</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Type</span>
                                        <span class="badge bg-secondary">{{ $formation->typeFormation->nom }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Statut</span>
                                        @if($formation->statutFormation->nom == 'active')
                                            <span class="badge bg-success">{{ ucfirst($formation->statutFormation->nom) }}</span>
                                        @elseif($formation->statutFormation->nom == 'inactive')
                                            <span class="badge bg-danger">{{ ucfirst($formation->statutFormation->nom) }}</span>
                                        @else
                                            <span class="badge bg-warning">{{ ucfirst($formation->statutFormation->nom) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>                            <!-- Thèmes -->
                            <div class="mb-4">
                                <h6 class="text-muted">Thèmes ({{ $formation->themes->count() }})</h6>
                                @forelse($formation->themes as $theme)
                                    <div class="card mb-3">
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-2 text-primary">{{ $theme->titre }}</h6>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <small class="text-success fw-bold">{{ number_format($theme->pivot->prix ?? $theme->prix, 2) }} DH</small>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <small class="text-info fw-bold">{{ $theme->pivot->duree_heures ?? $theme->duree }}h</small>
                                                </div>
                                            </div>
                                            
                                            @if($theme->description)
                                            <div class="mb-2">
                                                <small class="text-muted d-block"><strong>Description :</strong></small>
                                                <small class="text-dark">{{ $theme->description }}</small>
                                            </div>
                                            @endif
                                            
                                            @if($theme->competence_visees)
                                            <div class="mb-2">
                                                <small class="text-muted d-block"><strong>Compétences visées :</strong></small>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach(explode(',', $theme->competence_visees) as $competence)
                                                        <span class="badge bg-light text-dark border">{{ trim($competence) }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif
                                            
                                            @if($theme->prerequis)
                                            <div class="mb-2">
                                                <small class="text-muted d-block"><strong>Prérequis :</strong></small>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach(explode(',', $theme->prerequis) as $prerequis)
                                                        <span class="badge bg-warning text-dark">{{ trim($prerequis) }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif
                                            
                                            @if($theme->objectifs)
                                            <div class="mb-1">
                                                <small class="text-muted d-block"><strong>Objectifs :</strong></small>
                                                <small class="text-dark">{{ $theme->objectifs }}</small>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">Aucun thème assigné</p>
                                @endforelse
                            </div>

                            <!-- Formateurs -->
                            <div class="mb-4">
                                <h6 class="text-muted">Formateurs ({{ $formation->formateurs->count() }})</h6>
                                @forelse($formation->formateurs as $formateur)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-user-tie text-primary me-2"></i>
                                        <span>{{ $formateur->name }} {{ $formateur->prenom }}</span>
                                    </div>
                                @empty
                                    <p class="text-muted">Aucun formateur assigné</p>
                                @endforelse
                            </div>                            <!-- Documents -->
                            @if($formation->document_pdf)
                            <div class="mb-4">
                                <h6 class="text-muted">Documents</h6>
                                
                                <!-- Solution 1: Lien direct vers le document -->
                                <a href="{{ asset($formation->document_pdf) }}" target="_blank" 
                                   class="btn btn-outline-primary btn-sm w-100 mb-2">
                                    <i class="fas fa-file-pdf me-1"></i>Voir PDF (lien direct)
                                </a>
                                
                                <!-- Solution 2: Via le contrôleur -->
                                <a href="{{ route('dashboard.formations.document', $formation->id) }}" 
                                   class="btn btn-outline-danger btn-sm w-100" target="_blank">
                                    <i class="fas fa-file-pdf me-1"></i>Voir PDF (route)
                                </a>
                                
                                <div class="mt-2">
                                    <small class="text-muted">Chemin: {{ $formation->document_pdf }}</small>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div>
                        <small class="text-muted">
                            Créée le {{ $formation->created_at->format('d/m/Y à H:i') }}
                            @if($formation->updated_at != $formation->created_at)
                                | Modifiée le {{ $formation->updated_at->format('d/m/Y à H:i') }}
                            @endif
                        </small>
                    </div>
                    <div>
                        <form action="{{ route('dashboard.formations.destroy', $formation->id) }}" method="POST" 
                              class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash me-1"></i>Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
