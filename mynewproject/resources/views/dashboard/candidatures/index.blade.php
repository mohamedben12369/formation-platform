@extends('layouts.app')

@section('title', 'Gestion des candidatures')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-users me-2"></i>
                        Gestion des candidatures
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Filtres -->
                    <form method="GET" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="formation_id" class="form-label">Formation</label>
                                <select name="formation_id" id="formation_id" class="form-select">
                                    <option value="">Toutes les formations</option>
                                    @foreach($formations as $formation)
                                        <option value="{{ $formation->id }}" 
                                                {{ request('formation_id') == $formation->id ? 'selected' : '' }}>
                                            {{ $formation->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="statut" class="form-label">Statut</label>
                                <select name="statut" id="statut" class="form-select">
                                    <option value="">Tous les statuts</option>
                                    <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="accepte" {{ request('statut') == 'accepte' ? 'selected' : '' }}>Accepté</option>
                                    <option value="refuse" {{ request('statut') == 'refuse' ? 'selected' : '' }}>Refusé</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="search" class="form-label">Recherche</label>
                                <input type="text" name="search" id="search" class="form-control" 
                                       value="{{ request('search') }}" 
                                       placeholder="Nom, prénom ou email...">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Filtrer
                                    </button>
                                    <a href="{{ route('dashboard.candidatures.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Statistiques -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $candidatures->where('statut', 'en_attente')->count() }}</h4>
                                            <p class="mb-0">En attente</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-clock fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $candidatures->where('statut', 'accepte')->count() }}</h4>
                                            <p class="mb-0">Acceptées</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-check fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $candidatures->where('statut', 'refuse')->count() }}</h4>
                                            <p class="mb-0">Refusées</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-times fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $candidatures->total() }}</h4>
                                            <p class="mb-0">Total</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-users fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tableau des candidatures -->
                    @if($candidatures->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Candidat</th>
                                        <th>Formation</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Documents</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th width="200">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($candidatures as $candidature)
                                    <tr>
                                        <td>
                                            <strong>{{ $candidature->noms_complets }}</strong>
                                        </td>
                                        <td>
                                            <small>{{ $candidature->formation->nom }}</small>
                                        </td>
                                        <td>{{ $candidature->email }}</td>
                                        <td>{{ $candidature->telephone }}</td>                                        <td>
                                            @if($candidature->documents->count() > 0)
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        <i class="fas fa-file"></i> {{ $candidature->documents->count() }} doc(s)
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @foreach($candidature->documents as $document)
                                                        <li>
                                                            <a class="dropdown-item" href="#" 
                                                               onclick="viewDocumentQuick('{{ $document->id }}', '{{ $document->nom_original }}', '{{ $document->extension }}', '{{ route('candidatures.view-document', $document) }}')">
                                                                <i class="{{ $document->typeDocument->icone ?? 'fas fa-file' }} me-2" 
                                                                   style="color: {{ $document->typeDocument->couleur ?? '#6c757d' }}"></i>
                                                                {{ Str::limit($document->typeDocument->nom, 20) }}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @else
                                                <span class="badge bg-secondary">Aucun</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $candidature->statut_badge }}">
                                                {{ $candidature->statut_text }}
                                            </span>
                                        </td>
                                        <td>
                                            <small>{{ $candidature->created_at->format('d/m/Y H:i') }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('dashboard.candidatures.show', $candidature) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Voir les détails">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                @if($candidature->statut === 'en_attente')
                                                <form method="POST" 
                                                      action="{{ route('dashboard.candidatures.update-statut', $candidature) }}" 
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="statut" value="accepte">
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-success" 
                                                            title="Accepter"
                                                            onclick="return confirm('Accepter cette candidature ?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                
                                                <form method="POST" 
                                                      action="{{ route('dashboard.candidatures.update-statut', $candidature) }}" 
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="statut" value="refuse">
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            title="Refuser"
                                                            onclick="return confirm('Refuser cette candidature ?')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                                @endif
                                                
                                                <form method="POST" 
                                                      action="{{ route('dashboard.candidatures.destroy', $candidature) }}" 
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-dark" 
                                                            title="Supprimer"
                                                            onclick="return confirm('Supprimer définitivement cette candidature ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $candidatures->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucune candidature trouvée</h5>
                            <p class="text-muted">Aucune candidature ne correspond à vos critères de recherche.</p>
                        </div>
                    @endif
                </div>
            </div>        </div>
    </div>
</div>

<!-- Modal pour l'aperçu des documents -->
<div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">            <div class="modal-header draggable-header" style="cursor: move; user-select: none;">
                <h5 class="modal-title" id="documentModalLabel">
                    <i class="fas fa-file me-2"></i>
                    <span id="documentTitle">Aperçu du document</span>
                    <small class="text-muted ms-2">(Glissez pour déplacer)</small>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><div class="modal-body p-2">
                <div id="documentViewer" style="height: 500px; overflow: auto; border: 1px solid #dee2e6; border-radius: 0.375rem; background-color: #f8f9fa;">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Chargement...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Fermer
                </button>
                <a id="downloadBtn" href="#" class="btn btn-primary" target="_blank">
                    <i class="fas fa-download me-2"></i>Télécharger
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function viewDocumentQuick(documentId, fileName, extension, url) {
    viewDocument(documentId, fileName, extension, url);
}

function viewDocument(documentId, fileName, extension, url) {
    const modal = new bootstrap.Modal(document.getElementById('documentModal'));
    const documentTitle = document.getElementById('documentTitle');
    const documentViewer = document.getElementById('documentViewer');
    const downloadBtn = document.getElementById('downloadBtn');
    
    // Mettre à jour le titre
    documentTitle.textContent = fileName;
    
    // Mettre à jour le lien de téléchargement
    downloadBtn.href = url;
    
    // Afficher le loader
    documentViewer.innerHTML = `
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Chargement...</span>
        </div>
    `;
    
    // Ouvrir la modal
    modal.show();
    
    // Déterminer le type de contenu à afficher
    const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
    const pdfExtensions = ['pdf'];
    const docExtensions = ['doc', 'docx'];
    
    setTimeout(() => {
        let content = '';
          if (imageExtensions.includes(extension.toLowerCase())) {
            // Afficher l'image
            content = `
                <img src="${url}" 
                     class="img-fluid zoomable-image" 
                     style="max-height: 450px; border: 1px solid #ddd; border-radius: 8px; cursor: zoom-in;"
                     alt="${fileName}"
                     onclick="toggleImageZoom(this)">
            `;
        } else if (pdfExtensions.includes(extension.toLowerCase())) {
            // Afficher le PDF dans un iframe
            content = `
                <iframe src="${url}" 
                        style="width: 100%; height: 450px; border: 1px solid #ddd; border-radius: 8px;"
                        title="${fileName}">
                </iframe>
                <div class="mt-2">
                    <small class="text-muted">
                        Si le PDF ne s'affiche pas correctement, 
                        <a href="${url}" target="_blank">cliquez ici pour l'ouvrir dans un nouvel onglet</a>
                    </small>
                </div>
            `;
        } else if (docExtensions.includes(extension.toLowerCase())) {
            // Pour les documents Word, proposer le téléchargement
            content = `
                <div class="text-center py-5">
                    <i class="fas fa-file-word fa-5x text-primary mb-3"></i>
                    <h5>Document Word</h5>
                    <p class="text-muted">Les documents Word ne peuvent pas être prévisualisés directement.</p>
                    <a href="${url}" class="btn btn-primary" target="_blank">
                        <i class="fas fa-download me-2"></i>Télécharger pour ouvrir
                    </a>
                </div>
            `;
        } else {
            // Type de fichier non supporté pour la prévisualisation
            content = `
                <div class="text-center py-5">
                    <i class="fas fa-file fa-5x text-muted mb-3"></i>
                    <h5>Aperçu non disponible</h5>
                    <p class="text-muted">Ce type de fichier (${extension.toUpperCase()}) ne peut pas être prévisualisé.</p>
                    <a href="${url}" class="btn btn-primary" target="_blank">
                        <i class="fas fa-download me-2"></i>Télécharger le fichier
                    </a>
                </div>
            `;
        }
          documentViewer.innerHTML = content;
    }, 500);
}

// Fonctionnalité de déplacement de la modal
document.addEventListener('DOMContentLoaded', function() {
    let isDragging = false;
    let currentX;
    let currentY;
    let initialX;
    let initialY;
    let xOffset = 0;
    let yOffset = 0;
    
    const modal = document.getElementById('documentModal');
    const modalDialog = modal.querySelector('.modal-dialog');
    const dragHandle = modal.querySelector('.draggable-header');
    
    // Réinitialiser la position quand la modal s'ouvre
    modal.addEventListener('shown.bs.modal', function() {
        modalDialog.style.transform = 'translate(0, 0)';
        modalDialog.style.position = 'relative';
        xOffset = 0;
        yOffset = 0;
    });
    
    dragHandle.addEventListener('mousedown', dragStart);
    document.addEventListener('mousemove', drag);
    document.addEventListener('mouseup', dragEnd);
    
    // Support tactile
    dragHandle.addEventListener('touchstart', dragStart);
    document.addEventListener('touchmove', drag);
    document.addEventListener('touchend', dragEnd);
    
    function dragStart(e) {
        if (e.type === "touchstart") {
            initialX = e.touches[0].clientX - xOffset;
            initialY = e.touches[0].clientY - yOffset;
        } else {
            initialX = e.clientX - xOffset;
            initialY = e.clientY - yOffset;
        }
        
        if (e.target === dragHandle || dragHandle.contains(e.target)) {
            isDragging = true;
            modalDialog.style.transition = 'none';
        }
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
            
            // Limiter le déplacement aux bordures de l'écran
            const maxX = window.innerWidth - modalDialog.offsetWidth;
            const maxY = window.innerHeight - modalDialog.offsetHeight;
            
            xOffset = Math.min(Math.max(xOffset, -modalDialog.offsetLeft), maxX - modalDialog.offsetLeft);
            yOffset = Math.min(Math.max(yOffset, -modalDialog.offsetTop), maxY - modalDialog.offsetTop);
            
            modalDialog.style.transform = `translate(${xOffset}px, ${yOffset}px)`;
        }
    }
    
    function dragEnd(e) {
        initialX = currentX;
        initialY = currentY;
        isDragging = false;
        modalDialog.style.transition = '';
    }
});

