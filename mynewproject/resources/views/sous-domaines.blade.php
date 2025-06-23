@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Gestion des Sous-Domaines</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSousDomaineModal">
                        <img src="{{ asset('images/add.webp') }}" alt="Ajouter" width="18" height="18">
                    </button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Domaine</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>                            <tbody>
                                @forelse($sousDomaines as $sousDomaine)
                                <tr>
                                    <td>{{ $sousDomaine->code }}</td>
                                    <td>{{ $sousDomaine->description }}</td>
                                    <td>{{ $sousDomaine->domaine->nom }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSousDomaineModal{{ $sousDomaine->id }}">
                                            <img src="{{ asset('images/edit.webp') }}" alt="Modifier" width="18" height="18">
                                        </button>
                                        <form action="{{ route('dashboard.sous-domaines.destroy', $sousDomaine->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce sous-domaine ?')">
                                                <img src="{{ asset('images/delete.webp') }}" alt="Supprimer" width="18" height="18">
                                            </button>
                                        </form>
                                    </td>
                                </tr>                                <!-- Modal pour modifier -->
                                <div class="modal fade" id="editSousDomaineModal{{ $sousDomaine->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Modifier le Sous-Domaine
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('dashboard.sous-domaines.update', $sousDomaine->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="edit_code_{{ $sousDomaine->id }}" class="form-label">Code</label>
                                                        <input type="text" class="form-control" id="edit_code_{{ $sousDomaine->id }}" name="code" value="{{ $sousDomaine->code }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_description_{{ $sousDomaine->id }}" class="form-label">Description</label>
                                                        <input type="text" class="form-control" id="edit_description_{{ $sousDomaine->id }}" name="description" value="{{ $sousDomaine->description }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_domaine_code_{{ $sousDomaine->id }}" class="form-label">Domaine</label>
                                                        <select class="form-control" id="edit_domaine_code_{{ $sousDomaine->id }}" name="domaine_code" required>
                                                            @foreach($domaines as $domaine)
                                                                <option value="{{ $domaine->id }}" {{ $sousDomaine->domaine_code == $domaine->id ? 'selected' : '' }}>
                                                                    {{ $domaine->nom }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucun sous-domaine trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>                        </table>
                    </div>

                    <!-- Pagination -->
                    @if(isset($sousDomaines) && method_exists($sousDomaines, 'links'))
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Navigation des sous-domaines">
                            <ul class="pagination">
                                {{-- Première page --}}
                                @if ($sousDomaines->currentPage() > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $sousDomaines->url(1) }}" aria-label="Première page">
                                            <span aria-hidden="true">&laquo;&laquo;</span>
                                        </a>
                                    </li>
                                @endif

                                {{-- Page précédente --}}
                                @if ($sousDomaines->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link" aria-label="Précédent">
                                            <span aria-hidden="true">&laquo;</span>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $sousDomaines->previousPageUrl() }}" aria-label="Précédent">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                @endif

                                {{-- Numéros de pages --}}
                                @foreach ($sousDomaines->getUrlRange(max(1, $sousDomaines->currentPage() - 2), min($sousDomaines->lastPage(), $sousDomaines->currentPage() + 2)) as $page => $url)
                                    @if ($page == $sousDomaines->currentPage())
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
                                @if ($sousDomaines->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $sousDomaines->nextPageUrl() }}" aria-label="Suivant">
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
                                @if ($sousDomaines->currentPage() < $sousDomaines->lastPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $sousDomaines->url($sousDomaines->lastPage()) }}" aria-label="Dernière page">
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
                            Affichage de {{ $sousDomaines->firstItem() ?? 0 }} à {{ $sousDomaines->lastItem() ?? 0 }} 
                            sur {{ $sousDomaines->total() ?? 0 }} sous-domaines
                        </small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour ajouter un sous-domaine -->
