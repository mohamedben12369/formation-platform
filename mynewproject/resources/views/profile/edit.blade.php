@extends('layouts.profhead')

@section('content')
<div class="container py-4 fade-in">
    <!-- Enhanced Profile Header -->
    <div class="position-relative mb-5">
        <!-- Background Image -->
        <div class="rounded-4 overflow-hidden bg-light" style="height: 280px;">
            <img src="{{ $user->background_image ? Storage::url($user->background_image) : asset('images/default-bg.jpg') }}" 
                 class="w-100 h-100 object-fit-cover" 
                 style="object-fit: cover; min-height: 280px; filter: brightness(0.7);" 
                 alt="Background">              <!-- Background Upload Button -->            <div class="position-absolute top-0 end-0 m-3">
                <!-- Modal button -->
                <button type="button" class="btn btn-light btn-sm rounded-pill shadow" onclick="openBackgroundUpload()" title="Changer le fond">
                    <i class="fas fa-camera"></i> Changer le fond
                </button>
                
                <!-- Direct upload button (alternative) -->
                <button type="button" class="btn btn-outline-light btn-sm rounded-pill shadow ms-2" onclick="document.getElementById('direct-background-upload').click()" title="Upload direct">
                    <i class="fas fa-upload"></i> Direct
                </button>
                
                <!-- Alternative: Direct file input -->
                <input type="file" 
                       id="direct-background-upload" 
                       style="display: none;" 
                       accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" 
                       onchange="handleDirectBackgroundUpload(this)">
                <!-- Test button -->
                <button type="button" class="btn btn-info btn-sm rounded-pill shadow ms-2" onclick="document.getElementById('test-bg-input').click()" title="Test sélection fichier">
                    <i class="fas fa-vial"></i> Test
                </button>
                <input type="file" id="test-bg-input" style="display: none;" accept="image/*" onchange="console.log('Test background input works:', this.files[0])">
            </div>
        </div>
        
        <!-- Profile Photo -->
        <div class="position-absolute top-100 start-50 translate-middle" style="z-index: 2; margin-top: -80px;">
            <div class="position-relative">                <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : asset('images/default-avatar.png') }}" 
                     class="rounded-circle border border-4 border-white shadow-lg" 
                     width="140" height="140" 
                     style="object-fit: cover;" 
                     alt="Avatar">                
                <!-- Modal button -->
                <button type="button" class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0" 
                        onclick="openProfileUpload()" 
                        title="Changer la photo de profil">
                    <i class="fas fa-camera"></i>
                </button>
                
                <!-- Direct upload button (alternative) -->
                <button type="button" class="btn btn-outline-primary btn-sm rounded-circle position-absolute top-0 end-0" 
                        onclick="document.getElementById('direct-profile-upload').click()"
                        style="width: 35px; height: 35px;"
                        title="Upload direct">
                    <i class="fas fa-upload" style="font-size: 0.8rem;"></i>
                </button>
                
                <!-- Alternative: Direct file input -->
                <input type="file" 
                       id="direct-profile-upload" 
                       style="display: none;" 
                       accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" 
                       onchange="handleDirectProfileUpload(this)">
                <!-- Test button -->
                <button type="button" class="btn btn-success btn-sm rounded-circle position-absolute bottom-0 start-0" 
                        onclick="document.getElementById('test-profile-input').click()"
                        style="width: 35px; height: 35px;"
                        title="Test sélection fichier">
                    <i class="fas fa-vial" style="font-size: 0.8rem;"></i>
                </button>
                <input type="file" id="test-profile-input" style="display: none;" accept="image/*" onchange="console.log('Test profile input works:', this.files[0])">
            </div>
        </div>
    </div>
    
    <!-- User Info -->
    <div class="text-center mb-5" style="margin-top: 80px;">
        <h2 class="display-6 fw-bold mb-1">{{ $user->name ?? $user->nom }} {{ $user->prenom ?? '' }}</h2>
        <p class="text-muted mb-2">
            <i class="fas fa-envelope me-1"></i> {{ $user->email }}
        </p>
        <span class="badge bg-gradient bg-primary fs-6 px-3 py-2">
            <i class="fas fa-star me-1"></i>{{ $user->role->name ?? 'Utilisateur' }}
        </span>
    </div>

    <!-- Profile Management Cards -->
    <div class="row g-4 mb-5">
        <!-- Compétences -->
        <div class="col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-header bg-gradient bg-primary text-white border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-brain fa-lg me-3"></i>
                            <h5 class="mb-0 fw-bold">Compétences</h5>
                        </div>
                        <span class="badge bg-white text-primary">{{ $user->competences->count() }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if($user->competences->count())
                        <div class="mb-3">
                            @foreach($user->competences->take(3) as $competence)
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">{{ $competence->nom }}</div>
                                        <div class="text-muted small">{{ $competence->sousDomaine->nom ?? 'Non catégorisé' }}</div>
                                    </div>
                                    <span class="badge bg-primary-subtle text-primary">{{ $competence->niveau->nom ?? 'N/A' }}</span>
                                </div>
                            @endforeach
                        </div>
                        @if($user->competences->count() > 3)
                            <div class="text-center mb-3">
                                <span class="badge bg-secondary">+{{ $user->competences->count() - 3 }} autres</span>
                            </div>
                        @endif
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-lightbulb fa-3x mb-3 opacity-50"></i>
                            <div>Aucune compétence ajoutée.</div>
                            <small class="text-muted">Ajoutez vos compétences professionnelles</small>
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('profile.competences.index') }}" class="btn btn-outline-primary w-100" data-bs-toggle="tooltip" title="Gérer vos compétences">
                        <i class="fas fa-edit me-2"></i>Gérer les compétences
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Expériences -->
        <div class="col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-header bg-gradient bg-success text-white border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-briefcase fa-lg me-3"></i>
                            <h5 class="mb-0 fw-bold">Expériences</h5>
                        </div>
                        <span class="badge bg-white text-success">{{ $user->experiences->count() }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if($user->experiences->count())
                        <div class="mb-3">
                            @foreach($user->experiences->take(3) as $experience)
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">{{ $experience->titre }}</div>
                                        <div class="text-muted small">
                                            <i class="fas fa-building me-1"></i>{{ $experience->entreprise }}
                                        </div>
                                    </div>
                                    <span class="badge bg-success-subtle text-success">
                                        {{ $experience->date_debut->format('Y') }} - {{ $experience->date_fin ? $experience->date_fin->format('Y') : 'Présent' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        @if($user->experiences->count() > 3)
                            <div class="text-center mb-3">
                                <span class="badge bg-secondary">+{{ $user->experiences->count() - 3 }} autres</span>
                            </div>
                        @endif
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-briefcase fa-3x mb-3 opacity-50"></i>
                            <div>Aucune expérience ajoutée.</div>
                            <small class="text-muted">Partagez votre parcours professionnel</small>
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('profile.experiences.index') }}" class="btn btn-outline-success w-100" data-bs-toggle="tooltip" title="Gérer vos expériences">
                        <i class="fas fa-edit me-2"></i>Gérer les expériences
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Diplômes -->
        <div class="col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-header bg-gradient bg-info text-white border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-graduation-cap fa-lg me-3"></i>
                            <h5 class="mb-0 fw-bold">Diplômes</h5>
                        </div>
                        <span class="badge bg-white text-info">{{ $user->diplomes->count() }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if($user->diplomes->count())
                        <div class="mb-3">
                            @foreach($user->diplomes->take(3) as $diplome)
                                <div class="d-flex align-items-center mb-2">
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">{{ $diplome->nom }}</div>
                                        <div class="text-muted small">
                                            <i class="fas fa-university me-1"></i>{{ $diplome->etablissement->nom ?? 'N/A' }}
                                        </div>
                                    </div>
                                    <span class="badge bg-info-subtle text-info">{{ $diplome->date_obtention->format('Y') }}</span>
                                </div>
                            @endforeach
                        </div>
                        @if($user->diplomes->count() > 3)
                            <div class="text-center mb-3">
                                <span class="badge bg-secondary">+{{ $user->diplomes->count() - 3 }} autres</span>
                            </div>
                        @endif
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-graduation-cap fa-3x mb-3 opacity-50"></i>
                            <div>Aucun diplôme ajouté.</div>
                            <small class="text-muted">Ajoutez vos qualifications</small>
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('profile.diplomes.index') }}" class="btn btn-outline-info w-100" data-bs-toggle="tooltip" title="Gérer vos diplômes">
                        <i class="fas fa-edit me-2"></i>Gérer les diplômes
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Settings -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-gradient bg-dark text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-cogs fa-lg me-3"></i>
                        <h5 class="mb-0 fw-bold">Paramètres du compte</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('profile.information') }}" class="btn btn-outline-primary w-100 py-3 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-user-edit fa-2x mb-2"></i>
                                <span class="fw-semibold">Informations personnelles</span>
                                <small class="text-muted mt-1">Modifier vos données</small>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('profile.password') }}" class="btn btn-outline-warning w-100 py-3 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-key fa-2x mb-2"></i>
                                <span class="fw-semibold">Mot de passe</span>
                                <small class="text-muted mt-1">Sécurité du compte</small>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('profile.show', $user->id) }}" class="btn btn-outline-success w-100 py-3 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-eye fa-2x mb-2"></i>
                                <span class="fw-semibold">Voir le profil</span>
                                <small class="text-muted mt-1">Aperçu public</small>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('profile.delete') }}" class="btn btn-outline-danger w-100 py-3 h-100 d-flex flex-column align-items-center justify-content-center">
                                <i class="fas fa-trash-alt fa-2x mb-2"></i>
                                <span class="fw-semibold">Supprimer</span>
                                <small class="text-muted mt-1">Fermer le compte</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Photo Upload Modal -->
