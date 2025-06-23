@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Gestion des Axes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Bouton pour ouvrir le modal d'ajout -->
    <button class="btn btn-success mb-3 w-100" data-bs-toggle="modal" data-bs-target="#addAxeModal">
        <img src="{{ asset('images/add.webp') }}" alt="Ajouter" width="18" height="18">
    </button>    <!-- Modal d'ajout -->
    <div class="modal fade" id="addAxeModal" tabindex="-1" aria-labelledby="addAxeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('dashboard.axes.store') }}">
                    @csrf
                    <div class="modal-header drag-handle" style="cursor: move; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                        <h5 class="modal-title" id="addAxeModalLabel">Ajouter un Axe</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="axe-nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="axe-nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="axe-description" class="form-label">Description</label>
                            <textarea class="form-control" id="axe-description" name="description" rows="3"></textarea>
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
    <!-- Menu trois points pour colonnes -->
    <div class="d-flex justify-content-end mb-2" style="position:relative; z-index:1055;">
        <div id="customDropdown" style="z-index:1055; position:relative; display:inline-block;">
            <button class="btn btn-light" type="button" id="customDropdownButton">
                <span style="font-size: 1.5rem;">&#8942;</span>
            </button>
            <ul id="customDropdownMenu" class="dropdown-menu show" style="display:none; position:absolute; right:0; min-width:220px; z-index:2000;">
                <li class="dropdown-header">Colonnes de la table Axes</li>
                <li><label class="dropdown-item"><input type="checkbox" class="toggle-col" data-col="nom" checked> Nom</label></li>
                <li><label class="dropdown-item"><input type="checkbox" class="toggle-col" data-col="description" checked> Description</label></li>
                <li><label class="dropdown-item"><input type="checkbox" class="toggle-col" data-col="actions" checked> Actions</label></li>
            </ul>
        </div>
    </div>
    <!-- Pagination au-dessus de la table -->
    <nav>
        <ul class="pagination justify-content-center" id="axes-pagination"></ul>
    </nav>
    <table class="table" id="axes-table">
        <thead>
            <tr>
                <th class="col-nom">Nom</th>
                <th class="col-description">Description</th>
                <th class="col-actions">Actions</th>
            </tr>
        </thead>
        <tbody id="axes-tbody">
            @foreach($axes ?? [] as $axe)
            <tr>
                <td class="col-nom">{{ $axe->nom }}</td>
                <td class="col-description">{{ $axe->description }}</td>
                <td class="col-actions">
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAxeModal{{ $axe->id }}">
                        <img src="{{ asset('images/edit.webp') }}" alt="Modifier" width="18" height="18">
                    </button>
                    <form action="{{ route('dashboard.axes.destroy', $axe->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" name="stay" value="1" onclick="return confirm('Supprimer cet axe ?')">
                            <img src="{{ asset('images/delete.webp') }}" alt="Supprimer" width="18" height="18">
                        </button>
                    </form>
                </td>
            </tr>            <!-- Modal d'édition -->
            <div class="modal fade" id="editAxeModal{{ $axe->id }}" tabindex="-1" aria-labelledby="editAxeModalLabel{{ $axe->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('dashboard.axes.update', $axe->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header drag-handle" style="cursor: move; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <h5 class="modal-title" id="editAxeModalLabel{{ $axe->id }}">Modifier Axe</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nom{{ $axe->id }}" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom{{ $axe->id }}" name="nom" value="{{ $axe->nom }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description{{ $axe->id }}" class="form-label">Description</label>
                                    <textarea class="form-control" id="description{{ $axe->id }}" name="description" rows="3">{{ $axe->description }}</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <img src="{{ asset('images/close.webp') }}" alt="Annuler" width="18" height="18">
                                </button>
                                <button type="submit" class="btn btn-primary" name="stay" value="1">
                                    <img src="{{ asset('images/confirm.png') }}" alt="Enregistrer" width="18" height="18">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
    <!-- Pagination en bas si besoin -->
    <nav>
        <ul class="pagination justify-content-center" id="axes-pagination-bottom"></ul>
    </nav>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Variables globales pour le déplacement
    let isDragging = false;
    let currentModal = null;
    let dragOffset = { x: 0, y: 0 };
    let startPos = { x: 0, y: 0 };
    
    // Initialiser les modals pour le déplacement quand ils s'ouvrent
    $('.modal').on('shown.bs.modal', function() {
        const modal = $(this).find('.modal-dialog');
        const modalRect = modal[0].getBoundingClientRect();
        
        // Centrer le modal et le préparer pour le déplacement
        modal.css({
            'position': 'fixed',
            'top': '50%',
            'left': '50%',
            'transform': 'translate(-50%, -50%)',
            'margin': '0',
            'z-index': '1055'
        });
    });    // Gérer le début du déplacement
    $(document).on('mousedown', '.drag-handle', function(e) {
        // Ne pas traiter si on clique sur le bouton fermer
        if ($(e.target).hasClass('btn-close') || 
            $(e.target).closest('.btn-close').length > 0 ||
            $(e.target).is('.btn-close::before')) {
            console.log('Clic sur bouton fermer - pas de drag');
            return true; // Laisser le comportement normal du bouton
        }
        
        // Ne traiter que si on clique sur la zone de déplacement
        const clickX = e.offsetX || e.originalEvent.layerX;
        const headerWidth = $(this).width();
        
        // Zone de déplacement : côtés gauche et droite (pas le centre)
        if (clickX > 50 && clickX < (headerWidth - 80)) {
            console.log('Clic dans la zone titre - pas de drag');
            return true;
        }
        
        e.preventDefault();
        e.stopPropagation();
        
        console.log('Début du déplacement');
        isDragging = true;
        currentModal = $(this).closest('.modal-dialog');
        
        // Sauvegarder la position de départ
        const modalRect = currentModal[0].getBoundingClientRect();
        startPos.x = modalRect.left;
        startPos.y = modalRect.top;
        
        // Calculer l'offset du clic
        dragOffset.x = e.clientX - modalRect.left;
        dragOffset.y = e.clientY - modalRect.top;
        
        // Préparer le modal pour le déplacement
        currentModal.css({
            'position': 'fixed',
            'top': startPos.y + 'px',
            'left': startPos.x + 'px',
            'transform': 'none',
            'margin': '0',
            'z-index': '1060'
        });
        
        // Ajouter la classe de déplacement
        currentModal.addClass('dragging');
        $('body').addClass('no-select');
        
        console.log('Déplacement commencé à:', startPos);
    });
    
    // Gérer le déplacement
    $(document).on('mousemove', function(e) {
        if (isDragging && currentModal) {
            e.preventDefault();
            
            // Calculer la nouvelle position
            const newX = e.clientX - dragOffset.x;
            const newY = e.clientY - dragOffset.y;
            
            // Obtenir les dimensions
            const modalWidth = currentModal.outerWidth();
            const modalHeight = currentModal.outerHeight();
            const windowWidth = $(window).width();
            const windowHeight = $(window).height();
            
            // Limites de déplacement
            const minX = 0;
            const minY = 0;
            const maxX = windowWidth - modalWidth;
            const maxY = windowHeight - modalHeight;
            
            // Appliquer les limites
            const boundedX = Math.max(minX, Math.min(newX, maxX));
            const boundedY = Math.max(minY, Math.min(newY, maxY));
            
            // Appliquer la nouvelle position
            currentModal.css({
                'left': boundedX + 'px',
                'top': boundedY + 'px'
            });
        }
    });
    
    // Gérer la fin du déplacement
    $(document).on('mouseup', function(e) {
        if (isDragging) {
            isDragging = false;
            
            if (currentModal) {
                currentModal.removeClass('dragging');
                console.log('Déplacement terminé');
                currentModal = null;
            }
            
            $('body').removeClass('no-select');
        }
    });
      // Empêcher les clics dans le modal de fermer ou d'interférer
    $(document).on('mousedown', '.modal-body, .modal-footer', function(e) {
        e.stopPropagation();
    });
      // Gérer spécifiquement le bouton fermer
    $(document).on('click', '.btn-close', function(e) {
        console.log('Clic sur bouton fermer');
        e.stopPropagation();
        e.preventDefault();
        
        // Fermer le modal manuellement
        const modal = $(this).closest('.modal');
        modal.modal('hide');
    });
    
    // Alternative: gérer avec data-bs-dismiss
    $(document).on('click', '[data-bs-dismiss="modal"]', function(e) {
        console.log('Clic sur data-bs-dismiss');
        e.stopPropagation();
    });
    
    // Réinitialiser à la fermeture
    $('.modal').on('hidden.bs.modal', function() {
        $(this).find('.modal-dialog').removeAttr('style').removeClass('dragging');
    });

    // Custom dropdown (sans Bootstrap)
    $('#customDropdownButton').on('click', function(e) {
        e.stopPropagation();
        $('#customDropdownMenu').toggle();
    });
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#customDropdown').length) {
            $('#customDropdownMenu').hide();
        }
    });
    // Colonnes dynamiques
    $('.toggle-col').on('change', function() {
        let col = $(this).data('col');
        $('.col-' + col).toggle(this.checked);
    });
    // Pagination JS
    const rowsPerPage = 8;
    const $rows = $('#axes-tbody tr');
    let currentPage = 1;
    function renderPagination() {
        const pageCount = Math.ceil($rows.length / rowsPerPage);
        const paginations = [$('#axes-pagination'), $('#axes-pagination-bottom')];
        paginations.forEach(function($pagination) {
            $pagination.empty();
            for (let i = 1; i <= pageCount; i++) {
                let $li = $('<li>').addClass('page-item' + (i === currentPage ? ' active' : ''));
                let $a = $('<a>').addClass('page-link').attr('href', '#').text(i);
                $a.on('click', function(e) {
                    e.preventDefault();
                    currentPage = i;
                    showPage();
                });
                $li.append($a);
                $pagination.append($li);
            }
        });
    }
    function showPage() {
        $rows.each(function(idx) {
            $(this).toggle(idx >= (currentPage-1)*rowsPerPage && idx < currentPage*rowsPerPage);
        });
        renderPagination();
    }
    showPage();
});
</script>
@endpush

