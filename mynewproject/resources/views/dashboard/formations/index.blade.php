@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-graduation-cap me-2"></i>Gestion des Formations</h1>
        <a href="{{ route('dashboard.formations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Ajouter une formation
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Liste des formations ({{ $formations->count() }})</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Dates</th>
                            <th>Lieu</th>
                            <!-- Modalité column hidden as requested -->
                            <th>Places</th>
                            <th>Prix Total</th>
                            <th>Durée Totale</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Thèmes</th>
                            <th>Formateurs</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($formations as $formation)
                        <tr>
                            <td>
                                <small class="text-muted">Du</small><br>
                                <strong>{{ \Carbon\Carbon::parse($formation->dateDebut)->format('d/m/Y') }}</strong><br>
                                <small class="text-muted">Au</small><br>
                                <strong>{{ \Carbon\Carbon::parse($formation->dateFin)->format('d/m/Y') }}</strong>
                            </td>
                            <td>
                                <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                {{ $formation->lieu }}                            </td>
                            <!-- Modalité column hidden as requested -->
                            <td>
                                <i class="fas fa-users text-success me-1"></i>
                                Total: {{ ($formation->nombre_ouvriers ?? 0) + ($formation->nombre_encadrants ?? 0) + ($formation->nombre_cadres ?? 0) }}
                                <br><small class="text-muted">
                                    O:{{ $formation->nombre_ouvriers ?? 0 }} | 
                                    E:{{ $formation->nombre_encadrants ?? 0 }} | 
                                    C:{{ $formation->nombre_cadres ?? 0 }}
                                </small>
                            </td>
                            <td>
                                <span class="fw-bold text-success">
                                    {{ number_format($formation->prix_total, 2) }} DH
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-primary">
                                    {{ $formation->duree_totale }} h
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $formation->typeFormation->nom }}
                                </span>
                            </td>
                            <td>
                                @if($formation->statutFormation->nom == 'active')
                                    <span class="badge bg-success">{{ ucfirst($formation->statutFormation->nom) }}</span>
                                @elseif($formation->statutFormation->nom == 'inactive')
                                    <span class="badge bg-danger">{{ ucfirst($formation->statutFormation->nom) }}</span>
                                @else
                                    <span class="badge bg-warning">{{ ucfirst($formation->statutFormation->nom) }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $formation->themes->count() }} thème(s)</span>
                                @if($formation->themes->count() > 0)
                                    <br><small class="text-muted">
                                        {{ $formation->themes->pluck('titre')->take(2)->implode(', ') }}
                                        @if($formation->themes->count() > 2)...@endif
                                    </small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $formation->formateurs->count() }} formateur(s)</span>
                                @if($formation->formateurs->count() > 0)
                                    <br><small class="text-muted">
                                        {{ $formation->formateurs->pluck('name')->take(2)->implode(', ') }}
                                        @if($formation->formateurs->count() > 2)...@endif
                                    </small>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('dashboard.formations.show', $formation->id) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('dashboard.formations.edit', $formation->id) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dashboard.formations.destroy', $formation->id) }}" 
                                          method="POST" style="display: inline;"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                                    <h5>Aucune formation trouvée</h5>
                                    <p>Commencez par ajouter votre première formation.</p>
                                    <a href="{{ route('dashboard.formations.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-1"></i>Ajouter une formation
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    @if($formations->count() > 0)
    <div class="row mt-4">        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-graduation-cap fa-2x text-primary mb-2"></i>
                    <h4>{{ $formations->count() }}</h4>
                    <p class="text-muted">Total formations</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                    <h4>{{ number_format($formations->sum('prix_total'), 2) }} DH</h4>
                    <p class="text-muted">Valeur totale</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-clock fa-2x text-info mb-2"></i>
                    <h4>{{ $formations->sum('duree_totale') }} h</h4>
                    <p class="text-muted">Durée totale</p>
                </div>
            </div>
        </div><!-- Carte "Places totales" masquée comme demandé -->
    </div>
    @endif
</div>
@endsection
