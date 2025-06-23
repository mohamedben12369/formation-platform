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
                    <h1 class="display-6 fw-bold mb-1">Informations personnelles</h1>
                    <p class="text-muted mb-0">Gérez vos informations de profil et vos préférences</p>
                </div>
            </div>
        </div>
    </div>    <div class="row">
        <!-- Profile Form -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white border-0">
                    <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i>Modifier le profil</h5>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <!-- Basic Information -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="nom" class="form-label fw-semibold">
                                    <i class="fas fa-user text-primary me-2"></i>Nom
                                </label>
                                <input type="text" 
                                       class="form-control @error('nom') is-invalid @enderror" 
                                       id="nom" 
                                       name="nom" 
                                       value="{{ old('nom', $user->nom) }}" 
                                       required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label fw-semibold">
                                    <i class="fas fa-user text-primary me-2"></i>Prénom
                                </label>
                                <input type="text" 
                                       class="form-control @error('prenom') is-invalid @enderror" 
                                       id="prenom" 
                                       name="prenom" 
                                       value="{{ old('prenom', $user->prenom) }}" 
                                       required>
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope text-primary me-2"></i>Email
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact Information -->
                        <div class="row mb-4">                            <div class="col-md-6">
                                <label for="tel" class="form-label fw-semibold">
                                    <i class="fas fa-phone text-primary me-2"></i>Téléphone
                                </label>
                                <input type="tel" 
                                       class="form-control @error('tel') is-invalid @enderror" 
                                       id="tel" 
                                       name="tel" 
                                       value="{{ old('tel', $user->tel) }}">
                                @error('tel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="date_de_naissance" class="form-label fw-semibold">
                                    <i class="fas fa-calendar text-primary me-2"></i>Date de naissance
                                </label>
                                <input type="date" 
                                       class="form-control @error('date_de_naissance') is-invalid @enderror" 
                                       id="date_de_naissance" 
                                       name="date_de_naissance" 
                                       value="{{ old('date_de_naissance', $user->date_de_naissance ? $user->date_de_naissance->format('Y-m-d') : '') }}">
                                @error('date_de_naissance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-4">
                            <label for="adresse" class="form-label fw-semibold">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>Adresse
                            </label>
                            <textarea class="form-control @error('adresse') is-invalid @enderror" 
                                      id="adresse" 
                                      name="adresse" 
                                      rows="3">{{ old('adresse', $user->adresse) }}</textarea>
                            @error('adresse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>                        <!-- Profile Photo -->
                        <div class="mb-4">
                            <label for="profile_image" class="form-label fw-semibold">
                                <i class="fas fa-image text-primary me-2"></i>Photo de profil
                            </label>
                            <div class="profile-photo-wrapper">
                                <div class="d-flex align-items-center">
                                    <div class="profile-photo me-3" style="width: 80px; height: 80px;">
                                        @if($user->profile_image)
                                            <img src="{{ Storage::url($user->profile_image) }}" 
                                                 alt="Photo de profil" 
                                                 class="img-thumbnail rounded-circle w-100 h-100 object-cover">
                                        @else
                                            <div class="bg-light rounded-circle w-100 h-100 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-user text-muted" style="font-size: 2rem;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="mb-2">
                                            <small class="text-muted">Profil actuel :</small>
                                            <div class="fw-semibold">{{ $user->nom }} {{ $user->prenom }}</div>
                                        </div>
                                        <input type="file" 
                                               class="form-control @error('profile_image') is-invalid @enderror"
                                               id="profile_image" 
                                               name="profile_image" 
                                               accept="image/*">
                                        <div class="form-text">
                                            Formats acceptés: JPG, PNG, GIF. Taille max: 2MB
                                        </div>
                                        @error('profile_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>                        <!-- Background Photo -->
                        <div class="mb-4">
                            <label for="background_image" class="form-label fw-semibold">
                                <i class="fas fa-image text-primary me-2"></i>Photo de couverture
                            </label>
                            <div class="profile-background mb-3" style="height: 150px; width: 100%; border-radius: 10px; overflow: hidden;">
                                @if($user->background_image)
                                    <img src="{{ Storage::url($user->background_image) }}" 
                                         alt="Photo de couverture" 
                                         class="w-100 h-100 object-cover">
                                @else
                                    <div class="bg-light w-100 h-100 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <input type="file" 
                                   class="form-control @error('background_image') is-invalid @enderror" 
                                   id="background_image" 
                                   name="background_image" 
                                   accept="image/*">
                            <div class="form-text">
                                Formats acceptés: JPG, PNG, GIF. Taille max: 5MB
                            </div>
                            @error('background_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror                        </div>

                        <!-- Security Information -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="securite_question_id" class="form-label fw-semibold">
                                    <i class="fas fa-shield-alt text-primary me-2"></i>Question de sécurité
                                </label>
                                <select class="form-select @error('securite_question_id') is-invalid @enderror" 
                                        id="securite_question_id" 
                                        name="securite_question_id" 
                                        required>
                                    <option value="">Choisir une question</option>
                                    @foreach($securiteQuestions as $question)
                                        <option value="{{ $question->id }}" 
                                                {{ old('securite_question_id', $user->securite_question_id) == $question->id ? 'selected' : '' }}>
                                            {{ $question->question }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('securite_question_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="reponse" class="form-label fw-semibold">
                                    <i class="fas fa-key text-primary me-2"></i>Réponse
                                </label>
                                <input type="text" 
                                       class="form-control @error('reponse') is-invalid @enderror" 
                                       id="reponse" 
                                       name="reponse" 
                                       value="{{ old('reponse', $user->reponse) }}" 
                                       required>
                                @error('reponse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Sauvegarder les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.profile-photo img,
.profile-background img {
    object-fit: cover;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
}

.btn {
    transition: all 0.3s ease;
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
    // Image preview function
    function previewImage(input, previewElement) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Clear existing content
                previewElement.innerHTML = '';
                // Create new img element
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-100 h-100 object-cover';
                if (previewElement.classList.contains('rounded-circle')) {
                    img.className += ' rounded-circle';
                }
                previewElement.appendChild(img);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }    // Add event listeners for image uploads
    document.getElementById('profile_image').addEventListener('change', function() {
        const preview = this.closest('.profile-photo-wrapper').querySelector('.profile-photo');
        previewImage(this, preview);
    });

    document.getElementById('background_image').addEventListener('change', function() {
        const preview = this.closest('.mb-4').querySelector('.profile-background');
        previewImage(this, preview);
    });
</script>
@endpush
