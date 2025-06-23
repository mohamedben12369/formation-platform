<!-- Modal pour afficher le PDF au centre -->
<div class="modal fade" id="viewPdfModal" tabindex="-1" aria-labelledby="viewPdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPdfModalLabel">Document de la formation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center" style="min-height:70vh;">
                <iframe id="pdfViewer" src="" width="90%" height="600px" style="border:none;"></iframe>
            </div>
        </div>
    </div>
</div>
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Gestion des Formations</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex gap-2 mb-3">
        <button class="btn btn-info flex-grow-1" data-bs-toggle="modal" data-bs-target="#addFormationModal">Ajouter une Formation</button>
        <a href="{{ route('dashboard.formations.statistiques') }}" class="btn btn-primary">
            <i class="fas fa-chart-bar"></i> Statistiques des Formations
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Date Début</th>
                    <th>Date Fin</th>
                    <th>Lieu</th>
                    <th>Prix Total</th>
                    <th>Durée Totale</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Thèmes</th>
                    <th>Formateurs</th>
                    <th>Compétences visées</th>
                    <th>Prérequis</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formations ?? [] as $formation)
                <tr>
                    <td>
                        @if($formation->image)
                            <img src="{{ asset($formation->image) }}" alt="Image de la formation" class="img-thumbnail" style="max-width: 100px;">
                        @endif
                    </td>
                    <td>{{ $formation->nom }}</td>
                    <td>{{ $formation->dateDebut }}</td>
                    <td>{{ $formation->dateFin }}</td>
                    <td>{{ $formation->lieu }}</td>
                    <td>{{ number_format($formation->prix_total, 2) }} DH</td>
                    <td>{{ $formation->duree_totale }} h</td>
                    <td>{{ $formation->typeFormation->nom ?? 'N/A' }}</td>
                    <td>{{ $formation->statutFormation->nom ?? 'N/A' }}</td>
                    <td>
                        @foreach($formation->themes as $theme)
                            <div class="theme-item mb-1">
                                <span class="badge bg-primary" data-bs-toggle="tooltip" 
                                      title="Prix: {{ number_format($theme->prix, 2) }} DH">
                                    {{ $theme->titre }}
                                </span>
                            </div>
                        @endforeach
                    </td>
                    <td>
                        @foreach($formation->formateurs as $formateur)
                            <div class="formateur-item mb-1">
                                <span class="badge bg-success">
                                    {{ $formateur->prenom }} {{ $formateur->nom }}
                                </span>
                            </div>
                        @endforeach
                        @if($formation->formateurs->isEmpty())
                            <span class="text-muted">Aucun formateur assigné</span>
                        @endif
                    </td>
                    <td>{{ $formation->competences_visees }}</td>
                    <td>{{ $formation->prerequis }}</td>
                    <td>
                        @if($formation->document_pdf)
                            <a href="#" onclick="openFormationPdf('{{ route('dashboard.formations.document', $formation->id) }}'); return false;" class="btn btn-secondary btn-sm">Voir PDF</a>
                        @else
                            <span class="text-muted">Aucun</span>
                        @endif
<div id="formationPdfModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000;">
    <div style="position: relative; width: 80%; height: 80%; margin: 5% auto; background: white; padding: 20px; border-radius: 5px;">
        <button onclick="closeFormationPdf()" style="position: absolute; right: 10px; top: 10px; background: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">Fermer</button>
        <iframe id="formationPdfFrame" style="width: 100%; height: 90%; border: none;" src=""></iframe>
    </div>
</div>
                    </td>
                    <td class="d-flex flex-wrap gap-1">
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editFormationModal{{ $formation->id }}">Modifier</button>
                        @if($formation->image)
                        <button class="btn btn-sm btn-info view-image-btn" data-image-url="{{ asset($formation->image) }}" data-bs-toggle="modal" data-bs-target="#viewImageModal">Voir Image</button>
                        @endif
                        <form action="{{ route('dashboard.formations.destroy', $formation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette formation ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal d'ajout Formation -->
