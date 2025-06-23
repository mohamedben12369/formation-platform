@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Gestion des Rôles</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Bouton pour ouvrir le modal d'ajout -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addRoleModal">
        <img src="{{ asset('images/add.webp') }}" alt="Ajouter" width="18" height="18" class="me-2">
        Ajouter un Rôle
    </button>

    <!-- Modal d'ajout -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-draggable modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('dashboard.roles.store') }}">
                    @csrf
                    <div class="modal-header draggable-header" style="cursor: move;">
                        <h5 class="modal-title" id="addRoleModalLabel">
                            <i class="fas fa-arrows-alt me-2 text-muted"></i>
                            Ajouter un Rôle
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="role-nom" class="form-label">Nom du rôle</label>
                            <input type="text" class="form-control" id="role-nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                @forelse($permissions ?? [] as $permission)
                                <div class="col-md-6 col-lg-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}">
                                        <label class="form-check-label" for="perm_{{ $permission->id }}">
                                            {{ $permission->nom }}
                                        </label>
                                    </div>
                                </div>
                                @empty
                                <p class="text-muted">Aucune permission disponible</p>
                                @endforelse
                            </div>
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

    <!-- Table des rôles -->
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles ?? [] as $role)
            <tr>
                <td>{{ $role->nom }}</td>
                <td>
                    @if($role->permissions->count() > 0)
                        @foreach($role->permissions as $permission)
                            <span class="badge bg-primary me-1">{{ $permission->nom }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">Aucune permission</span>
                    @endif
                </td>
                <td>
                    <!-- Bouton pour ouvrir le modal d'édition -->
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $role->id }}">
                        <img src="{{ asset('images/edit.webp') }}" alt="Modifier" width="18" height="18">
                    </button>
                    <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce rôle ?')">
                            <img src="{{ asset('images/delete.webp') }}" alt="Supprimer" width="18" height="18">
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Modal d'édition -->
            <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1" aria-labelledby="editRoleModalLabel{{ $role->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-draggable modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('dashboard.roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header draggable-header" style="cursor: move;">
                                <h5 class="modal-title" id="editRoleModalLabel{{ $role->id }}">
                                    <i class="fas fa-arrows-alt me-2 text-muted"></i>
                                    Modifier Rôle
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nom{{ $role->id }}" class="form-label">Nom du rôle</label>
                                    <input type="text" class="form-control" id="nom{{ $role->id }}" name="nom" value="{{ $role->nom }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Permissions</label>
                                    <div class="row">
                                        @forelse($permissions ?? [] as $permission)
                                        <div class="col-md-6 col-lg-4 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                                       id="edit_perm_{{ $role->id }}_{{ $permission->id }}"
                                                       {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="edit_perm_{{ $role->id }}_{{ $permission->id }}">
                                                    {{ $permission->nom }}
                                                </label>
                                            </div>
                                        </div>
                                        @empty
                                        <p class="text-muted">Aucune permission disponible</p>
                                        @endforelse
                                    </div>
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
                <td colspan="3" class="text-center text-muted">Aucun rôle trouvé</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fonctionnalité de déplacement du modal (même code que les autres pages)
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
        const dragHandle = modal.querySelector('.modal-content');
        
        if (!dragHandle) return;
        
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
            startX = e.clientX;
            startY = e.clientY;
            hasMoved = false;
            
            const rect = modalDialog.getBoundingClientRect();
            initialX = e.clientX - rect.left;
            initialY = e.clientY - rect.top;
            
            isDragging = true;
        }
        
        function drag(e) {
            if (isDragging) {
                e.preventDefault();
                
                const deltaX = Math.abs(e.clientX - startX);
                const deltaY = Math.abs(e.clientY - startY);
                
                if (!hasMoved && (deltaX > 5 || deltaY > 5)) {
                    hasMoved = true;
                    modalDialog.classList.add('dragging');
                    modalContent.classList.add('dragging');
                    xOffset = 0;
                    yOffset = 0;
                }
                
                if (hasMoved) {
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
    }
    
    // Appliquer la fonctionnalité de déplacement aux modaux
    const addModal = document.getElementById('addRoleModal');
    if (addModal) {
        makeDraggable(addModal);
    }
    
    // Pour les modaux d'édition
    document.addEventListener('shown.bs.modal', function(e) {
        if (e.target.id.startsWith('editRoleModal')) {
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
        resize: none !important;
    }
    
    .modal-dialog {
        resize: none !important;
        overflow: visible !important;
    }
    
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
    
    .modal-content:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        transition: box-shadow 0.3s ease;
    }
    
    .badge {
        font-size: 0.75em;
    }
</style>
@endpush