// Fonction de zoom pour les images
function toggleImageZoom(img) {
    if (img.classList.contains('zoomed')) {
        img.classList.remove('zoomed');
        img.style.cursor = 'zoom-in';
        img.style.transform = 'scale(1)';
        img.style.position = 'relative';
        img.style.zIndex = 'auto';
    } else {
        img.classList.add('zoomed');
        img.style.cursor = 'zoom-out';
        img.style.transform = 'scale(2)';
        img.style.position = 'relative';
        img.style.zIndex = '1000';
        img.style.transition = 'transform 0.3s ease';
    }
}
</script>

<style>
.modal-lg {
    max-width: 80vw;
}

.draggable-header {
    cursor: move !important;
    user-select: none !important;
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    border-bottom: 2px solid #dee2e6;
}

.draggable-header:hover {
    background: linear-gradient(45deg, #e9ecef, #dee2e6);
}

.draggable-header::before {
    content: "⋮⋮";
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 14px;
    letter-spacing: 2px;
}

.modal-dialog {
    transition: transform 0.2s ease-out;
}

#documentViewer {
    height: 500px !important;
    overflow: auto;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    background-color: #f8f9fa;
    position: relative;
}

#documentViewer img {
    transition: transform 0.3s ease;
    cursor: zoom-in;
    max-width: 100%;
    height: auto;
}

#documentViewer img:hover {
    transform: scale(1.05);
}

#documentViewer iframe {
    border: none;
    border-radius: 0.375rem;
}

.dropdown-menu {
    max-height: 300px;
    overflow-y: auto;
}

.dropdown-item {
    padding: 0.5rem 1rem;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

/* Indicateur de déplacement */
.modal.show .draggable-header {
    position: relative;
}

/* Animation de zoom pour les images */
#documentViewer img.zoomed {
    transform: scale(2);
    cursor: zoom-out;
    z-index: 1000;
    position: relative;
}

/* Amélioration du scrollbar */
#documentViewer::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

#documentViewer::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

#documentViewer::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

#documentViewer::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

@endsection
