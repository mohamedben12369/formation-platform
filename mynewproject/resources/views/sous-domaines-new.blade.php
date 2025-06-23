@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Gestion des Sous-Domaines</h5>
                    <button type="button" class="btn btn-primary" id="btnAddSousDomaine">
                        <img src="{{ asset('images/add.webp') }}" alt="Ajouter" width="18" height="18">
                    </button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Domaine</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sousDomaines as $sousDomaine)
                                <tr>
                                    <td>{{ $sousDomaine->code }}</td>
                                    <td>{{ $sousDomaine->description }}</td>
                                    <td>{{ $sousDomaine->domaine->nom }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning edit-btn" 
                                                data-id="{{ $sousDomaine->id }}"
                                                data-code="{{ $sousDomaine->code }}"
                                                data-description="{{ $sousDomaine->description }}"
                                                data-domaine="{{ $sousDomaine->domaine_code }}">
                                            <img src="{{ asset('images/edit.webp') }}" alt="Modifier" width="18" height="18">
                                        </button>
                                        <form action="{{ route('dashboard.sous-domaines.destroy', $sousDomaine->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <img src="{{ asset('images/delete.webp') }}" alt="Supprimer" width="18" height="18">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucun sous-domaine trouvé</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>                    <!-- Pagination -->
                    @if(isset($sousDomaines) && method_exists($sousDomaines, 'links'))
                    <div class="d-flex justify-content-center mt-4">
                        {{ $sousDomaines->links('vendor.pagination.bootstrap-4-compact') }}
                    </div>

                    {{-- Informations sur la pagination --}}
                    <div class="text-center mt-2">
                        <small class="text-muted">
                            {{ $sousDomaines->firstItem() ?? 0 }}-{{ $sousDomaines->lastItem() ?? 0 }}/{{ $sousDomaines->total() ?? 0 }}
                        </small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour ajouter un sous-domaine -->
<div class="modal fade" id="addSousDomaineModal" tabindex="-1" aria-labelledby="addSousDomaineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSousDomaineModalLabel">Ajouter un Sous-Domaine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
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
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="domaine_code" class="form-label">Domaine</label>
                        <select class="form-select" id="domaine_code" name="domaine_code" required>
                            <option value="" selected disabled>Sélectionnez un domaine</option>
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

<!-- Modal pour modifier un sous-domaine -->
<div class="modal fade" id="editSousDomaineModal" tabindex="-1" aria-labelledby="editSousDomaineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSousDomaineModalLabel">Modifier le Sous-Domaine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <form id="editSousDomaineForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_code" class="form-label">Code</label>
                        <input type="text" class="form-control" id="edit_code" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="edit_description" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_domaine_code" class="form-label">Domaine</label>
                        <select class="form-select" id="edit_domaine_code" name="domaine_code" required>
                            @foreach($domaines as $domaine)
                                <option value="{{ $domaine->id }}">{{ $domaine->nom }}</option>
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
@endsection

@push('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    
    .btn-sm {
        margin-right: 5px;
    }
    
    /* Effet de survol sur les lignes du tableau */
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
        transition: background-color 0.2s ease;
    }
    
    /* Style pour les boutons */
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
    
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }
    
    .btn-warning:hover {
        background-color: #ffca2c;
        border-color: #ffc720;
    }
    
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    
    .btn-danger:hover {
        background-color: #bb2d3b;
        border-color: #b02a37;
    }
    
    /* Animation pour les alertes */
    .alert {
        animation: fadeIn 0.5s;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    /* Styles pour les modals déplaçables */
    .modal-draggable .modal-dialog {
        position: fixed;
        margin: 0;
        pointer-events: none;
    }
    
    .modal-draggable .modal-content {
        pointer-events: auto;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        animation: modalFadeIn 0.3s ease-out;
    }
    
    .draggable-handle {
        cursor: move;
        background-color: #f8f9fa;
        transition: background-color 0.2s;
        border-radius: 8px 8px 0 0;
    }
    
    .draggable-handle:hover {
        background-color: #e9ecef;
    }
    
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Styles pour la pagination compacte */
    .pagination {
        margin-bottom: 0;
        transform: scale(0.85);
        transform-origin: center center;
    }
    
    .page-link {
        padding: 0.2rem 0.35rem;
        font-size: 0.7rem;
        line-height: 1;
        min-width: 1.5rem;
        height: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 1px;
    }
    
    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    /* Style pour réduire les marges autour de la pagination */
    .d-flex.justify-content-center.mt-4 {
        margin-top: 0.75rem !important;
    }
    
    /* Style pour le texte d'information de pagination */
    .text-center.mt-3 {
        margin-top: 0.5rem !important;
    }
    
    .text-center.mt-3 small {
        font-size: 70%;
    }
    
    /* Styles supplémentaires pour une pagination plus compacte */
    .pagination .page-item {
        margin: 0 1px;
    }
    
    .pagination .page-link {
        border-radius: 3px;
        border-width: 1px;
        box-shadow: none;
    }
    
    .pagination .page-link:hover {
        z-index: 2;
        color: #fff;
        background-color: #0d6efd;
        border-color: #0a58ca;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Remplacer les textes de pagination par des icônes
    function updatePaginationIcons() {
        const pagination = document.querySelector('.pagination');
        if (pagination) {
            // Première page
            const firstPageLinks = pagination.querySelectorAll('li.page-item a.page-link[aria-label="Première page"]');
            firstPageLinks.forEach(link => {
                link.innerHTML = '<span aria-hidden="true">&laquo;</span>';
            });
            
            // Page précédente
            const prevPageLinks = pagination.querySelectorAll('li.page-item a.page-link[aria-label="Précédent"]');
            prevPageLinks.forEach(link => {
                link.innerHTML = '<span aria-hidden="true">&lsaquo;</span>';
            });
            
            // Page suivante
            const nextPageLinks = pagination.querySelectorAll('li.page-item a.page-link[aria-label="Suivant"]');
            nextPageLinks.forEach(link => {
                link.innerHTML = '<span aria-hidden="true">&rsaquo;</span>';
            });
            
            // Dernière page
            const lastPageLinks = pagination.querySelectorAll('li.page-item a.page-link[aria-label="Dernière page"]');
            lastPageLinks.forEach(link => {
                link.innerHTML = '<span aria-hidden="true">&raquo;</span>';
            });
        }
    }
    
    // Exécuter une première fois et aussi après un court délai pour s'assurer que les éléments sont chargés
    updatePaginationIcons();
    setTimeout(updatePaginationIcons, 500);
    
    // Initialiser le modal d'ajout
    const addModalEl = document.getElementById('addSousDomaineModal');
    const editModalEl = document.getElementById('editSousDomaineModal');
    const addModal = new bootstrap.Modal(addModalEl);
    const editModal = new bootstrap.Modal(editModalEl);
    
    // Ajouter la classe pour les modals déplaçables
    addModalEl.classList.add('modal-draggable');
    editModalEl.classList.add('modal-draggable');
    
    // Modifier les en-têtes pour indiquer qu'ils sont déplaçables
    addModalEl.querySelector('.modal-header').classList.add('draggable-handle');
    editModalEl.querySelector('.modal-header').classList.add('draggable-handle');
    
    // Ouvrir le modal d'ajout
    document.getElementById('btnAddSousDomaine').addEventListener('click', function() {
        addModal.show();
        
        // Centrer initialement le modal
        setTimeout(function() {
            centerModalDialog(addModalEl.querySelector('.modal-dialog'));
        }, 200);
    });
    
    // Gérer le clic sur les boutons d'édition
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const code = this.getAttribute('data-code');
            const description = this.getAttribute('data-description');
            const domaine = this.getAttribute('data-domaine');
            
            // Définir l'action du formulaire
            document.getElementById('editSousDomaineForm').action = 
                `{{ route('dashboard.sous-domaines.index') }}/${id}`;
            
            // Remplir le formulaire avec les données
            document.getElementById('edit_code').value = code;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_domaine_code').value = domaine;
            
            // Afficher le modal
            editModal.show();
            
            // Centrer initialement le modal
            setTimeout(function() {
                centerModalDialog(editModalEl.querySelector('.modal-dialog'));
            }, 200);
        });
    });
    
    // Confirmation avant suppression
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer ce sous-domaine ?')) {
                e.preventDefault();
            }
        });
    });
    
    // Valider les formulaires avant soumission
    document.getElementById('addSousDomaineForm').addEventListener('submit', validateForm);
    document.getElementById('editSousDomaineForm').addEventListener('submit', validateForm);
    
    function validateForm(e) {
        const form = e.target;
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        form.classList.add('was-validated');
    }
    
    // Rendre les modals déplaçables
    makeDraggable(addModalEl);
    makeDraggable(editModalEl);
    
    // Fonction pour centrer un modal
    function centerModalDialog(modalDialog) {
        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;
        const dialogWidth = modalDialog.clientWidth;
        const dialogHeight = modalDialog.clientHeight;
        
        const left = Math.max(0, (windowWidth - dialogWidth) / 2);
        const top = Math.max(0, (windowHeight - dialogHeight) / 3);
        
        modalDialog.style.top = top + 'px';
        modalDialog.style.left = left + 'px';
    }
    
    // Fonction pour rendre un modal déplaçable
    function makeDraggable(modalElement) {
        const modalDialog = modalElement.querySelector('.modal-dialog');
        const dragHandle = modalElement.querySelector('.draggable-handle');
        
        if (!dragHandle || !modalDialog) return;
        
        let isDragging = false;
        let startX, startY;
        let startLeft, startTop;
        
        // Gestionnaire pour commencer le déplacement
        dragHandle.addEventListener('mousedown', function(e) {
            // Ne pas déplacer si on clique sur un bouton ou un input
            if (e.target.closest('button, input, select')) {
                return;
            }
            
            isDragging = true;
            
            // Récupérer les positions initiales
            startX = e.clientX;
            startY = e.clientY;
            
            // Obtenir la position actuelle du modal
            const style = window.getComputedStyle(modalDialog);
            startLeft = parseInt(style.left) || 0;
            startTop = parseInt(style.top) || 0;
            
            // Ajouter des styles temporaires
            modalDialog.style.transition = 'none';
            modalDialog.style.cursor = 'grabbing';
            
            // Ajouter des écouteurs d'événements pour le déplacement
            document.addEventListener('mousemove', doDrag);
            document.addEventListener('mouseup', stopDrag);
            
            // Empêcher la sélection de texte pendant le déplacement
            e.preventDefault();
        });
        
        // Gestionnaire pour le déplacement
        function doDrag(e) {
            if (!isDragging) return;
            
            // Calculer la nouvelle position
            const dx = e.clientX - startX;
            const dy = e.clientY - startY;
            
            // Appliquer la nouvelle position
            modalDialog.style.left = (startLeft + dx) + 'px';
            modalDialog.style.top = (startTop + dy) + 'px';
        }
        
        // Gestionnaire pour arrêter le déplacement
        function stopDrag() {
            if (!isDragging) return;
            
            isDragging = false;
            modalDialog.style.cursor = '';
            
            // Supprimer les écouteurs d'événements
            document.removeEventListener('mousemove', doDrag);
            document.removeEventListener('mouseup', stopDrag);
        }
        
        // Réinitialiser la position lors de la fermeture du modal
        modalElement.addEventListener('hidden.bs.modal', function() {
            modalDialog.style.transform = '';
            modalDialog.style.top = '';
            modalDialog.style.left = '';
        });
    }
});
</script>
@endpush