<div class="modal fade" id="addFormationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une Formation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('dashboard.formations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>

                            <div class="mb-3">
                                <label for="themes" class="form-label">Thèmes</label>
                                <select class="form-control select2-themes" id="themes" name="themes[]" multiple required>
                                    @foreach($themes as $theme)
                                        <option value="{{ $theme->idtheme }}">
                                            {{ $theme->titre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="formateurs" class="form-label">Formateurs</label>
                                <select class="form-control select2-formateurs" id="formateurs" name="formateurs[]" multiple>
                                    @foreach($formateurs as $formateur)
                                        <option value="{{ $formateur->id }}">
                                            {{ $formateur->prenom }} {{ $formateur->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">
                                    Sélectionnez les formateurs qui donneront cette formation (optionnel).
                                </small>
                            </div>

                            <div class="mb-3">
                                <label for="dateDebut" class="form-label">Date de début</label>
                                <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
                            </div>
                            <div class="mb-3">
                                <label for="dateFin" class="form-label">Date de fin</label>
                                <input type="date" class="form-control" id="dateFin" name="dateFin" required>
                            </div>
                            <div class="mb-3">
                                <label for="lieu" class="form-label">Lieu</label>
                                <input type="text" class="form-control" id="lieu" name="lieu" required>
                            </div>
                            <div class="mb-3">
                                <label for="domaine_id" class="form-label">Domaine</label>
                                <select class="form-control" id="domaine_id" name="domaine_id">
                                    <option value="">Sélectionner un domaine (optionnel)</option>
                                    @foreach($domaines as $domaine)
                                        <option value="{{ $domaine->id }}">{{ $domaine->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nombre de participants</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nombre_ouvriers" class="form-label">Ouvriers</label>
                                        <input type="number" min="0" class="form-control" id="nombre_ouvriers" name="nombre_ouvriers" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nombre_encadrants" class="form-label">Encadrants</label>
                                        <input type="number" min="0" class="form-control" id="nombre_encadrants" name="nombre_encadrants" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nombre_cadres" class="form-label">Cadres</label>
                                        <input type="number" min="0" class="form-control" id="nombre_cadres" name="nombre_cadres" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="type_formation_id" class="form-label">Type de formation</label>
                                <select class="form-control" id="type_formation_id" name="type_formation_id" required>
                                    <option value="">Sélectionner un type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="statut_formation_id" class="form-label">Statut</label>
                                <select class="form-control" id="statut_formation_id" name="statut_formation_id" required>
                                    <option value="">Sélectionner un statut</option>
                                    @foreach($statuts as $statut)
                                        <option value="{{ $statut->id }}">{{ $statut->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="programme" class="form-label">Programme</label>
                                <textarea class="form-control" id="programme" name="programme" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="objectifs" class="form-label">Objectifs</label>
                                <textarea class="form-control" id="objectifs" name="objectifs" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="moyennes" class="form-label">Moyennes</label>
                                <input type="text" class="form-control" id="moyennes" name="moyennes" value="{{ old('moyennes') }}">
                                <small class="text-muted">Saisissez la moyenne de la formation (optionnel).</small>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small class="text-muted">Formats acceptés : JPEG, PNG, JPG, GIF. Taille max : 2MB</small>
                            </div>
                            <div class="mb-3">
                                <label for="document_pdf" class="form-label">Document PDF de la formation</label>
                                <input type="file" class="form-control" id="document_pdf" name="document_pdf" accept="application/pdf">
                                <small class="text-muted">Format accepté : PDF. Taille max : 5MB</small>
                            </div>
                            <div class="mb-3">
                                <label for="entreprise_id" class="form-label">Entreprise</label>
                                <select class="form-control" id="entreprise_id" name="entreprise_id">
                                    <option value="">Sélectionner une entreprise (optionnel)</option>
                                    @if(isset($entreprises))
                                        @foreach($entreprises as $entreprise)
                                            <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Modals d'édition Formation -->
@foreach($formations ?? [] as $formation)
<div class="modal fade" id="editFormationModal{{ $formation->id }}" tabindex="-1" aria-labelledby="editFormationModalLabel{{ $formation->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('dashboard.formations.update', $formation->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editFormationModalLabel{{ $formation->id }}">Modifier Formation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_nom{{ $formation->id }}" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="edit_nom{{ $formation->id }}" name="nom" value="{{ $formation->nom }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_dateDebut{{ $formation->id }}" class="form-label">Date de début</label>
                            <input type="date" class="form-control" id="edit_dateDebut{{ $formation->id }}" name="dateDebut" value="{{ $formation->dateDebut }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_dateFin{{ $formation->id }}" class="form-label">Date de fin</label>
                            <input type="date" class="form-control" id="edit_dateFin{{ $formation->id }}" name="dateFin" value="{{ $formation->dateFin }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_lieu{{ $formation->id }}" class="form-label">Lieu</label>
                            <input type="text" class="form-control" id="edit_lieu{{ $formation->id }}" name="lieu" value="{{ $formation->lieu }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Modalité field hidden as requested -->
                        <input type="hidden" id="edit_modalite{{ $formation->id }}" name="modalite" value="{{ $formation->modalite }}">
                        <div class="col-md-12 mb-3">
                            <label for="edit_nombrePlaces{{ $formation->id }}" class="form-label">Nombre de places</label>
                            <input type="number" class="form-control" id="edit_nombrePlaces{{ $formation->id }}" name="nombrePlaces" value="{{ $formation->nombrePlaces }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_prix{{ $formation->id }}" class="form-label">Prix</label>
                            <input type="number" step="0.01" class="form-control" id="edit_prix{{ $formation->id }}" name="prix" value="{{ $formation->prix }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_duree{{ $formation->id }}" class="form-label">Durée</label>
                            <input type="text" class="form-control" id="edit_duree{{ $formation->id }}" name="duree" value="{{ $formation->duree }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_type_formation_id{{ $formation->id }}" class="form-label">Type de formation</label>
                            <select class="form-control" id="edit_type_formation_id{{ $formation->id }}" name="type_formation_id" required>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ $formation->type_formation_id == $type->id ? 'selected' : '' }}>{{ $type->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_statut_formation_id{{ $formation->id }}" class="form-label">Statut</label>
                            <select class="form-control" id="edit_statut_formation_id{{ $formation->id }}" name="statut_formation_id" required>
                                @foreach($statuts as $statut)
                                    <option value="{{ $statut->id }}" {{ $formation->statut_formation_id == $statut->id ? 'selected' : '' }}>{{ $statut->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_domaine_select{{ $formation->id }}" class="form-label">Domaine</label>
                        <select class="form-control edit-domaine-select" id="edit_domaine_select{{ $formation->id }}" name="domaine_id" data-formation-id="{{ $formation->id }}" required>
                            <option value="">Sélectionner un domaine</option>
                            @foreach($domaines as $domaine)
                                <option value="{{ $domaine->id }}" {{ $formation->domaine_id == $domaine->id ? 'selected' : '' }}>{{ $domaine->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_sous_domaine_select{{ $formation->id }}" class="form-label">Sous-Domaine</label>
                        <select class="form-control edit-sous-domaine-select" id="edit_sous_domaine_select{{ $formation->id }}" name="sous_domaine_code" data-formation-id="{{ $formation->id }}" required>
                            <option value="">Sélectionner d'abord un domaine</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_themes{{ $formation->id }}" class="form-label">Thèmes</label>
                        <select class="form-control select2-themes" id="edit_themes{{ $formation->id }}" name="themes[]" multiple="multiple" style="width: 100%;">
                            <option value="">Sélectionner d'abord un sous-domaine</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_formateurs{{ $formation->id }}" class="form-label">Formateurs</label>
                        <select class="form-control select2-formateurs" id="edit_formateurs{{ $formation->id }}" name="formateurs[]" multiple style="width: 100%;">
                            @foreach($formateurs as $formateur)
                                <option value="{{ $formateur->id }}" 
                                    {{ $formation->formateurs->contains('id', $formateur->id) ? 'selected' : '' }}>
                                    {{ $formateur->prenom }} {{ $formateur->nom }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            Sélectionnez les formateurs qui donneront cette formation (optionnel).
                        </small>
                    </div>
                    <div class="mb-3">
                        <label for="edit_programme{{ $formation->id }}" class="form-label">Programme</label>
                        <textarea class="form-control" id="edit_programme{{ $formation->id }}" name="programme" rows="3" required>{{ $formation->programme }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_objectifs{{ $formation->id }}" class="form-label">Objectifs</label>
                        <textarea class="form-control" id="edit_objectifs{{ $formation->id }}" name="objectifs" rows="3" required>{{ $formation->objectifs }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_image{{ $formation->id }}" class="form-label">Image</label>
                        @if($formation->image)
                            <div class="mb-2">
                                <img src="{{ asset($formation->image) }}" alt="Image de la formation" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="edit_image{{ $formation->id }}" name="image" accept="image/*">
                        <small class="text-muted">Formats acceptés : JPEG, PNG, JPG, GIF. Taille max : 2MB</small>
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
@endforeach

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
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
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-sm {
        margin-right: 5px;
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
    }
    .form-text {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }
    /* Style pour le select */
    select.form-control {
        height: 38px;
        padding: 0.375rem 0.75rem;
    }
    /* Style pour la liste des thèmes sélectionnés */
    .selected-themes {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 10px;
        min-height: 50px;
    }
    .selected-theme {
        display: inline-block;
        background-color: #0d6efd;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        margin: 2px;
        font-size: 14px;
    }
    .btn-remove {
        background: none;
        border: none;
        color: white;
        margin-left: 5px;
        padding: 0 5px;
        cursor: pointer;
    }
    .btn-remove:hover {
        color: #ff6b6b;
    }
    .theme-item {
        margin-bottom: 4px;
    }
    
    .badge {
        font-size: 0.85em;
        padding: 5px 8px;
        cursor: help;
    }
    
    .tooltip {
        font-size: 12px;
    }

    .is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    /* Animation pour les notifications toast */
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        min-width: 250px;
        z-index: 9999;
    }

    /* Style for the theme select dropdown */
    .select2-container--bootstrap-5 {
        width: 100% !important;
    }

    /* Theme tags style */
    .theme-item {
        display: inline-block;
        margin: 2px;
    }

    /* Style for the image in table */
    .img-thumbnail {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
$(document).ready(function() {
    // Configuration de toastr
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "show",
        "hideMethod": "hide",
        "target": 'body',
        "preventOpenDuplicates": true
    };
    // Initialisation de Select2
    $('.select2-themes').select2({
        theme: 'bootstrap-5',
        placeholder: "Sélectionnez les thèmes",
        allowClear: true
    });

    $('.select2-formateurs').select2({
        theme: 'bootstrap-5',
        placeholder: "Sélectionnez les formateurs",
        allowClear: true
    });

    // Gestion de l'ajout d'un sous-domaine
    $('#saveSousDomaineBtn').on('click', function(e) {
        e.preventDefault();
        
        // Récupération des valeurs
        const code = $('#sous_domaine_code_new').val().trim();
        const description = $('#sous_domaine_description').val().trim();
        const domaineCode = $('#sous_domaine_domaine_code').val();

        // Vérification des champs requis
        if (!code) {
            toastr.error('Le code du sous-domaine est requis');
            $('#sous_domaine_code_new').focus();
            return;
        }
        if (!description) {
            toastr.error('La description du sous-domaine est requise');
            $('#sous_domaine_description').focus();
            return;
        }
        if (!domaineCode) {
            toastr.error('Veuillez sélectionner un domaine');
            return;
        }

        // Vérifier le format du code (maximum 10 caractères)
        if (code.length > 10) {
            toastr.error('Le code du sous-domaine ne doit pas dépasser 10 caractères');
            $('#sous_domaine_code_new').focus();
            return;
        }

        // Construction des données
        const sousDomaineData = {
            code: code,
            description: description,
            domaine_code: domaineCode
        };

        // Envoi des données au serveur
        $.ajax({
            url: '/api/sous-domaines',
            method: 'POST',
            data: JSON.stringify(sousDomaineData),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    // Fermer le modal
                    $('#addSousDomaineModal').modal('hide');
                    
                    // Réinitialiser le formulaire et actualiser les champs
                    $('#sousDomaineForm')[0].reset();

                    // Ajouter le nouveau sous-domaine à toutes les listes déroulantes concernées
                    const newOption = new Option(
                        `${response.sous_domaine.code} - ${response.sous_domaine.description}`, 
                        response.sous_domaine.code
                    );
                    
                    // Mettre à jour le select dans le formulaire principal
                    $('#sous_domaine_select').append(newOption).val(response.sous_domaine.code).trigger('change');
                    
                    // Mettre à jour tous les selects d'édition si présents
                    $('.sous-domaine-select').each(function() {
                        $(this).append(newOption.cloneNode(true));
                    });

                    toastr.success('Sous-domaine ajouté avec succès');
                } else {
                    toastr.error(response.message || 'Une erreur est survenue');
                }
            },
            error: function(xhr, status, error) {
                console.error('Erreur:', xhr.responseText);
                let errorMessage = 'Une erreur est survenue lors de l\'ajout du sous-domaine';
                
                // Effacer les anciennes erreurs
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    
                    // Si c'est une erreur de validation
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(field => {
                            const input = $(`#sous_domaine_code_new`);
                            if (field === 'code' && input.length) {
                                input.addClass('is-invalid');
                                input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                            }
                            const descInput = $(`#sous_domaine_description`);
                            if (field === 'description' && descInput.length) {
                                descInput.addClass('is-invalid');
                                descInput.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                            }
                            const domaineInput = $(`#sous_domaine_domaine_code`);
                            if (field === 'domaine_code' && domaineInput.length) {
                                domaineInput.addClass('is-invalid');
                                domaineInput.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                            }
                        });
                    }
                }
                
                toastr.error(errorMessage);
            }
        });
    });

    // Handle domain creation
    $('#saveDomaineBtn').on('click', function(e) {
        e.preventDefault();
        const domaineCode = $('#domaine_code').val();
        const domaineNom = $('#domaine_nom').val();

        if (!domaineCode || !domaineNom) {
            toastr.error('Tous les champs sont obligatoires');
            return;
        }

        $.ajax({
            url: '/api/domaines',
            method: 'POST',
            data: JSON.stringify({
                code: domaineCode,
                nom: domaineNom
            }),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Close the modal and reset form
                    $('#addDomaineModal').modal('hide');
                    $('#domaineForm')[0].reset();

                    // Add to all domain dropdowns
                    const newOption = new Option(response.domaine.nom, response.domaine.id);
                    $('.edit-domaine-select, #domaine_select').each(function() {
                        $(this).append(newOption.cloneNode(true));
                    });

                    // Select the new domain in the appropriate dropdown
                    if (activeParentModalId) {
                        const parentModal = activeParentModalId.includes('editFormationModal') ?
                            $(`#edit_domaine_select${activeParentModalId.replace('editFormationModal', '')}`) :
                            $('#domaine_select');
                        parentModal.val(response.domaine.id).trigger('change');
                    }

                    toastr.success('Domaine ajouté avec succès');
                } else {
                    toastr.error(response.message || 'Une erreur est survenue');
                }
            },
            error: function(xhr) {
                console.error('Erreur:', xhr.responseText);
                let errorMessage = 'Une erreur est survenue lors de l\'ajout du domaine';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                toastr.error(errorMessage);

                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(field => {
                        const input = $(`#domaine_${field}`);
                        if (input.length) {
                            input.addClass('is-invalid');
                            input.next('.invalid-feedback').remove();
                            input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                        }
                    });
                }
            }
        });
    });

    // Mise à jour des sous-domaines lors du changement de domaine
    $(document).on('change', '.edit-domaine-select, #domaine_select', function() {
        const domaineId = $(this).val();
        const formationId = $(this).data('formation-id');
        const targetSelect = formationId ? 
            $(`#edit_sous_domaine_select${formationId}`) : 
            $('#sous_domaine_select');

        targetSelect.empty().append('<option value="">Chargement...</option>');

        if (domaineId) {
            $.ajax({
                url: `/api/domaines/${domaineId}/sous-domaines`,
                method: 'GET',
                success: function(response) {
                    targetSelect.empty().append('<option value="">Sélectionner un sous-domaine</option>');
                    if (response && Array.isArray(response)) {
                        response.forEach(function(sousDomaine) {
                            targetSelect.append(new Option(
                                `${sousDomaine.code} - ${sousDomaine.description}`,
                                sousDomaine.code
                            ));
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors du chargement des sous-domaines:', error);
                    targetSelect.empty().append('<option value="">Erreur de chargement</option>');
                    toastr.error('Erreur lors du chargement des sous-domaines');
                }
            });
        } else {
            targetSelect.empty().append('<option value="">Sélectionner d\'abord un domaine</option>');
        }
    });

    // Update themes when sous-domaine changes
    $(document).on('change', '.edit-sous-domaine-select, #sous_domaine_select', function() {
        const sousDomaineCode = $(this).val();
        const formationId = $(this).data('formation-id');
        const targetSelect = formationId ? 
            $(`#edit_themes${formationId}`) : 
            $('#themes');

        targetSelect.empty().append('<option value="">Chargement...</option>');

        if (sousDomaineCode) {
            $.ajax({
                url: `/api/sous-domaines/${sousDomaineCode}/themes`,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                success: function(themes) {
                    targetSelect.empty();
                    
                    if (Array.isArray(themes) && themes.length > 0) {
                        targetSelect.append('<option value="">Sélectionner les thèmes</option>');
                        themes.forEach(function(theme) {
                            targetSelect.append(new Option(
                                `${theme.titre} (${parseFloat(theme.prix).toFixed(2)} DH)`,
                                theme.idtheme,
                                false,
                                false
                            )).trigger('change');
                        });
                    } else {
                        targetSelect.append('<option value="">Aucun thème disponible</option>');
                    }
                    
                    // Réinitialiser Select2
                    targetSelect.select2({
                        theme: 'bootstrap-5',
                        placeholder: "Sélectionnez les thèmes",
                        allowClear: true
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors du chargement des thèmes:', error);
                    targetSelect.empty().append('<option value="">Erreur de chargement</option>');
                    toastr.error('Erreur lors du chargement des thèmes');
                }
            });
        } else {
            targetSelect.empty().append('<option value="">Sélectionner d\'abord un sous-domaine</option>');
            targetSelect.trigger('change');
        }
    });
    // Stocker l'ID du modal parent
    $('.add-sous-domaine-btn').on('click', function() {
        activeParentModalId = $(this).data('parent-modal');
        const domaineId = activeParentModalId.includes('editFormationModal') ? 
            $(`#edit_domaine_select${activeParentModalId.replace('editFormationModal', '')}`).val() :
            $('#domaine_select').val();
        $('#sous_domaine_domaine_code').val(domaineId);
    });    // Function to load sous-domainesfor any select
    function loadSousDomaines(domaineId, targetSelect) {
        if (!domaineId) {
            targetSelect.html('<option value="">Sélectionner d\'abord un domaine</option>');
            return;
        }

        // Show loading state
        targetSelect.html('<option value="">Chargement...</option>');

        // Load sous-domaines from API
        $.get(`/api/domaines/${domaineId}/sous-domaines`, function(data) {
            targetSelect.html('<option value="">Sélectionner un sous-domaine</option>');
            data.forEach(function(sousDomaine) {
                targetSelect.append(new Option(
                    `${sousDomaine.code} - ${sousDomaine.description}`,
                    sousDomaine.code
                ));
            });

            // Trigger change to update any dependent elements
            targetSelect.trigger('change');
        }).fail(function() {
            targetSelect.html('<option value="">Erreur de chargement</option>');
        });
    }

    // Initialize select2 for themes
    $('.select2-themes').select2({
        theme: 'bootstrap-5',
        placeholder: 'Sélectionner des thèmes',
        allowClear: true
    });

    // Initialize select2 for formateurs
    $('.select2-formateurs').select2({
        theme: 'bootstrap-5',
        placeholder: 'Sélectionner des formateurs',
        allowClear: true
    });
});
</script>
@endpush
@endsection