<div class="modal fade" id="addSousDomaineModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Ajouter un Sous-Domaine
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addSousDomaineForm" action="{{ route('dashboard.sous-domaines.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>                    <div class="mb-3">
                        <label for="domaine_code" class="form-label">Domaine</label>
                        <select class="form-control" id="domaine_code" name="domaine_code" required>
                            @foreach($domaines as $domaine)
                                <option value="{{ $domaine->id }}">{{ $domaine->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

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
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        resize: none !important;
    }
    
    .modal-dialog {
        resize: none !important;
        overflow: visible !important;
    }
    
    /* Curseur normal pour les éléments interactifs */
    .modal-content input,
    .modal-content textarea,
    .modal-content button,
    .modal-content .btn,
    .modal-content .form-control,
    .modal-content select,
    .modal-content .modal-body,
    .modal-content .modal-footer {
        cursor: auto !important;
        user-select: auto !important;
        -webkit-user-select: auto !important;
        -moz-user-select: auto !important;
        -ms-user-select: auto !important;
    }
    
    .draggable-header {
        cursor: move !important;
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
        transition: box-shadow 0.2s ease;
    }
    
    .draggable-header .fas.fa-arrows-alt {
        opacity: 0.6;
    }
    
    .draggable-header:hover .fas.fa-arrows-alt {
        opacity: 1;
    }
    
    /* Indication visuelle que le modal est déplaçable */
    .modal-header:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: box-shadow 0.3s ease;
    }
</style>
@endpush

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
        const modalContent = modal.querySelector('.modal-content');        const dragHandle = modal.querySelector('.modal-header'); // Seulement l'en-tête est draggable
        
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
        
        // Empêcher le drag d'interférer avec l'ouverture du modal
        modal.addEventListener('show.bs.modal', function() {
            isDragging = false;
            hasMoved = false;
        });
          dragHandle.addEventListener('mousedown', dragStart);
        
        function dragStart(e) {
            // Éviter le déplacement si on clique sur des éléments interactifs
            if (e.target.classList.contains('btn-close') || 
                e.target.tagName === 'INPUT' || 
                e.target.tagName === 'BUTTON' || 
                e.target.tagName === 'TEXTAREA' ||
                e.target.tagName === 'SELECT' ||
                e.target.classList.contains('form-control') ||
                e.target.closest('button') ||
                e.target.closest('.btn')) {
                return;
            }
            
            // Seulement permettre le drag depuis l'en-tête du modal
            if (!e.target.closest('.modal-header')) {
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
            
            // Ajouter les événements de mouvement et de fin
            document.addEventListener('mousemove', drag);
            document.addEventListener('mouseup', dragEnd);
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
                
                // Supprimer les événements pour éviter les fuites mémoire
                document.removeEventListener('mousemove', drag);
                document.removeEventListener('mouseup', dragEnd);
            }
        }
          // Support pour les appareils tactiles
        dragHandle.addEventListener('touchstart', touchStart, { passive: false });
        
        function touchStart(e) {
            // Éviter le déplacement si on clique sur des éléments interactifs
            if (e.target.classList.contains('btn-close') || 
                e.target.tagName === 'INPUT' || 
                e.target.tagName === 'BUTTON' || 
                e.target.tagName === 'TEXTAREA' ||
                e.target.tagName === 'SELECT' ||
                e.target.classList.contains('form-control') ||
                e.target.closest('button') ||
                e.target.closest('.btn')) {
                return;
            }
            
            // Seulement permettre le drag depuis l'en-tête du modal
            if (!e.target.closest('.modal-header')) {
                return;
            }
            
            const touch = e.touches[0];
            
            // Enregistrer la position de départ pour détecter le mouvement
            startX = touch.clientX;
            startY = touch.clientY;
            hasMoved = false;
            
            isDragging = true;
            
            // Ajouter les événements de mouvement et de fin pour le tactile
            document.addEventListener('touchmove', touchMove, { passive: false });
            document.addEventListener('touchend', touchEnd);
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
                hasMoved = false;
                modalDialog.classList.remove('dragging');
                modalContent.classList.remove('dragging');
                
                // Supprimer les événements pour éviter les fuites mémoire
                document.removeEventListener('touchmove', touchMove);
                document.removeEventListener('touchend', touchEnd);
            }
        }    }
    
    // Appliquer la fonctionnalité de déplacement aux modals de manière optimisée
    const addModal = document.getElementById('addSousDomaineModal');
    if (addModal) {
        // Uniquement pour le modal d'ajout
        makeDraggable(addModal);
    }
    
    // Gestion optimisée des modals d'édition pour éviter le problème de flashing
    const editButtons = document.querySelectorAll('button[data-bs-target^="#editSousDomaineModal"]');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Empêcher les comportements par défaut qui peuvent causer des problèmes
            event.preventDefault();
            
            // Récupérer l'ID du modal ciblé
            const modalId = button.getAttribute('data-bs-target');
            const modal = document.querySelector(modalId);
            
            if (modal) {
                // Appliquer la fonctionnalité de déplacement après un court délai
                setTimeout(() => {
                    // Créer une instance de Bootstrap Modal de manière programmatique
                    const bsModal = new bootstrap.Modal(modal, {
                        backdrop: 'static',
                        keyboard: false
                    });
                    bsModal.show();
                    
                    // Appliquer la fonctionnalité de déplacement uniquement après l'affichage
                    setTimeout(() => {
                        makeDraggable(modal);
                    }, 300);
                }, 50);
            }
        });
    });
});
</script>
@endpush