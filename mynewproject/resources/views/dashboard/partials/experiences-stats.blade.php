<a href="{{ route('dashboard.statistiques.experiences') }}" class="text-decoration-none">
    <div class="dashboard-card h-100">
        <div class="card-body text-center">
            <div class="mb-3">
                <i class="fas fa-chart-line fa-2x text-warning"></i>
            </div>
            <h6 class="card-title mb-3">Statistiques des Expériences</h6>
            <div class="stats-summary">
                <div class="d-flex justify-content-around">
                    <div class="text-center">
                        <span class="badge bg-warning rounded-pill">{{ $totalExperiences ?? 0 }}</span>
                        <p class="text-muted small mt-1">Total</p>
                    </div>
                    <div class="text-center">
                        <span class="badge bg-info rounded-pill">{{ $yearsExperience ?? 0 }}</span>
                        <p class="text-muted small mt-1">Années</p>
                    </div>
                    <div class="text-center">
                        <span class="badge bg-danger rounded-pill">{{ $currentExperiences ?? 0 }}</span>
                        <p class="text-muted small mt-1">En cours</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