<div class="modal fade" id="profileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title"><i class="fas fa-camera me-2"></i>Photo de profil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>            <div class="modal-body">
                <form id="profilePhotoForm" enctype="multipart/form-data">
                    @csrf
                    <div class="text-center mb-3">
                        <img id="profilePreview" 
                             src="{{ $user->profile_image ? Storage::url($user->profile_image) : asset('images/default-avatar.png') }}" 
                             class="rounded-circle mb-3" 
                             width="100" 
                             height="100" 
                             style="object-fit: cover;" 
                             alt="Preview">
                    </div>
                    <div class="mb-3">
                        <label for="profile_image_input" class="form-label">Choisir une photo</label>
                        <input type="file" 
                               class="form-control" 
                               id="profile_image_input" 
                               name="profile_image" 
                               accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" 
                               onchange="previewProfileImage(this)">
                        <div class="form-text">Formats acceptés: JPG, PNG, GIF, WebP (max 2MB)</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="uploadProfilePhoto()">
                    <i class="fas fa-upload me-1"></i>Télécharger
                </button>
                @if($user->profile_image)
                    <button type="button" class="btn btn-outline-danger" onclick="deleteProfilePhoto()">
                        <i class="fas fa-trash me-1"></i>Supprimer
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Background Photo Upload Modal -->
<div class="modal fade" id="backgroundModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-info text-white border-0">
                <h5 class="modal-title"><i class="fas fa-image me-2"></i>Photo de fond</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>            <div class="modal-body">
                <form id="backgroundPhotoForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="text-center mb-3">
                            <img id="backgroundPreview" 
                                 src="{{ $user->background_image ? Storage::url($user->background_image) : asset('images/default-bg.jpg') }}" 
                                 class="img-fluid rounded" 
                                 style="max-height: 200px; width: 100%; object-fit: cover;" 
                                 alt="Background Preview">
                        </div>
                        <label for="background_image_input" class="form-label">Choisir une photo de fond</label>
                        <input type="file" 
                               class="form-control" 
                               id="background_image_input" 
                               name="background_image" 
                               accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" 
                               onchange="previewBackgroundImage(this)">
                        <div class="form-text">Formats acceptés: JPG, PNG, GIF, WebP (max 4MB)</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-info" onclick="uploadBackgroundPhoto()">
                    <i class="fas fa-upload me-1"></i>Télécharger
                </button>
                @if($user->background_image)
                    <button type="button" class="btn btn-outline-danger" onclick="deleteBackgroundPhoto()">
                        <i class="fas fa-trash me-1"></i>Supprimer
                    </button>
                @endif
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

