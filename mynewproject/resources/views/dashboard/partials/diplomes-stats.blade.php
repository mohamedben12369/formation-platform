<a href="{{ route('dashboard.statistiques.diplomes') }}" class="text-decoration-none">
    <div class="dashboard-card h-100">
        <div class="card-body text-center">
            <div class="mb-3">
                <i class="fas fa-chart-pie fa-2x text-info"></i>
            </div>
            <h6 class="card-title mb-3">Statistiques des Diplômes</h6>
            <div class="stats-summary">
                <div class="d-flex justify-content-around">
                    <div class="text-center">
                        <span class="badge bg-info rounded-pill">{{ $totalDiplomes ?? 0 }}</span>
                        <p class="text-muted small mt-1">Total</p>
                    </div>
                    <div class="text-center">
                        <span class="badge bg-primary rounded-pill">{{ $diplomesParType ?? 0 }}</span>
                        <p class="text-muted small mt-1">Types</p>
                    </div>
                    <div class="text-center">
                        <span class="badge bg-success rounded-pill">{{ $recentDiplomes ?? 0 }}</span>
                        <p class="text-muted small mt-1">Récents</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
