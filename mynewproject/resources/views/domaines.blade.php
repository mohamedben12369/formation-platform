@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Gestion des Domaines</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Bouton pour ouvrir le modal d'ajout -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addDomaineModal">
        <img src="{{ asset('images/add.webp') }}" alt="Ajouter" width="18" height="18" class="me-2">
        
    </button>
    <!-- Modal d'ajout -->
    <div class="modal fade" id="addDomaineModal" tabindex="-1" aria-labelledby="addDomaineModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-draggable">
            <div class="modal-content">
                <form method="POST" action="{{ route('dashboard.domaines.store') }}">
                    @csrf
                    <div class="modal-header draggable-header" style="cursor: move;">
                        <h5 class="modal-title" id="addDomaineModalLabel">
                            <i class="fas fa-arrows-alt me-2 text-muted"></i>
                            Ajouter un Domaine
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="domaine-nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="domaine-nom" name="nom" required>
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
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($domaines ?? [] as $domaine)
            <tr>
                <td>{{ $domaine->nom }}</td>
                <td>
                    <!-- Bouton pour ouvrir le modal d'édition -->
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editDomaineModal{{ $domaine->id }}">
                        <img src="{{ asset('images/edit.webp') }}" alt="Modifier" width="18" height="18">
                    </button>
                    <form action="{{ route('dashboard.domaines.destroy', $domaine->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce domaine ?')">
                            <img src="{{ asset('images/delete.webp') }}" alt="Supprimer" width="18" height="18">
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Modal d'édition -->
            <div class="modal fade" id="editDomaineModal{{ $domaine->id }}" tabindex="-1" aria-labelledby="editDomaineModalLabel{{ $domaine->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-draggable">
                    <div class="modal-content">
                        <form action="{{ route('dashboard.domaines.update', $domaine->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header draggable-header" style="cursor: move;">
                                <h5 class="modal-title" id="editDomaineModalLabel{{ $domaine->id }}">
                                    <i class="fas fa-arrows-alt me-2 text-muted"></i>
                                    Modifier Domaine
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nom{{ $domaine->id }}" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom{{ $domaine->id }}" name="nom" value="{{ $domaine->nom }}" required>
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
            </div>
            @empty
            <tr>
                <td colspan="2" class="text-center text-muted">Aucun domaine trouvé</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    @if(isset($domaines) && method_exists($domaines, 'links'))
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Navigation des domaines">
            <ul class="pagination">
                {{-- Première page --}}
                @if ($domaines->currentPage() > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $domaines->url(1) }}" aria-label="Première page">
                            <span aria-hidden="true">&laquo;&laquo;</span>
                        </a>
                    </li>
                @endif

                {{-- Page précédente --}}
                @if ($domaines->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" aria-label="Précédent">
                            <span aria-hidden="true">&laquo;</span>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $domaines->previousPageUrl() }}" aria-label="Précédent">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif

                {{-- Numéros de pages --}}
                @foreach ($domaines->getUrlRange(max(1, $domaines->currentPage() - 2), min($domaines->lastPage(), $domaines->currentPage() + 2)) as $page => $url)
                    @if ($page == $domaines->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Page suivante --}}
                @if ($domaines->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $domaines->nextPageUrl() }}" aria-label="Suivant">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" aria-label="Suivant">
                            <span aria-hidden="true">&raquo;</span>
                        </span>
                    </li>
                @endif

                {{-- Dernière page --}}
                @if ($domaines->currentPage() < $domaines->lastPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ $domaines->url($domaines->lastPage()) }}" aria-label="Dernière page">
                            <span aria-hidden="true">&raquo;&raquo;</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    {{-- Informations sur la pagination --}}
    <div class="text-center mt-3">
        <small class="text-muted">
            Affichage de {{ $domaines->firstItem() ?? 0 }} à {{ $domaines->lastItem() ?? 0 }} 
            sur {{ $domaines->total() ?? 0 }} domaines
        </small>
    </div>
    @endif
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
    const addModal = document.getElementById('addDomaineModal');
    if (addModal) {
        makeDraggable(addModal);
    }
    
    // Aussi pour les modaux d'édition (ils seront créés dynamiquement)
    document.addEventListener('shown.bs.modal', function(e) {
        if (e.target.id.startsWith('editDomaineModal')) {
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
    
    /* Styles pour la pagination */
    .pagination {
        margin-bottom: 0;
    }
    
    .pagination .page-link {
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
        padding: 0.375rem 0.75rem;
        margin-left: -1px;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }
    
    .pagination .page-link:hover {
        z-index: 2;
        color: #0056b3;
        background-color: #e9ecef;
        border-color: #dee2e6;
        transform: translateY(-1px);
    }
    
    .pagination .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        font-weight: bold;
    }
    
    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
        cursor: not-allowed;
    }
    
    .pagination .page-item:first-child .page-link {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }
    
    .pagination .page-item:last-child .page-link {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
    }
    
    /* Animation pour les boutons de pagination */
    .pagination .page-link:focus {
        z-index: 3;
        color: #0056b3;
        background-color: #e9ecef;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    /* Responsive pour les petits écrans */
    @media (max-width: 576px) {
        .pagination {
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .pagination .page-link {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
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
