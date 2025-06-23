@extends('layouts.profhead')

@section('content')
<div class="container py-4 fade-in">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="display-6 fw-bold mb-1">Changer le mot de passe</h1>
                    <p class="text-muted mb-0">Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning text-dark border-0">
                    <h5 class="mb-0"><i class="fas fa-key me-2"></i>Mise à jour du mot de passe</h5>
                </div>
                <div class="card-body">
                    @if (session('status') === 'password-updated')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            Votre mot de passe a été mis à jour avec succès.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <!-- Current Password -->
                        <div class="mb-4">
                            <label for="current_password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-1"></i>Mot de passe actuel *
                            </label>
                            <div class="input-group">
                                <input type="password" 
                                       class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                                       id="current_password" 
                                       name="current_password" 
                                       autocomplete="current-password"
                                       required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                                    <i class="fas fa-eye" id="current_password_icon"></i>
                                </button>
                            </div>
                            @error('current_password', 'updatePassword')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-key me-1"></i>Nouveau mot de passe *
                            </label>
                            <div class="input-group">
                                <input type="password" 
                                       class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       autocomplete="new-password"
                                       required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                    <i class="fas fa-eye" id="password_icon"></i>
                                </button>
                            </div>
                            @error('password', 'updatePassword')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Le mot de passe doit contenir au moins 8 caractères avec des lettres majuscules, minuscules et des chiffres.
                            </div>
                        </div>

                        <!-- Password Confirmation -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">
                                <i class="fas fa-check-double me-1"></i>Confirmer le nouveau mot de passe *
                            </label>
                            <div class="input-group">
                                <input type="password" 
                                       class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       autocomplete="new-password"
                                       required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye" id="password_confirmation_icon"></i>
                                </button>
                            </div>
                            @error('password_confirmation', 'updatePassword')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center">
                                <span class="me-2 small fw-semibold">Force du mot de passe:</span>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar" id="password-strength" role="progressbar" style="width: 0%"></div>
                                </div>
                                <span class="ms-2 small" id="password-strength-text">Faible</span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-1"></i>Mettre à jour le mot de passe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security Tips Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white border-0">
                    <h6 class="mb-0"><i class="fas fa-shield-alt me-2"></i>Conseils de sécurité</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                            <div class="small">
                                <strong>Utilisez un mot de passe unique</strong><br>
                                Ne réutilisez pas le mot de passe d'autres comptes
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                            <div class="small">
                                <strong>Longueur minimale de 8 caractères</strong><br>
                                Plus c'est long, mieux c'est
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                            <div class="small">
                                <strong>Mélange de caractères</strong><br>
                                Majuscules, minuscules, chiffres et symboles
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                            <div class="small">
                                <strong>Évitez les informations personnelles</strong><br>
                                Pas de nom, date de naissance, etc.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.progress-bar {
    transition: all 0.3s ease;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}
</style>
@endpush

@push('scripts')
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '_icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Password strength checker
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthBar = document.getElementById('password-strength');
    const strengthText = document.getElementById('password-strength-text');
    
    let strength = 0;
    let strengthLabel = 'Faible';
    let strengthColor = 'bg-danger';
    
    // Length check
    if (password.length >= 8) strength += 25;
    if (password.length >= 12) strength += 25;
    
    // Character variety checks
    if (/[a-z]/.test(password)) strength += 12.5;
    if (/[A-Z]/.test(password)) strength += 12.5;
    if (/[0-9]/.test(password)) strength += 12.5;
    if (/[^A-Za-z0-9]/.test(password)) strength += 12.5;
    
    // Update UI
    if (strength >= 75) {
        strengthLabel = 'Très fort';
        strengthColor = 'bg-success';
    } else if (strength >= 50) {
        strengthLabel = 'Fort';
        strengthColor = 'bg-info';
    } else if (strength >= 25) {
        strengthLabel = 'Moyen';
        strengthColor = 'bg-warning';
    }
    
    strengthBar.style.width = strength + '%';
    strengthBar.className = 'progress-bar ' + strengthColor;
    strengthText.textContent = strengthLabel;
    strengthText.className = 'ms-2 small ' + (strengthColor === 'bg-success' ? 'text-success' : 
                                               strengthColor === 'bg-info' ? 'text-info' :
                                               strengthColor === 'bg-warning' ? 'text-warning' : 'text-danger');
});
</script>
@endpush
@endsection