@extends('layouts.app')

@section('title', 'Détails de la candidature')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-user-graduate me-2"></i>
                        Candidature de {{ $candidature->noms_complets }}
                    </h5>
                    <span class="badge {{ $candidature->statut_badge }} fs-6">
                        {{ $candidature->statut_text }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Informations sur la formation -->
                        <div class="col-md-6 mb-4">
                            <h6 class="text-primary border-bottom pb-2">
                                <i class="fas fa-graduation-cap me-2"></i>Formation
                            </h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Nom :</strong></td>
                                    <td>{{ $candidature->formation->nom }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Prix :</strong></td>
                                    <td>{{ number_format($candidature->formation->prix_total, 0, ',', ' ') }} FCFA</td>
                                </tr>
                                <tr>
                                    <td><strong>Durée :</strong></td>
                                    <td>{{ $candidature->formation->duree_totale }} heures</td>
                                </tr>
                                @if($candidature->formation->date_debut)
                                <tr>
                                    <td><strong>Date de début :</strong></td>
                                    <td>{{ $candidature->formation->date_debut->format('d/m/Y') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>

                        <!-- Informations personnelles -->
                        <div class="col-md-6 mb-4">
                            <h6 class="text-primary border-bottom pb-2">
                                <i class="fas fa-user me-2"></i>Informations personnelles
                            </h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Nom complet :</strong></td>
                                    <td>{{ $candidature->noms_complets }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email :</strong></td>
                                    <td>
                                        <a href="mailto:{{ $candidature->email }}">{{ $candidature->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Téléphone :</strong></td>
                                    <td>
                                        <a href="tel:{{ $candidature->telephone }}">{{ $candidature->telephone }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Date de candidature :</strong></td>
                                    <td>{{ $candidature->created_at->format('d/m/Y à H:i') }}</td>
                                </tr>
                                @if($candidature->user)
                                <tr>
                                    <td><strong>Utilisateur connecté :</strong></td>
                                    <td>
                                        <i class="fas fa-check-circle text-success"></i> Oui
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <!-- Lettre de motivation -->
                    @if($candidature->motivation)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary border-bottom pb-2">
                                <i class="fas fa-heart me-2"></i>Lettre de motivation
                            </h6>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <p class="mb-0">{{ $candidature->motivation }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Documents -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary border-bottom pb-2">
                                <i class="fas fa-paperclip me-2"></i>Documents fournis ({{ $candidature->documents->count() }})
                            </h6>
                            @if($candidature->documents->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Type de document</th>
                                                <th>Nom du fichier</th>
                                                <th>Taille</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($candidature->documents as $document)
                                            <tr>
                                                <td>
                                                    <i class="{{ $document->typeDocument->icone ?? 'fas fa-file' }} me-2" 
                                                       style="color: {{ $document->typeDocument->couleur ?? '#6c757d' }}"></i>
                                                    {{ $document->typeDocument->nom }}
                                                </td>
                                                <td>{{ $document->nom_original }}</td>
                                                <td>{{ $document->taille_formatee }}</td>                                                <td>
                                                    @if($document->exists())
                                                        <div class="btn-group" role="group">                                                            <button type="button" 
                                                                    class="btn btn-sm btn-outline-info" 
                                                                    onclick="viewDocument('{{ $document->id }}', '{{ $document->nom_original }}', '{{ $document->extension }}', '{{ route('candidatures.view-document', $document) }}')"
                                                                    title="Voir">
                                                                <i class="fas fa-eye"></i> Voir
                                                            </button>
                                                            <a href="{{ route('candidatures.download-document', $document) }}" 
                                                               class="btn btn-sm btn-outline-primary" 
                                                               title="Télécharger">
                                                                <i class="fas fa-download"></i> Télécharger
                                                            </a>
                                                        </div>
                                                    @else
                                                        <span class="text-danger">
                                                            <i class="fas fa-exclamation-triangle"></i> Fichier introuvable
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Aucun document fourni pour cette candidature.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions sur la candidature -->
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="text-primary border-bottom pb-2">
                                <i class="fas fa-cogs me-2"></i>Actions
                            </h6>
                            <div class="d-flex gap-2 flex-wrap">
                                <!-- Changer le statut -->
                                @if($candidature->statut === 'en_attente')
                                    <form method="POST" action="{{ route('dashboard.candidatures.update-statut', $candidature) }}" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="statut" value="accepte">
                                        <button type="submit" 
                                                class="btn btn-success" 
                                                onclick="return confirm('Accepter cette candidature ?')">
                                            <i class="fas fa-check me-2"></i>Accepter
                                        </button>
                                    </form>
                                    
                                    <form method="POST" action="{{ route('dashboard.candidatures.update-statut', $candidature) }}" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="statut" value="refuse">
                                        <button type="submit" 
                                                class="btn btn-danger" 
                                                onclick="return confirm('Refuser cette candidature ?')">
                                            <i class="fas fa-times me-2"></i>Refuser
                                        </button>
                                    </form>
                                @elseif($candidature->statut === 'accepte')
                                    <form method="POST" action="{{ route('dashboard.candidatures.update-statut', $candidature) }}" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="statut" value="en_attente">
                                        <button type="submit" 
                                                class="btn btn-warning" 
                                                onclick="return confirm('Remettre en attente cette candidature ?')">
                                            <i class="fas fa-clock me-2"></i>Remettre en attente
                                        </button>
                                    </form>
                                @elseif($candidature->statut === 'refuse')
                                    <form method="POST" action="{{ route('dashboard.candidatures.update-statut', $candidature) }}" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="statut" value="en_attente">
                                        <button type="submit" 
                                                class="btn btn-warning" 
                                                onclick="return confirm('Remettre en attente cette candidature ?')">
                                            <i class="fas fa-clock me-2"></i>Remettre en attente
                                        </button>
                                    </form>
                                @endif

                                <!-- Supprimer -->
                                <form method="POST" action="{{ route('dashboard.candidatures.destroy', $candidature) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-outline-danger" 
                                            onclick="return confirm('Supprimer définitivement cette candidature ? Cette action est irréversible.')">
                                        <i class="fas fa-trash me-2"></i>Supprimer
                                    </button>
                                </form>

                                <!-- Retour -->
                                <a href="{{ route('dashboard.candidatures.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            `;        } else if (pdfExtensions.includes(extension.toLowerCase())) {
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
        isDragging = false;        modalDialog.style.transition = '';
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

.btn-group .btn {
    margin-right: 0;
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
