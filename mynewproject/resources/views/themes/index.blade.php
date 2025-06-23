@extends('layouts.app')
@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestion des Thèmes de Formation</h1>
        <a href="{{ route('dashboard.theme-formations.create') }}" class="btn btn-primary">
            <img src="{{ asset('images/add.webp') }}" alt="Ajouter" width="20" height="20" class="me-1">
            Ajouter un Thème
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Statistiques rapides -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Total Thèmes</h6>
                            <h4>{{ $themes->total() }}</h4>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Page actuelle</h6>
                            <h4>{{ $themes->currentPage() }}</h4>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-file-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Par page</h6>
                            <h4>{{ $themes->perPage() }}</h4>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-list fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Pages totales</h6>
                            <h4>{{ $themes->lastPage() }}</h4>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-copy fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des thèmes -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Liste des Thèmes de Formation</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Prix</th>
                            <th>Durée</th>
                            <th>Prérequis</th>
                            <th>Compétences visées</th>
                            <th>Sous-Domaine</th>
                            <th>Axe</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($themes as $theme)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $theme->idtheme }}</span></td>
                            <td>
                                <strong>{{ $theme->titre }}</strong>
                            </td>
                            <td>
                                @if($theme->prix)
                                    <span class="badge bg-success">{{ number_format($theme->prix, 2) }} DH</span>
                                @else
                                    <span class="text-muted">Non défini</span>
                                @endif
                            </td>
                            <td>
                                @if($theme->duree)
                                    <span class="badge bg-info">{{ $theme->duree }}h</span>
                                @else
                                    <span class="text-muted">Non défini</span>
                                @endif
                            </td>
                            <td>
                                @if($theme->prerequis)
                                    <span data-bs-toggle="tooltip" title="{{ $theme->prerequis }}">
                                        {{ Str::limit($theme->prerequis, 30) }}
                                    </span>
                                @else
                                    <span class="text-muted">Aucun</span>
                                @endif
                            </td>
                            <td>
                                @if($theme->competence_visees)
                                    <span data-bs-toggle="tooltip" title="{{ $theme->competence_visees }}">
                                        {{ Str::limit($theme->competence_visees, 30) }}
                                    </span>
                                @else
                                    <span class="text-muted">Non défini</span>
                                @endif
                            </td>
                            <td>
                                @if($theme->sousDomaine)
                                    <small class="text-muted">{{ $theme->sousDomaine->description }}</small>
                                @else
                                    <span class="text-muted">Non défini</span>
                                @endif
                            </td>
                            <td>
                                @if($theme->axe)
                                    <span class="badge bg-primary">{{ $theme->axe->nom }}</span>
                                @else
                                    <span class="text-muted">Non défini</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('dashboard.theme-formations.edit', $theme->idtheme) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Modifier">
                                        <img src="{{ asset('images/edit.webp') }}" alt="Modifier" width="16" height="16">
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteThemeModal{{ $theme->idtheme }}" 
                                            title="Supprimer">
                                        <img src="{{ asset('images/delete.webp') }}" alt="Supprimer" width="16" height="16">
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p>Aucun thème de formation trouvé.</p>
                                    <a href="{{ route('dashboard.theme-formations.create') }}" class="btn btn-primary">
                                        Créer le premier thème
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($themes->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Affichage de {{ $themes->firstItem() }} à {{ $themes->lastItem() }} 
                        sur {{ $themes->total() }} résultats
                    </small>
                </div>
                <div>
                    {{ $themes->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Modals de suppression -->
    @foreach($themes as $theme)
    <div class="modal fade" id="deleteThemeModal{{ $theme->idtheme }}" tabindex="-1" aria-labelledby="deleteThemeModalLabel{{ $theme->idtheme }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.theme-formations.destroy', $theme->idtheme) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteThemeModalLabel{{ $theme->idtheme }}">
                            <i class="fas fa-exclamation-triangle me-2"></i>Confirmer la suppression
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                            <p>Êtes-vous sûr de vouloir supprimer le thème :</p>
                            <p class="fw-bold text-danger">{{ $theme->titre }}</p>
                            <p class="text-warning">
                                <small><i class="fas fa-warning me-1"></i>Cette action est irréversible.</small>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Annuler
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Confirmer la suppression
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
});
</script>
@endpush

@push('styles')
<style>
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
}

.btn-group .btn {
    border-radius: 0.25rem !important;
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.badge {
    font-size: 0.75em;
}

.card-body .text-muted {
    color: #6c757d !important;
}
</style>
@endpush
@endsection
