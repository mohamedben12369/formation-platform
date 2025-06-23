@extends('layouts.profhead')

@section('content')
<div class="container py-4 fade-in">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="display-6 fw-bold mb-1">Paramètres du compte</h1>
                    <p class="text-muted mb-0">Gérez vos préférences et paramètres de sécurité</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Cards -->
    <div class="row g-4">
        <!-- Notifications -->
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-header bg-gradient bg-primary text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-bell fa-lg me-3"></i>
                        <h5 class="mb-0 fw-bold">Notifications</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                            <label class="form-check-label fw-semibold" for="emailNotifications">
                                Notifications par email
                            </label>
                            <div class="form-text">Recevoir les notifications importantes par email</div>
                        </div>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="formationNotifications" checked>
                            <label class="form-check-label fw-semibold" for="formationNotifications">
                                Nouvelles formations
                            </label>
                            <div class="form-text">Être notifié des nouvelles formations disponibles</div>
                        </div>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="newsNotifications">
                            <label class="form-check-label fw-semibold" for="newsNotifications">
                                Newsletter
                            </label>
                            <div class="form-text">Recevoir notre newsletter mensuelle</div>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white border-0">
                    <button class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Sauvegarder les préférences
                    </button>
                </div>
            </div>
        </div>

        <!-- Privacy -->
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-header bg-gradient bg-success text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shield-alt fa-lg me-3"></i>
                        <h5 class="mb-0 fw-bold">Confidentialité</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="publicProfile" checked>
                            <label class="form-check-label fw-semibold" for="publicProfile">
                                Profil public
                            </label>
                            <div class="form-text">Permettre aux autres de voir votre profil</div>
                        </div>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="showEmail">
                            <label class="form-check-label fw-semibold" for="showEmail">
                                Afficher l'email
                            </label>
                            <div class="form-text">Rendre votre email visible sur votre profil public</div>
                        </div>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="showPhone">
                            <label class="form-check-label fw-semibold" for="showPhone">
                                Afficher le téléphone
                            </label>
                            <div class="form-text">Rendre votre numéro visible sur votre profil public</div>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white border-0">
                    <button class="btn btn-success w-100">
                        <i class="fas fa-lock me-2"></i>Mettre à jour la confidentialité
                    </button>
                </div>
            </div>
        </div>

        <!-- Account Security -->
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-header bg-gradient bg-warning text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-key fa-lg me-3"></i>
                        <h5 class="mb-0 fw-bold">Sécurité du compte</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <div class="fw-semibold">Mot de passe</div>
                            <div class="text-muted small">Dernière modification il y a 30 jours</div>
                        </div>
                        <span class="badge bg-success">Sécurisé</span>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <div class="fw-semibold">Authentification à deux facteurs</div>
                            <div class="text-muted small">Protection supplémentaire</div>
                        </div>
                        <span class="badge bg-secondary">Désactivé</span>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <div class="fw-semibold">Sessions actives</div>
                            <div class="text-muted small">2 sessions actives</div>
                        </div>
                        <button class="btn btn-sm btn-outline-warning">Voir</button>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('profile.password') }}" class="btn btn-warning w-100">
                        <i class="fas fa-cog me-2"></i>Gérer la sécurité
                    </a>
                </div>
            </div>
        </div>

        <!-- Export Data -->
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-header bg-gradient bg-info text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-download fa-lg me-3"></i>
                        <h5 class="mb-0 fw-bold">Gestion des données</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center py-3">
                        <i class="fas fa-file-export fa-3x text-info mb-3"></i>
                        <h6 class="fw-bold">Exporter vos données</h6>
                        <p class="text-muted mb-4">
                            Téléchargez une copie de toutes vos données personnelles,
                            compétences, expériences et diplômes.
                        </p>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    <button class="btn btn-info w-100 mb-2">
                        <i class="fas fa-download me-2"></i>Exporter les données
                    </button>
                    <a href="{{ route('profile.delete') }}" class="btn btn-outline-danger w-100">
                        <i class="fas fa-trash me-2"></i>Supprimer le compte
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.hover-card {
    transition: all 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.bg-gradient {
    background: linear-gradient(45deg, var(--bs-primary), var(--bs-primary-rgb)) !important;
}

.bg-gradient.bg-success {
    background: linear-gradient(45deg, #198754, #20c997) !important;
}

.bg-gradient.bg-warning {
    background: linear-gradient(45deg, #fd7e14, #ffc107) !important;
}

.bg-gradient.bg-info {
    background: linear-gradient(45deg, #0dcaf0, #6f42c1) !important;
}

.form-check-input:checked {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
}

.btn:hover {
    transform: translateY(-1px);
}

.fade-in {
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle notification preferences
    document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Here you would typically send an AJAX request to save the preference
            console.log(`${this.id} is now ${this.checked ? 'enabled' : 'disabled'}`);
        });
    });
    
    // Initialize tooltips if any
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endpush