.object-fit-cover {
    object-fit: cover;
}

.btn:hover {
    transform: translateY(-1px);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize modals
    window.profileModal = new bootstrap.Modal(document.getElementById('profileModal'));
    window.backgroundModal = new bootstrap.Modal(document.getElementById('backgroundModal'));
    
    // Test modal functionality
    console.log('Profile edit page loaded');
    console.log('Modals initialized:', window.profileModal, window.backgroundModal);
});

// Modal management functions
function openProfileUpload() {
    console.log('Opening profile upload modal');
    try {
        window.profileModal.show();
    } catch (error) {
        console.error('Error opening profile modal:', error);
        // Fallback: try direct Bootstrap modal
        $('#profileModal').modal('show');
    }
}

function openBackgroundUpload() {
    console.log('Opening background upload modal');
    try {
        window.backgroundModal.show();
    } catch (error) {
        console.error('Error opening background modal:', error);
        // Fallback: try direct Bootstrap modal
        $('#backgroundModal').modal('show');
    }
}

// Direct upload handlers (alternative to modals)
function handleDirectProfileUpload(input) {
    console.log('Direct profile upload triggered');
    if (input.files && input.files[0]) {
        const formData = new FormData();
        formData.append('profile_image', input.files[0]);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        fetch('{{ route("profile.update.photo") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Erreur lors de la mise à jour de la photo');
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            alert('Erreur lors de la mise à jour de la photo');
        });
    }
}

