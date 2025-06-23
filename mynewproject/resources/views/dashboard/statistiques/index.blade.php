@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4">Statistiques Globales</h1>

    <!-- Statistiques des Compétences -->
    <div class="section-container mb-5">
        <div class="text-center mb-4">
            <h2 class="h4 mb-3"><i class="fas fa-brain me-2"></i>Compétences</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-list fa-2x text-primary"></i>
                        </div>
                        <h6 class="card-title">Total des Compétences</h6>
                        <div class="display-4">{{ $data['totalCompetences'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                        <h6 class="card-title">Compétences Validées</h6>
                        <div class="display-4">{{ $data['completedCompetences'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                        </div>
                        <h6 class="card-title">Compétences En Cours</h6>
                        <div class="display-4">{{ $data['inProgressCompetences'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('dashboard.statistiques.competences') }}" class="btn btn-primary">
                <i class="fas fa-chart-bar me-2"></i>Voir les détails
            </a>
        </div>
    </div>

    <!-- Statistiques des Diplômes -->
    <div class="section-container mb-5">
        <div class="text-center mb-4">
            <h2 class="h4 mb-3"><i class="fas fa-graduation-cap me-2"></i>Diplômes</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-scroll fa-2x text-info"></i>
                        </div>
                        <h6 class="card-title">Total des Diplômes</h6>
                        <div class="display-4">{{ $data['totalDiplomes'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-th-list fa-2x text-info"></i>
                        </div>
                        <h6 class="card-title">Types de Diplômes</h6>
                        <div class="display-4">{{ $data['diplomesParType'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('dashboard.statistiques.diplomes') }}" class="btn btn-info">
                <i class="fas fa-chart-pie me-2"></i>Voir les détails
            </a>
        </div>
    </div>

    <!-- Statistiques des Expériences -->
    <div class="section-container mb-5">
        <div class="text-center mb-4">
            <h2 class="h4 mb-3"><i class="fas fa-briefcase me-2"></i>Expériences</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-list fa-2x text-warning"></i>
                        </div>
                        <h6 class="card-title">Total des Expériences</h6>
                        <div class="display-4">{{ $data['totalExperiences'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-clock fa-2x text-warning"></i>
                        </div>
                        <h6 class="card-title">Années d'Expérience</h6>
                        <div class="display-4">{{ $data['yearsExperience'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-briefcase fa-2x text-warning"></i>
                        </div>
                        <h6 class="card-title">Expériences En Cours</h6>
                        <div class="display-4">{{ $data['currentExperiences'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('dashboard.statistiques.experiences') }}" class="btn btn-warning">
                <i class="fas fa-chart-line me-2"></i>Voir les détails
            </a>
        </div>
    </div>

    <!-- Statistiques des Formations -->
    <div class="section-container">
        <div class="text-center mb-4">
            <h2 class="h4 mb-3"><i class="fas fa-chalkboard-teacher me-2"></i>Formations</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-chalkboard fa-2x text-success"></i>
                        </div>
                        <h6 class="card-title">Total des Formations</h6>
                        <div class="display-4">{{ $data['formationsCount'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-book-open fa-2x text-success"></i>
                        </div>
                        <h6 class="card-title">Thèmes de Formation</h6>
                        <div class="display-4">{{ $data['themeFormationsCount'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.section-container {
    background-color: #2b2b40;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.dashboard-card {
    background-color: #1e1e2d;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    transition: transform 0.2s;
}

.dashboard-card:hover {
    transform: translateY(-5px);
}

.display-4 {
    font-size: 2.5rem;
    font-weight: bold;
    margin: 0;
}

.card-title {
    color: #9899ac;
}

.btn {
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 0.5rem 1.5rem;
}
</style>
@endpush
@endsection