@push('styles')
    @vite('resources/css/axes-section.css')
    <style>
        .draggable-modal {
            transition: none !important;
        }        .drag-handle {
            user-select: none;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 8px 8px 0 0;
            position: relative;
            cursor: move !important;
            padding: 12px 50px 12px 15px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            min-height: 50px;
        }
          .drag-handle::before {
            content: "⋮⋮⋮";
            font-size: 16px;
            opacity: 0.6;
            pointer-events: none;
            z-index: 1;
            margin-right: 15px;
        }
        
        .drag-handle::after {
            content: "⋮⋮⋮";
            font-size: 16px;
            opacity: 0.6;
            pointer-events: none;
            z-index: 1;
            position: absolute;
            right: 70px;
        }
        
        .drag-handle:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);        }
          .drag-handle .modal-title {
            color: white;
            font-weight: 600;
            margin: 0;
            position: relative;
            z-index: 10;
            text-align: left;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            flex-grow: 1;
            pointer-events: none;
        }
        
        .drag-handle:hover::before,
        .drag-handle:hover::after {
            opacity: 1;
            color: #ffd700;
        }        .drag-handle .btn-close {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 50;
            pointer-events: auto !important;
            cursor: pointer !important;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 3px;
            padding: 4px 8px;
            width: auto;
            height: auto;
            display: inline-block;
            font-size: 18px;
            font-weight: bold;
            color: white;
            line-height: 1;
            min-width: 24px;
            text-align: center;
        }
        
        .drag-handle .btn-close:hover {
            background: rgba(255, 255, 255, 0.4);
            color: #ff6b6b;
            transform: none;
        }
        
        .drag-handle .btn-close::before {
            content: "✕";
            display: block;
        }
        
        .modal-content {
            border: none;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        .dragging {
            opacity: 0.9;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4) !important;
        }
        
        .no-select {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        
        .drag-handle {
            cursor: move !important;
        }
        
        .modal-dialog.dragging .modal-content {
            transform: rotate(1deg);
            transition: transform 0.1s ease;
        }
    </style>
@endpush
