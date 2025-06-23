@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Gestion des Types de Formation</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Bouton pour ouvrir le modal d'ajout -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addTypeFormationModal">
        <img src="{{ asset('images/add.webp') }}" alt="Ajouter" width="18" height="18" class="me-2">
        Ajouter un Type de Formation
    </button>

    <!-- Modal d'ajout -->
    <div class="modal fade" id="addTypeFormationModal" tabindex="-1" aria-labelledby="addTypeFormationModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-draggable">
            <div class="modal-content">
                <form method="POST" action="{{ route('dashboard.type-formations.store') }}">
                    @csrf
                    <div class="modal-header draggable-header" style="cursor: move;">
                        <h5 class="modal-title" id="addTypeFormationModalLabel">
                            <i class="fas fa-arrows-alt me-2 text-muted"></i>
                            Ajouter un Type de Formation
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">                        <div class="mb-3">
                            <label for="type-formation-code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="type-formation-code" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="type-formation-nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="type-formation-nom" name="nom" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Table des types de formation -->
    <table class="table">        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($typeFormations ?? [] as $typeFormation)            <tr>
                <td>{{ $typeFormation->code }}</td>
                <td>{{ $typeFormation->nom }}</td>
                <td>
                    <!-- Bouton pour ouvrir le modal d'édition -->
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTypeFormationModal{{ $typeFormation->id }}">
                        <img src="{{ asset('images/edit.webp') }}" alt="Modifier" width="18" height="18">
                    </button>
                    <form action="{{ route('dashboard.type-formations.destroy', $typeFormation->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce type de formation ?')">
                            <img src="{{ asset('images/delete.webp') }}" alt="Supprimer" width="18" height="18">
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Modal d'édition -->
            <div class="modal fade" id="editTypeFormationModal{{ $typeFormation->id }}" tabindex="-1" aria-labelledby="editTypeFormationModalLabel{{ $typeFormation->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-draggable">
                    <div class="modal-content">
                        <form action="{{ route('dashboard.type-formations.update', $typeFormation->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header draggable-header" style="cursor: move;">
                                <h5 class="modal-title" id="editTypeFormationModalLabel{{ $typeFormation->id }}">
                                    <i class="fas fa-arrows-alt me-2 text-muted"></i>
                                    Modifier Type de Formation
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">                                <div class="mb-3">
                                    <label for="code{{ $typeFormation->id }}" class="form-label">Code</label>
                                    <input type="text" class="form-control" id="code{{ $typeFormation->id }}" name="code" value="{{ $typeFormation->code }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nom{{ $typeFormation->id }}" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom{{ $typeFormation->id }}" name="nom" value="{{ $typeFormation->nom }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <img src="{{ asset('images/close.webp') }}" alt="Annuler" width="18" height="18">
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <img src="{{ asset('images/confirm.png') }}" alt="Enregistrer" width="18" height="18">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            @empty
            <tr>
                <td colspan="3" class="text-center text-muted">Aucun type de formation trouvé</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fonctionnalité de déplacement du modal
    function makeDraggable(modal) {
        let isDragging = false;
        let hasMoved = false;
        let currentX;
        let currentY;
        let initialX;
        let initialY;
        let xOffset = 0;
        let yOffset = 0;
        let startX, startY;
        
        const modalDialog = modal.querySelector('.modal-dialog');
        const modalContent = modal.querySelector('.modal-content');
        const dragHandle = modal.querySelector('.modal-content'); // Tout le modal devient déplaçable
        
        if (!dragHandle) return;
        
        // Reset position when modal is shown
        modal.addEventListener('shown.bs.modal', function() {
            modalDialog.style.transform = '';
            modalDialog.classList.remove('dragging');
            modalContent.classList.remove('dragging');
            xOffset = 0;
            yOffset = 0;
            isDragging = false;
            hasMoved = false;
        });
        
        dragHandle.addEventListener('mousedown', dragStart);
        document.addEventListener('mousemove', drag);
        document.addEventListener('mouseup', dragEnd);
        
        function dragStart(e) {
            // Éviter le déplacement si on clique sur des éléments interactifs
            if (e.target.classList.contains('btn-close') || 
                e.target.tagName === 'INPUT' || 
                e.target.tagName === 'BUTTON' || 
                e.target.tagName === 'TEXTAREA' ||
                e.target.classList.contains('form-control') ||
                e.target.closest('button') ||
                e.target.closest('.btn')) {
                return;
            }
            
            e.preventDefault();
            
            // Enregistrer la position de départ pour détecter le mouvement
            startX = e.clientX;
            startY = e.clientY;
            hasMoved = false;
            
            // Obtenir la position actuelle du modal
            const rect = modalDialog.getBoundingClientRect();
            
            // Calculer l'offset par rapport à la position actuelle du modal
            initialX = e.clientX - rect.left;
            initialY = e.clientY - rect.top;
            
            isDragging = true;
        }
        
        function drag(e) {
            if (isDragging) {
                e.preventDefault();
                
                // Vérifier si la souris a bougé suffisamment pour considérer cela comme un drag
                const deltaX = Math.abs(e.clientX - startX);
                const deltaY = Math.abs(e.clientY - startY);
                
                if (!hasMoved && (deltaX > 5 || deltaY > 5)) {
                    hasMoved = true;
                    
                    // Utiliser transform au lieu de position fixed pour préserver la taille
                    modalDialog.classList.add('dragging');
                    modalContent.classList.add('dragging');
                    
                    // Réinitialiser les offsets
                    xOffset = 0;
                    yOffset = 0;
                }
                
                if (hasMoved) {
                    // Utiliser transform pour déplacer sans affecter la taille
                    const deltaX = e.clientX - startX;
                    const deltaY = e.clientY - startY;
                    
                    xOffset = deltaX;
                    yOffset = deltaY;
                    
                    modalDialog.style.transform = `translate(${xOffset}px, ${yOffset}px)`;
                }
            }
        }
        
        function dragEnd(e) {
            if (isDragging) {
                isDragging = false;
                hasMoved = false;
                modalDialog.classList.remove('dragging');
                modalContent.classList.remove('dragging');
            }
        }
        
        // Support pour les appareils tactiles
        dragHandle.addEventListener('touchstart', touchStart, { passive: false });
        document.addEventListener('touchmove', touchMove, { passive: false });
        document.addEventListener('touchend', touchEnd);
        
        function touchStart(e) {
            // Éviter le déplacement si on clique sur des éléments interactifs
            if (e.target.classList.contains('btn-close') || 
                e.target.tagName === 'INPUT' || 
                e.target.tagName === 'BUTTON' || 
                e.target.tagName === 'TEXTAREA' ||
                e.target.classList.contains('form-control') ||
                e.target.closest('button') ||
                e.target.closest('.btn')) {
                return;
            }
            
            const touch = e.touches[0];
            
            // Enregistrer la position de départ pour détecter le mouvement
            startX = touch.clientX;
            startY = touch.clientY;
            hasMoved = false;
            
            isDragging = true;
        }
        
        function touchMove(e) {
            if (isDragging) {
                e.preventDefault();
                
                const touch = e.touches[0];
                
                // Vérifier si le doigt a bougé suffisamment pour considérer cela comme un drag
                const deltaX = Math.abs(touch.clientX - startX);
                const deltaY = Math.abs(touch.clientY - startY);
                
                if (!hasMoved && (deltaX > 5 || deltaY > 5)) {
                    hasMoved = true;
                    modalDialog.classList.add('dragging');
                    modalContent.classList.add('dragging');
                    xOffset = 0;
                    yOffset = 0;
                }
                
                if (hasMoved) {
                    // Utiliser transform pour déplacer sans affecter la taille
                    const finalDeltaX = touch.clientX - startX;
                    const finalDeltaY = touch.clientY - startY;
                    
                    xOffset = finalDeltaX;
                    yOffset = finalDeltaY;
                    
                    modalDialog.style.transform = `translate(${xOffset}px, ${yOffset}px)`;
                }
            }
        }
        
        function touchEnd(e) {
            if (isDragging) {
                isDragging = false;
                modalDialog.classList.remove('dragging');
                modalContent.classList.remove('dragging');
            }
        }
    }
    
    // Appliquer la fonctionnalité de déplacement aux modaux
    const addModal = document.getElementById('addTypeFormationModal');
    if (addModal) {
        makeDraggable(addModal);
    }
    
    // Aussi pour les modaux d'édition (ils seront créés dynamiquement)
    document.addEventListener('shown.bs.modal', function(e) {
        if (e.target.id.startsWith('editTypeFormationModal')) {
            makeDraggable(e.target);
        }
    });
});
</script>
@endpush

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-sm {
        margin-right: 5px;
    }
    
    /* Styles pour le modal déplaçable */
    .modal-draggable {
        position: relative;
    }
    
    .modal-content {
        cursor: move;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        resize: none !important; /* Empêcher le redimensionnement */
    }
    
    /* Empêcher le redimensionnement du modal */
    .modal-dialog {
        resize: none !important;
        overflow: visible !important;
    }
    
    /* Curseur normal pour les éléments interactifs */
    .modal-content input,
    .modal-content textarea,
    .modal-content button,
    .modal-content .btn,
    .modal-content .form-control {
        cursor: auto;
    }
    
    .draggable-header {
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    
    .draggable-header:hover {
        background-color: #f8f9fa;
    }
    
    .modal-dialog.dragging {
        z-index: 1060 !important;
        transition: none !important;
    }
    
    .modal-content.dragging {
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        cursor: grabbing !important;
        transition: box-shadow 0.2s ease;
    }
    
    .draggable-header .fas.fa-arrows-alt {
        opacity: 0.6;
    }
    
    .draggable-header:hover .fas.fa-arrows-alt {
        opacity: 1;
    }
    
    /* Indication visuelle que le modal est déplaçable */
    .modal-content:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        transition: box-shadow 0.3s ease;
    }
</style>
@endpush
