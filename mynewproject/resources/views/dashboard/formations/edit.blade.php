@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Modifier la Formation</h5>
                    <a href="{{ route('dashboard.formations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif                    <form method="POST" action="{{ route('dashboard.formations.update', $formation->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Nom de la formation -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de la formation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom', $formation->nom) }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Informations de base -->
                        <div class="row">                            <div class="col-md-6 mb-3">
                                <label for="dateDebut" class="form-label">Date de début <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('dateDebut') is-invalid @enderror" 
                                       id="dateDebut" name="dateDebut" 
                                       value="{{ old('dateDebut', $formation->dateDebut ? $formation->dateDebut->format('Y-m-d') : '') }}" required>
                                @error('dateDebut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dateFin" class="form-label">Date de fin <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('dateFin') is-invalid @enderror" 
                                       id="dateFin" name="dateFin" 
                                       value="{{ old('dateFin', $formation->dateFin ? $formation->dateFin->format('Y-m-d') : '') }}" required>
                                @error('dateFin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="lieu" class="form-label">Lieu <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lieu') is-invalid @enderror" 
                                       id="lieu" name="lieu" 
                                       value="{{ old('lieu', $formation->lieu) }}" required>
                                @error('lieu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="DatedeCreation" class="form-label">Date de création</label>
                                <input type="date" class="form-control @error('DatedeCreation') is-invalid @enderror" 
                                       id="DatedeCreation" name="DatedeCreation" 
                                       value="{{ old('DatedeCreation', $formation->DatedeCreation ? $formation->DatedeCreation->format('Y-m-d') : '') }}">
                                @error('DatedeCreation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Effectifs -->
                        <h6 class="text-primary mb-3"><i class="fas fa-users me-2"></i>Effectifs cibles</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="nombre_ouvriers" class="form-label">Nombre d'ouvriers</label>
                                <input type="number" class="form-control @error('nombre_ouvriers') is-invalid @enderror" 
                                       id="nombre_ouvriers" name="nombre_ouvriers" 
                                       value="{{ old('nombre_ouvriers', $formation->nombre_ouvriers ?? 0) }}" min="0">
                                @error('nombre_ouvriers')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nombre_encadrants" class="form-label">Nombre d'encadrants</label>
                                <input type="number" class="form-control @error('nombre_encadrants') is-invalid @enderror" 
                                       id="nombre_encadrants" name="nombre_encadrants" 
                                       value="{{ old('nombre_encadrants', $formation->nombre_encadrants ?? 0) }}" min="0">
                                @error('nombre_encadrants')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="nombre_cadres" class="form-label">Nombre de cadres</label>
                                <input type="number" class="form-control @error('nombre_cadres') is-invalid @enderror" 
                                       id="nombre_cadres" name="nombre_cadres" 
                                       value="{{ old('nombre_cadres', $formation->nombre_cadres ?? 0) }}" min="0">
                                @error('nombre_cadres')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                            <div class="col-md-6">
                                <h5 class="mb-3 text-primary">Informations générales</h5>
                                
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom de la formation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $formation->nom) }}" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">                                        <div class="mb-3">
                                            <label for="dateDebut" class="form-label">Date de début <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="dateDebut" name="dateDebut" value="{{ old('dateDebut', $formation->dateDebut ? $formation->dateDebut->format('Y-m-d') : '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dateFin" class="form-label">Date de fin <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="dateFin" name="dateFin" value="{{ old('dateFin', $formation->dateFin ? $formation->dateFin->format('Y-m-d') : '') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="lieu" class="form-label">Lieu <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="lieu" name="lieu" value="{{ old('lieu', $formation->lieu) }}" required>
                                </div>                                <div class="row">
                                    <!-- Champ modalité masqué -->
                                    <input type="hidden" id="modalite" name="modalite" value="{{ old('modalite', $formation->modalite) }}">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="nombrePlaces" class="form-label">Nombre de places</label>
                                            <input type="number" class="form-control" id="nombrePlaces" name="nombrePlaces" value="{{ old('nombrePlaces', $formation->nombrePlaces) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="type_formation_id" class="form-label">Type de formation <span class="text-danger">*</span></label>
                                            <select class="form-control" id="type_formation_id" name="type_formation_id" required>
                                                <option value="">Sélectionner un type</option>                                                @foreach($typeFormations as $type)
                                                    <option value="{{ $type->id }}" {{ old('type_formation_id', $formation->type_formation_id) == $type->id ? 'selected' : '' }}>
                                                        {{ $type->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="statut_formation_id" class="form-label">Statut <span class="text-danger">*</span></label>
                                            <select class="form-control" id="statut_formation_id" name="statut_formation_id" required>
                                                <option value="">Sélectionner un statut</option>
                                                @foreach($statutFormations as $statut)
                                                    <option value="{{ $statut->id }}" {{ old('statut_formation_id', $formation->statut_formation_id) == $statut->id ? 'selected' : '' }}>
                                                        {{ $statut->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="entreprise_id" class="form-label">Entreprise</label>
                                    <select class="form-control" id="entreprise_id" name="entreprise_id">
                                        <option value="">Sélectionner une entreprise (optionnel)</option>
                                        @foreach($entreprises as $entreprise)
                                            <option value="{{ $entreprise->id }}" {{ old('entreprise_id', $formation->entreprise_id) == $entreprise->id ? 'selected' : '' }}>
                                                {{ $entreprise->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Affichage des calculs actuels -->
                                <div class="mb-3">
                                    <div class="alert alert-info">
                                        <strong>Valeurs calculées actuelles :</strong><br>
                                        Prix total : {{ number_format($formation->prix_total, 2) }} DH<br>
                                        Durée totale : {{ $formation->duree_totale }} heures
                                    </div>
                                </div>
                            </div>

                            <!-- Participants et contenus -->
                            <div class="col-md-6">
                                <h5 class="mb-3 text-primary">Participants</h5>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="nombre_ouvriers" class="form-label">Ouvriers</label>
                                            <input type="number" min="0" class="form-control" id="nombre_ouvriers" name="nombre_ouvriers" value="{{ old('nombre_ouvriers', $formation->nombre_ouvriers ?? 0) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="nombre_encadrants" class="form-label">Encadrants</label>
                                            <input type="number" min="0" class="form-control" id="nombre_encadrants" name="nombre_encadrants" value="{{ old('nombre_encadrants', $formation->nombre_encadrants ?? 0) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="nombre_cadres" class="form-label">Cadres</label>
                                            <input type="number" min="0" class="form-control" id="nombre_cadres" name="nombre_cadres" value="{{ old('nombre_cadres', $formation->nombre_cadres ?? 0) }}">
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mb-3 text-primary mt-4">Thèmes et Formateurs</h5>
                                
                                <div class="mb-3">
                                    <label for="themes" class="form-label">Thèmes <span class="text-danger">*</span></label>
                                    <select class="form-control select2-themes" id="themes" name="themes[]" multiple required>
                                        @foreach($themeFormations as $theme)
                                            <option value="{{ $theme->idtheme }}" 
                                                {{ $formation->themes->contains('idtheme', $theme->idtheme) ? 'selected' : '' }}>
                                                {{ $theme->titre }} ({{ number_format($theme->prix, 2) }} DH - {{ $theme->duree }}h)
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Les prix et durées seront recalculés automatiquement.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="formateurs" class="form-label">Formateurs</label>
                                    <select class="form-control select2-formateurs" id="formateurs" name="formateurs[]" multiple>
                                        @foreach($formateurs as $formateur)
                                            <option value="{{ $formateur->id }}" 
                                                {{ $formation->formateurs->contains('id', $formateur->id) ? 'selected' : '' }}>
                                                {{ $formateur->prenom }} {{ $formateur->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Sélectionnez les formateurs qui donneront cette formation.</small>
                                </div>

                                <h5 class="mb-3 text-primary mt-4">Contenu</h5>
                                
                                <div class="mb-3">
                                    <label for="programme" class="form-label">Programme <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="programme" name="programme" rows="3" required>{{ old('programme', $formation->programme) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="objectifs" class="form-label">Objectifs <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="objectifs" name="objectifs" rows="3" required>{{ old('objectifs', $formation->objectifs) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="moyennes" class="form-label">Moyennes</label>
                                    <input type="text" class="form-control" id="moyennes" name="moyennes" value="{{ old('moyennes', $formation->moyennes) }}">
                                    <small class="text-muted">Saisissez la moyenne de la formation (optionnel).</small>
                                </div>
                            </div>
                        </div>

                        <!-- Fichiers -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="mb-3 text-primary">Fichiers</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            @if($formation->image)
                                                <div class="mb-2">
                                                    <img src="{{ asset($formation->image) }}" alt="Image actuelle" class="img-thumbnail" style="max-height: 150px;">
                                                    <p class="text-muted small">Image actuelle</p>
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                            <small class="text-muted">Formats acceptés : JPEG, PNG, JPG, GIF. Taille max : 2MB. Laissez vide pour conserver l'image actuelle.</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="document_pdf" class="form-label">Document PDF</label>
                                            @if($formation->document_pdf)
                                                <div class="mb-2">
                                                    <a href="{{ route('dashboard.formations.document', $formation->id) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-file-pdf"></i> Voir le PDF actuel
                                                    </a>
                                                    <p class="text-muted small">Document PDF actuel</p>
                                                </div>
                                            @endif
                                            <input type="file" class="form-control" id="document_pdf" name="document_pdf" accept="application/pdf">
                                            <small class="text-muted">Format accepté : PDF. Taille max : 5MB. Laissez vide pour conserver le document actuel.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('dashboard.formations.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Annuler
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Mettre à jour la formation
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>    </div>
</div>
@endsection