function handleDirectBackgroundUpload(input) {
    console.log('Direct background upload triggered');
    if (input.files && input.files[0]) {
        const formData = new FormData();
        formData.append('background_image', input.files[0]);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        fetch('{{ route("profile.update.background") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Erreur lors de la mise à jour du fond');
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            alert('Erreur lors de la mise à jour du fond');
        });
    }
}

// Preview functions
function previewProfileImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
        console.log('Profile image selected:', input.files[0].name);
    }
}

function previewBackgroundImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('backgroundPreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
        console.log('Background image selected:', input.files[0].name);
    }
}

// Profile photo functions
function uploadProfilePhoto() {
    const form = document.getElementById('profilePhotoForm');
    const fileInput = document.getElementById('profile_image_input');
    
    if (!fileInput.files || !fileInput.files[0]) {
        alert('Veuillez sélectionner une image');
        return;
    }
    
    const formData = new FormData();
    formData.append('profile_image', fileInput.files[0]);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    // Show loading state
    const uploadBtn = event.target;
    const originalText = uploadBtn.innerHTML;
    uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Téléchargement...';
    uploadBtn.disabled = true;
    
    fetch('{{ route("profile.update.photo") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Upload response:', data);
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Erreur lors de la mise à jour de la photo');
        }
    })
    .catch(error => {
        console.error('Upload error:', error);
        alert('Erreur lors de la mise à jour de la photo: ' + error.message);
    })
    .finally(() => {
        // Restore button state
        uploadBtn.innerHTML = originalText;
        uploadBtn.disabled = false;
    });
}

function deleteProfilePhoto() {
    if (confirm('Êtes-vous sûr de vouloir supprimer votre photo de profil ?')) {
        fetch('{{ route("profile.delete.photo") }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Erreur lors de la suppression de la photo');
            }
        })
        .catch(error => {
            console.error('Delete error:', error);
            alert('Erreur lors de la suppression de la photo');
        });
    }
}

// Background photo functions
function uploadBackgroundPhoto() {
    const form = document.getElementById('backgroundPhotoForm');
    const fileInput = document.getElementById('background_image_input');
    
    if (!fileInput.files || !fileInput.files[0]) {
        alert('Veuillez sélectionner une image');
        return;
    }
    
    const formData = new FormData();
    formData.append('background_image', fileInput.files[0]);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    // Show loading state
    const uploadBtn = event.target;
    const originalText = uploadBtn.innerHTML;
    uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Téléchargement...';
    uploadBtn.disabled = true;
    
    fetch('{{ route("profile.update.background") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Upload response:', data);
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Erreur lors de la mise à jour du fond');
        }
    })
    .catch(error => {
        console.error('Upload error:', error);
        alert('Erreur lors de la mise à jour du fond: ' + error.message);
    })
    .finally(() => {
        // Restore button state
        uploadBtn.innerHTML = originalText;
        uploadBtn.disabled = false;
    });
}

function deleteBackgroundPhoto() {
    if (confirm('Êtes-vous sûr de vouloir supprimer votre photo de fond ?')) {
        fetch('{{ route("profile.delete.background") }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Erreur lors de la suppression du fond');
            }
        })
        .catch(error => {
            console.error('Delete error:', error);
            alert('Erreur lors de la suppression du fond');
        });
    }
}

// Debug function to test file input
function testFileInput() {
    const profileInput = document.getElementById('profile_image_input');
    const backgroundInput = document.getElementById('background_image_input');
    
    console.log('Profile input element:', profileInput);
    console.log('Background input element:', backgroundInput);
    
    if (profileInput) {
        profileInput.click();
    }
}
</script>
@endpush
@endsection