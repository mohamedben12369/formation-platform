@extends('layouts.profhead')

@section('content')
<div class="container-fluid py-4 fade-in">    <!-- Enhanced Profile Header -->
    <div class="position-relative mb-5">
        <!-- Background Cover -->
        <div class="rounded-4 overflow-hidden position-relative" style="height: 280px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            @if($user->background_image)
                <img src="{{ Storage::url($user->background_image) }}" 
                     class="w-100 h-100 object-fit-cover" 
                     style="object-fit: cover; opacity: 0.8;" 
                     alt="Background">
            @else
                <div class="w-100 h-100 d-flex align-items-center justify-content-center">                    <div class="text-white text-center">
                        <i class="fas fa-user-circle fa-4x mb-3 opacity-50"></i>
                        <h4 class="fw-light opacity-75">Profil de {{ $user->full_name }}</h4>
                    </div>
                </div>
            @endif
            
            <!-- Button to change cover photo -->
            <div class="position-absolute top-0 end-0 m-3">
                <button class="btn btn-light btn-sm rounded-pill shadow-sm photo-btn" 
                        onclick="document.getElementById('background_photo_input').click()" 
                        data-bs-toggle="tooltip" 
                        title="Changer la photo de couverture">
                    <i class="fas fa-camera me-1"></i>
                    <span class="d-none d-sm-inline">Couverture</span>
                </button>
            </div>
        </div>
          <!-- Profile Picture -->
        <div class="position-absolute" style="bottom: -60px; left: 50%; transform: translateX(-50%);">
            <div class="position-relative">
                @if($user->profile_image_url)
                    <img src="{{ $user->profile_image_url }}" 
                         class="rounded-circle border border-5 border-white shadow-lg" 
                         width="120" height="120" 
                         style="object-fit: cover;" 
                         alt="Profile"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="rounded-circle border border-5 border-white shadow-lg bg-primary d-flex align-items-center justify-content-center text-white" 
                         style="width: 120px; height: 120px; font-size: 2.5rem; font-weight: bold; display: none;">
                        {{ strtoupper(substr($user->full_name, 0, 1)) }}
                    </div>
                @else
                    <div class="rounded-circle border border-5 border-white shadow-lg bg-primary d-flex align-items-center justify-content-center text-white" 
                         style="width: 120px; height: 120px; font-size: 2.5rem; font-weight: bold;">
                        {{ strtoupper(substr($user->full_name, 0, 1)) }}
                    </div>
                @endif
                
                <!-- Button to change profile photo -->
                <button class="btn btn-primary btn-sm rounded-circle position-absolute shadow-sm photo-btn" 
                        style="bottom: 5px; right: 5px; width: 35px; height: 35px;" 
                        onclick="document.getElementById('profile_photo_input').click()" 
                        data-bs-toggle="tooltip" 
                        title="Changer la photo de profil">
                    <i class="fas fa-camera" style="font-size: 0.8rem;"></i>
                </button>
            </div>
        </div>
        
        <!-- Hidden file inputs -->
        <form id="photo-upload-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" style="display: none;">
            @csrf
            @method('patch')
            <input type="file" id="profile_photo_input" name="profile_photo" accept="image/*" onchange="uploadPhoto('profile')">
            <input type="file" id="background_photo_input" name="background_photo" accept="image/*" onchange="uploadPhoto('background')">
        </form>    <!-- User Info -->
    <div class="text-center mb-5" style="margin-top: 70px;">
        <h1 class="display-6 fw-bold mb-2">{{ $user->full_name }}</h1>
        @if($user->role)
            <span class="badge bg-gradient bg-primary fs-6 px-3 py-2">
                <i class="fas fa-star me-1"></i>{{ $user->role->name }}
            </span>
        @endif
    </div>

    <!-- Profile Sections -->
    <div class="row g-4 mb-5">
        <!-- Compétences -->
        <div class="col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-header bg-gradient bg-primary text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-brain fa-lg me-3"></i>
                        <h5 class="mb-0 fw-bold">Mes Compétences</h5>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($user->competences as $competence)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="fw-semibold mb-1">{{ $competence->nom }}</h6>
                                    <p class="text-muted small mb-2">
                                        <i class="fas fa-tag me-1"></i>
                                        {{ $competence->sousDomaine->nom ?? 'Non catégorisé' }}
                                    </p>
                                    <span class="badge bg-primary-subtle text-primary">
                                        {{ $competence->niveau->nom ?? 'Débutant' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-lightbulb fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucune compétence enregistrée</p>
                        </div>
                    @endforelse
                </div>
                @if($user->competences->count() > 0)
                    <div class="card-footer bg-transparent border-0">
                        <div class="text-center">
                            <span class="badge bg-secondary">{{ $user->competences->count() }} compétence(s)</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Expériences -->
        <div class="col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-header bg-gradient bg-success text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-briefcase fa-lg me-3"></i>
                        <h5 class="mb-0 fw-bold">Mes Expériences</h5>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($user->experiences as $experience)
                        <div class="border-bottom pb-3 mb-3">
                            <h6 class="fw-semibold mb-1">{{ $experience->titre }}</h6>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-building me-1"></i>{{ $experience->entreprise }}
                            </p>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($experience->date_debut)->format('M Y') }} - 
                                {{ $experience->date_fin ? \Carbon\Carbon::parse($experience->date_fin)->format('M Y') : 'Présent' }}
                            </p>
                            @if($experience->description)
                                <p class="small text-dark">{{ Str::limit($experience->description, 100) }}</p>
                            @endif
                            <span class="badge bg-success-subtle text-success">
                                {{ $experience->typeExperience->nom ?? 'Expérience' }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucune expérience enregistrée</p>
                        </div>
                    @endforelse
                </div>
                @if($user->experiences->count() > 0)
                    <div class="card-footer bg-transparent border-0">
                        <div class="text-center">
                            <span class="badge bg-secondary">{{ $user->experiences->count() }} expérience(s)</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Diplômes -->
        <div class="col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-header bg-gradient bg-info text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-graduation-cap fa-lg me-3"></i>
                        <h5 class="mb-0 fw-bold">Mes Diplômes</h5>
                    </div>
                </div>
                <div class="card-body">
                    @forelse($user->diplomes as $diplome)
                        <div class="border-bottom pb-3 mb-3">
                            <h6 class="fw-semibold mb-1">{{ $diplome->nom }}</h6>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-university me-1"></i>
                                {{ $diplome->etablissement->nom ?? 'Non spécifié' }}
                            </p>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-calendar-check me-1"></i>
                                Obtenu le {{ \Carbon\Carbon::parse($diplome->date_obtention)->format('d/m/Y') }}
                            </p>
                            <span class="badge bg-info-subtle text-info">
                                {{ $diplome->typeDiplome->nom ?? 'Diplôme' }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Aucun diplôme enregistré</p>
                        </div>
                    @endforelse
                </div>
                @if($user->diplomes->count() > 0)
                    <div class="card-footer bg-transparent border-0">
                        <div class="text-center">
                            <span class="badge bg-secondary">{{ $user->diplomes->count() }} diplôme(s)</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-gradient bg-dark text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-cogs fa-lg me-3"></i>
                        <h5 class="mb-0 fw-bold">Actions Rapides</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="{{ route('profile.information') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-user-edit fa-lg mb-2 d-block"></i>
                                <span class="fw-semibold">Modifier le profil</span>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('profile.password') }}" class="btn btn-outline-warning w-100 py-3">
                                <i class="fas fa-key fa-lg mb-2 d-block"></i>
                                <span class="fw-semibold">Changer mot de passe</span>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-success w-100 py-3">
                                <i class="fas fa-eye fa-lg mb-2 d-block"></i>
                                <span class="fw-semibold">Vue d'ensemble</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

