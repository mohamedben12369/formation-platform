@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4">Statistiques des Diplômes</h1>

    <div class="row">
        <!-- Total des diplômes -->
        <div class="col-md-4 mb-4">
            <div class="dashboard-card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                    </div>
                    <h6 class="card-title">Total des Diplômes</h6>
                    <div class="display-4">{{ $stats['total'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques par utilisateur -->
    <div class="dashboard-card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-users me-2"></i>
                Diplômes par Utilisateur
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Nombre de Diplômes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['parUser'] as $stat)
                            <tr>
                                <td>{{ $stat->user->nom ?? 'N/A' }} {{ $stat->user->prenom ?? '' }}</td>
                                <td>{{ $stat->count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Statistiques par type -->
    <div class="dashboard-card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-th-list me-2"></i>
                Diplômes par Type
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Type de Diplôme</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['parType'] as $stat)
                            <tr>
                                <td>{{ $stat->typeDiplome->nom ?? 'N/A' }}</td>
                                <td>{{ $stat->count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Statistiques par établissement -->
    <div class="dashboard-card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-university me-2"></i>
                Diplômes par Établissement
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Établissement</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['parEtablissement'] as $stat)
                            <tr>
                                <td>{{ $stat->etablissement->nom ?? 'N/A' }}</td>
                                <td>{{ $stat->count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.dashboard-card {
    background-color: #1e1e2d;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    margin-bottom: 1rem;
}

.card-header {
    background-color: #1a1a27;
    border-bottom: 1px solid #2b2b40;
    padding: 1rem;
    border-radius: 10px 10px 0 0;
}

.card-title {
    color: #9899ac;
    margin: 0;
}

.card-body {
    padding: 1.5rem;
}

.table {
    color: #9899ac;
}

.table th {
    border-top: none;
    color: #6c7293;
}

.table td {
    border-color: #2b2b40;
}

.table-hover tbody tr:hover {
    background-color: #1a1a27;
}

.display-4 {
    font-size: 2.5rem;
    font-weight: bold;
    color: #009ef7;
}
</style>
@endpush
@endsection
