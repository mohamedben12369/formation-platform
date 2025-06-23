@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Section Types d'Expériences -->
    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Gestion des Types d'Expériences</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Bouton pour ouvrir le modal d'ajout -->
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTypeExperienceModal">Ajouter une expérience</button>
            
            <!-- Tableau des types d'expériences -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($types as $type)
                        <tr>
                            <td>{{ $type->nom }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTypeExperienceModal{{ $type->id }}">
                                    Modifier
                                </button>
                                <form action="{{ route('dashboard.type-experiences.destroy', $type->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type d\'expérience ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal d'ajout de type d'expérience -->
    <div class="modal fade modal-draggable" id="addTypeExperienceModal" tabindex="-1" aria-labelledby="addtypeexperience" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.type-experiences.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-gradient-info text-white draggable-header" style="cursor: move;">
                        <h5 class="modal-title" id="addtypeexperience">
                            <i class="fas fa-arrows-alt me-2 text-muted"></i>
                            Ajouter un Type d'Expérience
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-info text-white">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modals d'édition -->
    @foreach($types as $type)
    <div class="modal fade modal-draggable" id="editTypeExperienceModal{{ $type->id }}" tabindex="-1" aria-labelledby="editTypeExperienceModalLabel{{ $type->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('dashboard.type-experiences.update', $type->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-gradient-info text-white draggable-header" style="cursor: move;">
                        <h5 class="modal-title" id="editTypeExperienceModalLabel{{ $type->id }}">
                            <i class="fas fa-arrows-alt me-2 text-muted"></i>
                            Modifier le Type d'Expérience
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_nom{{ $type->id }}" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="edit_nom{{ $type->id }}" name="nom" value="{{ old('nom', $type->nom) }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-info text-white">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-sm {
        margin-right: 5px;
    }
    
    /* Styles pour le modal déplaçable */
    .modal-draggable .modal-dialog {
        pointer-events: none;
    }

    .modal-draggable .modal-content {
        pointer-events: auto;
    }

    .draggable-header {
        cursor: move !important;
    }

    .modal-draggable.dragging .modal-dialog {
        transition: none !important;
    }

    /* Désactiver les animations des modals pour éviter les clignotements */
    .modal.fade .modal-dialog {
        transition: none !important;
    }

    .modal {
        transition: none !important;
    }
</style>
@endpush

@push('scripts')
<script>
// Fonction pour rendre les modals déplaçables
function makeDraggable(modal) {
    const modalDialog = modal.querySelector('.modal-dialog');
    const draggableHeader = modal.querySelector('.draggable-header');
    
    if (!modalDialog || !draggableHeader) return;
    
    let isDragging = false;
    let currentX;
    let currentY;
    let initialX;
    let initialY;
    let xOffset = 0;
    let yOffset = 0;

    function dragStart(e) {
        if (e.type === "touchstart") {
            initialX = e.touches[0].clientX - xOffset;
            initialY = e.touches[0].clientY - yOffset;
        } else {
            initialX = e.clientX - xOffset;
            initialY = e.clientY - yOffset;
        }

        if (e.target === draggableHeader || draggableHeader.contains(e.target)) {
            isDragging = true;
            modal.classList.add('dragging');
        }
    }

    function dragEnd(e) {
        initialX = currentX;
        initialY = currentY;
        isDragging = false;
        modal.classList.remove('dragging');
    }

    function drag(e) {
        if (isDragging) {
            e.preventDefault();
            
            if (e.type === "touchmove") {
                currentX = e.touches[0].clientX - initialX;
                currentY = e.touches[0].clientY - initialY;
            } else {
                currentX = e.clientX - initialX;
                currentY = e.clientY - initialY;
            }

            xOffset = currentX;
            yOffset = currentY;

            modalDialog.style.transform = `translate(${currentX}px, ${currentY}px)`;
        }
    }

    // Réinitialiser la position quand le modal se ferme
    modal.addEventListener('hidden.bs.modal', function() {
        modalDialog.style.transform = '';
        xOffset = 0;
        yOffset = 0;
        currentX = 0;
        currentY = 0;
    });

    // Event listeners
    draggableHeader.addEventListener('mousedown', dragStart, false);
    document.addEventListener('mouseup', dragEnd, false);
    document.addEventListener('mousemove', drag, false);

    // Touch events pour mobile
    draggableHeader.addEventListener('touchstart', dragStart, false);
    document.addEventListener('touchend', dragEnd, false);
    document.addEventListener('touchmove', drag, false);
}

// Initialiser le drag pour tous les modals déplaçables quand le DOM est chargé
document.addEventListener('DOMContentLoaded', function() {
    const draggableModals = document.querySelectorAll('.modal-draggable');
    draggableModals.forEach(modal => {
        makeDraggable(modal);
    });
});
</script>
@endpush
@endsection