.bg-gradient.bg-info {
    background: linear-gradient(45deg, #0dcaf0, #6f42c1) !important;
}

.bg-gradient.bg-dark {
    background: linear-gradient(45deg, #212529, #495057) !important;
}

.card-header {
    border-bottom: none !important;
}

.object-fit-cover {
    object-fit: cover;
}

/* Photo buttons styles */
.photo-btn {
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: none !important;
}

.photo-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
}

.photo-btn:active {
    transform: scale(0.95);
}

/* Loading spinner */
.photo-loading {
    position: relative;
    pointer-events: none;
}

.photo-loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 20px;
    border: 2px solid #ffffff;
    border-top: 2px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}
</style>
@endpush

@push('scripts')
<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Upload photo function
function uploadPhoto(type) {
    const input = document.getElementById(type + '_photo_input');
    const btn = type === 'profile' ? 
        document.querySelector('[onclick="document.getElementById(\'profile_photo_input\').click()"]') :
        document.querySelector('[onclick="document.getElementById(\'background_photo_input\').click()"]');
    
    if (input.files && input.files[0]) {
        // Show loading state
        btn.classList.add('photo-loading');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        
        // Create preview
        const reader = new FileReader();
        reader.onload = function(e) {
            if (type === 'profile') {
                const profileImg = document.querySelector('.rounded-circle img, .rounded-circle');
                if (profileImg.tagName === 'IMG') {
                    profileImg.src = e.target.result;
                } else {
                    // Replace the initial circle with an image
                    const newImg = document.createElement('img');
                    newImg.src = e.target.result;
                    newImg.className = 'rounded-circle border border-5 border-white shadow-lg';
                    newImg.width = 120;
                    newImg.height = 120;
                    newImg.style.objectFit = 'cover';
                    newImg.alt = 'Profile';
                    profileImg.parentNode.replaceChild(newImg, profileImg);
                }
            } else {
                const backgroundDiv = document.querySelector('.rounded-4.overflow-hidden');
                backgroundDiv.style.backgroundImage = `url(${e.target.result})`;
                backgroundDiv.style.backgroundSize = 'cover';
                backgroundDiv.style.backgroundPosition = 'center';
                // Hide the default content
                const defaultContent = backgroundDiv.querySelector('.w-100.h-100.d-flex');
                if (defaultContent) {
                    defaultContent.style.display = 'none';
                }
            }
        };
        reader.readAsDataURL(input.files[0]);
        
        // Submit the form
        setTimeout(() => {
            document.getElementById('photo-upload-form').submit();
        }, 500);
    }
}

// Show success message
function showSuccessMessage(message) {
    const alert = document.createElement('div');
    alert.className = 'alert alert-success alert-dismissible fade show position-fixed';
    alert.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
    alert.innerHTML = `
        <i class="fas fa-check-circle me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(alert);
    
    setTimeout(() => {
        alert.remove();
    }, 5000);
}
</script>
@endpush
@endsection
