@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gérer les Établissements</h1>
    <p>Ajoutez, modifiez ou supprimez les établissements.</p>

    <!-- Bouton pour ouvrir la modale d'ajout -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEtablissementModal">
        Ajouter un établissement
    </button>

    <!-- Affichage des erreurs de validation -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Modale d'ajout d'établissement -->
    <div class="modal fade" id="addEtablissementModal" tabindex="-1" aria-labelledby="addEtablissementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEtablissementModalLabel">Ajouter un établissement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <form method="POST" action="{{ route('dashboard.etablissements.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="nom" class="form-label">
                                <i class="fas fa-university me-2"></i>
                                Nom de l'établissement *
                            </label>
                            <input type="text" name="nom" id="nom" 
                                   class="form-control @error('nom') is-invalid @enderror" 
                                   placeholder="Ex: Université Mohammed V..."
                                   minlength="3" maxlength="255"
                                   value="{{ old('nom') }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="logo" class="form-label">
                                <i class="fas fa-image me-2"></i>
                                Logo de l'établissement
                            </label>
                            <input type="file" name="logo" id="logo" 
                                   class="form-control @error('logo') is-invalid @enderror" 
                                   accept="image/jpeg,image/png,image/gif,image/webp">
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Formats acceptés : JPG, PNG, GIF, WebP. Taille maximale : 2MB
                            </small>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="pays" class="form-label">
                                        <i class="fas fa-flag me-2"></i>
                                        Pays *
                                    </label>
                                    <input type="text" name="pays" id="pays" 
                                           class="form-control @error('pays') is-invalid @enderror" 
                                           placeholder="Ex: Maroc, France..."
                                           minlength="2" maxlength="100"
                                           value="{{ old('pays') }}" required>
                                    @error('pays')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="ville" class="form-label">
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        Ville *
                                    </label>
                                    <input type="text" name="ville" id="ville" 
                                           class="form-control @error('ville') is-invalid @enderror" 
                                           placeholder="Ex: Rabat, Paris..."
                                           minlength="2" maxlength="100"
                                           value="{{ old('ville') }}" required>
                                    @error('ville')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="telephone" class="form-label">
                                <i class="fas fa-phone me-2"></i>
                                Téléphone *
                            </label>
                            <input type="tel" name="telephone" id="telephone" 
                                   class="form-control @error('telephone') is-invalid @enderror" 
                                   placeholder="Ex: +212 5 37 77 18 34"
                                   pattern="[+]?[0-9\s\-\(\)]{8,20}"
                                   maxlength="20"
                                   value="{{ old('telephone') }}" required>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Format international recommandé (8-20 caractères)
                            </small>
                            @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="lien_localisation" class="form-label">
                                <i class="fas fa-map me-2"></i>
                                Lien de localisation *
                            </label>
                            <input type="url" name="lien_localisation" id="lien_localisation" 
                                   class="form-control @error('lien_localisation') is-invalid @enderror" 
                                   placeholder="https://www.google.com/maps/place/..."
                                   value="{{ old('lien_localisation') }}" required>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Collez ici le lien Google Maps ou autre service de cartographie
                            </small>
                            @error('lien_localisation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

    <!-- Liste des établissements -->
    <h2 class="mt-4">Établissements</h2>
    @if($etablissements->isEmpty())
        <p class="text-muted">Aucun établissement trouvé. Ajoutez-en un ci-dessus !</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Ville</th>
                        <th>Pays</th>
                        <th>Téléphone</th>
                        <th>Localisation</th>
                        <th>Date de création</th>
                        <th>Dernière modification</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etablissements as $etablissement)
                        <tr>
                            <td>
                                @if($etablissement->logo)
                                    <img src="{{ asset('storage/' . $etablissement->logo) }}" alt="Logo de {{ $etablissement->nom }}" class="logo-preview img-thumbnail" style="max-width: 50px; max-height: 50px; object-fit: contain;">
                                @else
                                    <span class="text-muted no-logo">Pas de logo</span>
                                @endif
                            </td>
                            <td>{{ $etablissement->id }}</td>
                            <td>{{ $etablissement->nom }}</td>
                            <td>{{ $etablissement->ville }}</td>
                            <td>{{ $etablissement->pays }}</td>
                            <td>{{ $etablissement->telephone }}</td>
                            <td>
                                @if($etablissement->lien_localisation)
                                    <a href="{{ $etablissement->lien_localisation }}" target="_blank" class="btn btn-info btn-sm">
                                        <i class="fas fa-map-marker-alt"></i> Voir sur la carte
                                    </a>
                                @else
                                    <span class="text-muted">Non spécifié</span>
                                @endif
                            </td>
                            <td>{{ $etablissement->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $etablissement->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group-vertical d-grid gap-2">
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $etablissement->id }}" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    @if($etablissement->logo)
                                    <button class="btn btn-info btn-sm view-image-btn" data-image-url="{{ asset('storage/' . $etablissement->logo) }}" data-bs-toggle="modal" data-bs-target="#viewImageModal" title="Voir Logo">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('dashboard.etablissements.destroy', $etablissement->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet établissement ?')" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal de modification -->
                        <div class="modal fade" id="editModal{{ $etablissement->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $etablissement->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('dashboard.etablissements.update', $etablissement->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $etablissement->id }}">Modifier l'établissement</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label for="edit_nom{{ $etablissement->id }}" class="form-label">
                                                    <i class="fas fa-university me-2"></i>
                                                    Nom *
                                                </label>
                                                <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                                       id="edit_nom{{ $etablissement->id }}" name="nom" 
                                                       value="{{ old('nom', $etablissement->nom) }}" 
                                                       minlength="3" maxlength="255"
                                                       placeholder="Ex: Université Mohammed V..." required>
                                                @error('nom')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="edit_pays{{ $etablissement->id }}" class="form-label">
                                                            <i class="fas fa-flag me-2"></i>
                                                            Pays *
                                                        </label>
                                                        <input type="text" class="form-control @error('pays') is-invalid @enderror" 
                                                               id="edit_pays{{ $etablissement->id }}" name="pays" 
                                                               value="{{ old('pays', $etablissement->pays) }}" 
                                                               minlength="2" maxlength="100"
                                                               placeholder="Ex: Maroc, France..." required>
                                                        @error('pays')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="edit_ville{{ $etablissement->id }}" class="form-label">
                                                            <i class="fas fa-map-marker-alt me-2"></i>
                                                            Ville *
                                                        </label>
                                                        <input type="text" class="form-control @error('ville') is-invalid @enderror" 
                                                               id="edit_ville{{ $etablissement->id }}" name="ville" 
                                                               value="{{ old('ville', $etablissement->ville) }}" 
                                                               minlength="2" maxlength="100"
                                                               placeholder="Ex: Rabat, Paris..." required>
                                                        @error('ville')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="edit_telephone{{ $etablissement->id }}" class="form-label">
                                                    <i class="fas fa-phone me-2"></i>
                                                    Téléphone *
                                                </label>
                                                <input type="tel" class="form-control @error('telephone') is-invalid @enderror" 
                                                       id="edit_telephone{{ $etablissement->id }}" name="telephone" 
                                                       value="{{ old('telephone', $etablissement->telephone) }}" 
                                                       pattern="[+]?[0-9\s\-\(\)]{8,20}"
                                                       maxlength="20"
                                                       placeholder="Ex: +212 5 37 77 18 34" required>
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    Format international recommandé (8-20 caractères)
                                                </small>
                                                @error('telephone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="edit_lien_localisation{{ $etablissement->id }}" class="form-label">
                                                    <i class="fas fa-map me-2"></i>
                                                    Lien de localisation *
                                                </label>
                                                <input type="url" class="form-control @error('lien_localisation') is-invalid @enderror" 
                                                       id="edit_lien_localisation{{ $etablissement->id }}" name="lien_localisation" 
                                                       value="{{ old('lien_localisation', $etablissement->lien_localisation) }}" 
                                                       placeholder="https://www.google.com/maps/place/..." required>
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    Collez ici le lien Google Maps ou autre service de cartographie
                                                </small>
                                                @error('lien_localisation')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group mb-3">
                                                <label for="edit_logo{{ $etablissement->id }}" class="form-label">
                                                    <i class="fas fa-image me-2"></i>
                                                    Logo {{ $etablissement->logo ? '(changer)' : '' }}
                                                </label>
                                                <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                                       id="edit_logo{{ $etablissement->id }}" name="logo" 
                                                       accept="image/jpeg,image/png,image/jpg,image/gif">
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    Formats acceptés : JPEG, PNG, JPG, GIF. Taille max : 2MB
                                                </small>
                                                @error('logo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            @if($etablissement->logo)
                                                <div class="form-group mb-3">
                                                    <label class="form-label">
                                                        <i class="fas fa-image me-2"></i>
                                                        Logo actuel
                                                    </label>
                                                    <div class="current-logo">
                                                        <img src="{{ asset('storage/' . $etablissement->logo) }}" 
                                                             alt="Logo actuel" 
                                                             class="img-thumbnail" 
                                                             style="max-width: 100px; max-height: 100px;">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Modal pour voir l'image -->
    <div class="modal fade" id="viewImageModal" tabindex="-1" aria-labelledby="viewImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewImageModalLabel">
                        <i class="fas fa-image me-2"></i>
                        Aperçu du logo
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="logo-container">
                        <img id="modalLogo" src="" alt="Logo de l'établissement" class="logo-full">
                    </div>
                    <p id="logoEtabName" class="text-muted"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="tel"],
        input[type="url"],
        input[type="file"],
        select {
            display: block;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: #f8f9fa;
        }
        .btn-group {
            display: flex;
            gap: 5px;
        }
        .btn-warning {
            background-color: #ffc107;
            border: none;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-info {
            background-color: #17a2b8;
            color: white;
            border: none;
        }
        .btn-info:hover {
            background-color: #138496;
            color: white;
        }
        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
        .logo-preview {
            width: 50px;
            height: 50px;
            object-fit: contain;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 2px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .no-logo {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 1px dashed #dee2e6;
            border-radius: 4px;
            font-size: 0.75rem;
            color: #6c757d;
        }
        .current-logo {
            text-align: center;
            margin: 10px 0;
        }
        .current-logo img {
            max-width: 100px;
            max-height: 100px;
            object-fit: contain;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 2px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .logo-full {
            max-width: 100%;
            height: auto;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .d-flex {
            display: flex;
        }
        .align-items-center {
            align-items: center;
        }
        .gap-2 {
            gap: 0.5rem;
        }
        .text-center {
            text-align: center;
        }
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }
        @media (min-width: 576px) {
            .modal-dialog-centered {
                min-height: calc(100% - 3.5rem);
            }
        }
        .modal-lg {
            max-width: 800px;
        }
        .modal-body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .modal-content {
            border-radius: 12px;
            overflow: hidden;
        }
        .modal-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
        }
        .modal-dialog {
            max-width: 800px;
        }
        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            border: 1px solid rgba(0,0,0,.2);
            border-radius: 0.3rem;
            outline: 0;
        }
        .modal-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            border-top-left-radius: 0.3rem;
            border-top-right-radius: 0.3rem;
        }
        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1rem;
        }
        .modal-body img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        #modalLogo {
            max-width: 100%;
            max-height: 400px;
            object-fit: contain;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .logo-container {
            width: 100%;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
        }
        #logoEtabName {
            font-size: 1.1rem;
            color: #495057;
            margin-top: 15px;
        }
    </style>

    @push('scripts')
    <script>
        // Gestion du modal de visualisation des images
        document.addEventListener('DOMContentLoaded', function() {
            // Gérer les boutons "Voir Logo"
            const viewImageButtons = document.querySelectorAll('.view-image-btn');
            const modalLogo = document.getElementById('modalLogo');
            const logoEtabName = document.getElementById('logoEtabName');
            
            viewImageButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const imageUrl = this.getAttribute('data-image-url');
                    const etablissementName = this.closest('tr').querySelector('td:nth-child(3)').textContent.trim();
                    
                    if (modalLogo && imageUrl) {
                        modalLogo.src = imageUrl;
                        modalLogo.alt = `Logo de ${etablissementName}`;
                    }
                    
                    if (logoEtabName && etablissementName) {
                        logoEtabName.textContent = `Logo de ${etablissementName}`;
                    }
                });
            });
            
            // Nettoyer l'image quand le modal se ferme
            const viewImageModal = document.getElementById('viewImageModal');
            if (viewImageModal) {
                viewImageModal.addEventListener('hidden.bs.modal', function() {
                    if (modalLogo) {
                        modalLogo.src = '';
                    }
                    if (logoEtabName) {
                        logoEtabName.textContent = '';
                    }
                });
            }
        });
    </script>
    @endpush
</div>
@endsection