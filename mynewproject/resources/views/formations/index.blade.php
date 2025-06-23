<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Formations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('layouts.header')

    <div class="container mt-5">
        <h2 class="mb-4">Gestion des Formations</h2>

        <!-- Bouton pour ouvrir le modal d'ajout -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addFormationModal">
            Ajouter une Formation
        </button>

        <!-- Modal d'ajout -->
        <div class="modal fade" id="addFormationModal" tabindex="-1" aria-labelledby="addFormationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" action="{{ route('formations.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addFormationModalLabel">Ajouter une Formation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dateDebut" class="form-label">Date de début</label>
                                    <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dateFin" class="form-label">Date de fin</label>
                                    <input type="date" class="form-control" id="dateFin" name="dateFin" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="lieu" class="form-label">Lieu</label>
                                    <input type="text" class="form-control" id="lieu" name="lieu" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="modalite" class="form-label">Modalité</label>
                                    <input type="text" class="form-control" id="modalite" name="modalite" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombrePlaces" class="form-label">Nombre de places</label>
                                    <input type="number" class="form-control" id="nombrePlaces" name="nombrePlaces" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prix" class="form-label">Prix</label>
                                    <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="duree" class="form-label">Durée</label>
                                    <input type="text" class="form-control" id="duree" name="duree" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type_formation_id" class="form-label">Type de formation</label>
                                    <select class="form-control" id="type_formation_id" name="type_formation_id" required>
                                        <option value="">Sélectionner un type</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="prerequis" class="form-label">Prérequis</label>
                                <textarea class="form-control" id="prerequis" name="prerequis" rows="3" required></textarea>
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
                                <label for="statut_formation_id" class="form-label">Statut</label>
                                <select class="form-control" id="statut_formation_id" name="statut_formation_id" required>
                                    <option value="">Sélectionner un statut</option>
                                    @foreach($statuts as $statut)
                                        <option value="{{ $statut->id }}">{{ $statut->nom }}</option>
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

        <!-- Tableau des formations -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Lieu</th>
                        <th>Modalité</th>
                        <th>Places</th>
                        <th>Prix</th>
                        <th>Durée</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formations as $formation)
                    <tr>                        <td>{{ $formation->dateDebut }}</td>
                        <td>{{ $formation->dateFin }}</td>
                        <td>{{ $formation->lieu }}</td>
                        <td>{{ $formation->modalite }}</td>
                        <td>{{ $formation->nombrePlaces }}</td>
                        <td>{{ number_format($formation->prix_total, 2) }} €</td>
                        <td>{{ $formation->duree_totale }} h</td>
                        <td>{{ $formation->typeFormation->nom }}</td>
                        <td>{{ $formation->statutFormation->nom }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editFormationModal{{ $formation->id }}">
                                Modifier
                            </button>
                            <form action="{{ route('formations.destroy', $formation->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?')">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal d'édition -->
                    <div class="modal fade" id="editFormationModal{{ $formation->id }}" tabindex="-1" aria-labelledby="editFormationModalLabel{{ $formation->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('formations.update', $formation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editFormationModalLabel{{ $formation->id }}">Modifier la Formation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_dateDebut{{ $formation->id }}" class="form-label">Date de début</label>
                                                <input type="date" class="form-control" id="edit_dateDebut{{ $formation->id }}" name="dateDebut" value="{{ $formation->dateDebut }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_dateFin{{ $formation->id }}" class="form-label">Date de fin</label>
                                                <input type="date" class="form-control" id="edit_dateFin{{ $formation->id }}" name="dateFin" value="{{ $formation->dateFin }}" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_lieu{{ $formation->id }}" class="form-label">Lieu</label>
                                                <input type="text" class="form-control" id="edit_lieu{{ $formation->id }}" name="lieu" value="{{ $formation->lieu }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_modalite{{ $formation->id }}" class="form-label">Modalité</label>
                                                <input type="text" class="form-control" id="edit_modalite{{ $formation->id }}" name="modalite" value="{{ $formation->modalite }}" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_nombrePlaces{{ $formation->id }}" class="form-label">Nombre de places</label>
                                                <input type="number" class="form-control" id="edit_nombrePlaces{{ $formation->id }}" name="nombrePlaces" value="{{ $formation->nombrePlaces }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_prix{{ $formation->id }}" class="form-label">Prix</label>
                                                <input type="number" step="0.01" class="form-control" id="edit_prix{{ $formation->id }}" name="prix" value="{{ $formation->prix }}" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_duree{{ $formation->id }}" class="form-label">Durée</label>
                                                <input type="text" class="form-control" id="edit_duree{{ $formation->id }}" name="duree" value="{{ $formation->duree }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_type_formation_id{{ $formation->id }}" class="form-label">Type de formation</label>
                                                <select class="form-control" id="edit_type_formation_id{{ $formation->id }}" name="type_formation_id" required>
                                                    @foreach($types as $type)
                                                        <option value="{{ $type->id }}" {{ $formation->type_formation_id == $type->id ? 'selected' : '' }}>
                                                            {{ $type->nom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_prerequis{{ $formation->id }}" class="form-label">Prérequis</label>
                                            <textarea class="form-control" id="edit_prerequis{{ $formation->id }}" name="prerequis" rows="3" required>{{ $formation->prerequis }}</textarea>
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
                                            <label for="edit_statut_formation_id{{ $formation->id }}" class="form-label">Statut</label>
                                            <select class="form-control" id="edit_statut_formation_id{{ $formation->id }}" name="statut_formation_id" required>
                                                @foreach($statuts as $statut)
                                                    <option value="{{ $statut->id }}" {{ $formation->statut_formation_id == $statut->id ? 'selected' : '' }}>
                                                        {{ $statut->nom }}
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 