@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4">Statistiques des Expériences</h1>    <div class="row">
        <!-- Total des expériences -->
        <div class="col-md-4 mb-4">
            <div class="dashboard-card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-briefcase fa-2x text-primary"></i>
                    </div>
                    <h6 class="card-title">Total des Expériences</h6>
                    <div class="display-4">{{ $stats['total'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <!-- Expériences en cours -->
        <div class="col-md-4 mb-4">
            <div class="dashboard-card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                    </div>
                    <h6 class="card-title">Expériences en Cours</h6>
                    <div class="display-4">{{ $stats['enCours'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <!-- Expériences terminées -->
        <div class="col-md-4 mb-4">
            <div class="dashboard-card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                    <h6 class="card-title">Expériences Terminées</h6>
                    <div class="display-4">{{ ($stats['total'] ?? 0) - ($stats['enCours'] ?? 0) }}</div>
                </div>
            </div>
        </div>
    </div><!-- Statistiques par utilisateur -->
    <div class="dashboard-card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-users me-2"></i>
                Expériences par Utilisateur
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Nombre d'Expériences</th>
                        </tr>
                    </thead>
                    <tbody>                        @forelse($stats['parUser'] ?? [] as $stat)
                            <tr>
                                <td>
                                    @if(isset($stat->user) && $stat->user)
                                        {{ $stat->user->nom ?? 'N/A' }} {{ $stat->user->prenom ?? '' }}
                                    @else
                                        Utilisateur non défini
                                    @endif
                                </td>
                                <td>{{ $stat->count ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">Aucune donnée disponible</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- Statistiques par type -->
    <div class="dashboard-card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-th-list me-2"></i>
                Expériences par Type
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Type d'Expérience</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>                        @forelse($stats['parType'] ?? [] as $stat)
                            <tr>
                                <td>
                                    @if(isset($stat->typeExperience) && $stat->typeExperience)
                                        {{ $stat->typeExperience->nom ?? 'Type non défini' }}
                                    @else
                                        Type non défini
                                    @endif
                                </td>
                                <td>{{ $stat->count ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">Aucune donnée disponible</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- Statistiques par entreprise -->
    <div class="dashboard-card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-building me-2"></i>
                Expériences par Entreprise
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Entreprise</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>                        @forelse($stats['parEntreprise'] ?? [] as $stat)
                            <tr>
                                <td>{{ $stat->entreprise ?? 'Entreprise non définie' }}</td>
                                <td>{{ $stat->count ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">Aucune donnée disponible</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- Statistiques par année -->
    <div class="dashboard-card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-calendar me-2"></i>
                Expériences par Année de Début
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Année</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['parAnnee'] ?? [] as $stat)
                            <tr>
                                <td>{{ $stat->annee ?? 'N/A' }}</td>
                                <td>{{ $stat->count ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">Aucune donnée disponible</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.dashboard-card {
    background-color: #ffffff;
    border: 1px solid #e3e6f0;
    border-radius: 10px;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.dashboard-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.25rem 2rem 0 rgba(33, 40, 50, 0.2);
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-bottom: none;
    padding: 1.25rem;
    border-radius: 10px 10px 0 0;
}

.card-title {
    color: #ffffff !important;
    margin: 0;
    font-weight: 600;
    font-size: 1.1rem;
}

.card-body {
    padding: 1.5rem;
    color: #5a5c69;
}

.table {
    color: #5a5c69;
    margin-bottom: 0;
}

.table th {
    border-top: none;
    color: #5a5c69;
    font-weight: 600;
    border-bottom: 2px solid #e3e6f0;
    background-color: #f8f9fc;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.table td {
    border-color: #e3e6f0;
    vertical-align: middle;
    padding: 0.875rem 0.75rem;
}

.table-hover tbody tr:hover {
    background-color: #f8f9fc;
    color: #5a5c69;
}

.display-4 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #5a5c69;
    margin-bottom: 0;
}

.text-primary .display-4 {
    color: #4e73df !important;
}

.text-warning .display-4 {
    color: #f6c23e !important;
}

.text-success .display-4 {
    color: #1cc88a !important;
}

.text-muted {
    color: #858796 !important;
}

.table-responsive {
    border-radius: 8px;
}

/* Icônes colorées */
.fa-briefcase {
    color: #4e73df !important;
}

.fa-hourglass-half {
    color: #f6c23e !important;
}

.fa-check-circle {
    color: #1cc88a !important;
}

.fa-users,
.fa-th-list,
.fa-building,
.fa-calendar {
    color: #ffffff !important;
}

/* Amélioration des cards statistiques */
.dashboard-card .card-body.text-center {
    padding: 2rem 1.5rem;
}

/* Animation des statistiques */
.display-4 {
    animation: countUp 1s ease-out;
}

@keyframes countUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem !important;
    }
    
    .display-4 {
        font-size: 2rem;
    }
    
    .dashboard-card .card-body.text-center {
        padding: 1.5rem 1rem;
    }
}

/* États vides */
.text-center.text-muted {
    padding: 2rem;
    font-style: italic;
}
</style>
@endpush
@endsection
