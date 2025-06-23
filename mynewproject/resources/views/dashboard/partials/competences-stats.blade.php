<a href="{{ route('dashboard.statistiques.competences') }}" class="text-decoration-none">
    <div class="dashboard-card h-100">
        <div class="card-body text-center">
            <div class="mb-3">
                <i class="fas fa-chart-bar fa-2x text-success"></i>
            </div>
            <h6 class="card-title mb-3">Statistiques des Compétences</h6>
            <div class="stats-summary">
                <div class="d-flex justify-content-around">
                    <div class="text-center">
                        <span class="badge bg-primary rounded-pill">{{ $totalCompetences ?? 0 }}</span>
                        <p class="text-muted small mt-1">Total</p>
                    </div>
                    <div class="text-center">
                        <span class="badge bg-success rounded-pill">{{ $completedCompetences ?? 0 }}</span>
                        <p class="text-muted small mt-1">Validées</p>
                    </div>
                    <div class="text-center">
                        <span class="badge bg-warning rounded-pill">{{ $inProgressCompetences ?? 0 }}</span>
                        <p class="text-muted small mt-1">En cours</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
