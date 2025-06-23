@extends('dashboard')
@section('dashboard-section')
<div class="container mt-4">
    <h2>Ajouter un thème de formation</h2>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form method="POST" action="{{ route('dashboard.theme-formations.store') }}" id="themeForm">
        @csrf
        <div class="mb-3">
            <label for="titre" class="form-label">Titre <span class="text-danger">*</span></label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
        </div>
        
        <!-- Sous Domaine Selection avec recherche -->
        <div class="mb-3">
            <label for="sous_domaine_code" class="form-label">Sous-Domaine <span class="text-danger">*</span></label>
            <input type="text" class="form-control mb-2" id="search_sous_domaine" placeholder="Rechercher un sous-domaine...">
            <select name="sous_domaine_code" id="sous_domaine_code" class="form-control" required size="5">
                <option value="">Sélectionner un sous-domaine</option>
                @foreach($sous_domaines as $sousDomaine)
                    <option value="{{ $sousDomaine->code }}" {{ old('sous_domaine_code') == $sousDomaine->code ? 'selected' : '' }}>
                        {{ $sousDomaine->code }} - {{ $sousDomaine->description }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <!-- Axe Selection -->
        <div class="mb-3">
            <label for="axes_id" class="form-label">Axe <span class="text-danger">*</span></label>
            <select name="axes_id" id="axes_id" class="form-control" required>
                <option value="">Sélectionner un axe</option>
                @foreach($axes as $axe)
                    <option value="{{ $axe->id }}" {{ old('axes_id') == $axe->id ? 'selected' : '' }}>
                        {{ $axe->nom }}
                    </option>
                @endforeach
            </select>
        </div>
            <label>Axe</label>        
        <div class="mb-3">
            <label for="prix" class="form-label">Prix (DH)</label>
            <input type="number" step="0.01" min="0" class="form-control" id="prix" name="prix" value="{{ old('prix') }}">
        </div>

        <div class="mb-3">
            <label for="duree" class="form-label">Durée (heures)</label>
            <input type="number" min="1" class="form-control" id="duree" name="duree" value="{{ old('duree') }}">
        </div>

        <div class="mb-3">
            <label for="prerequis" class="form-label">Prérequis</label>
            <textarea class="form-control" id="prerequis" name="prerequis" rows="3">{{ old('prerequis') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="competence_visees" class="form-label">Compétences visées</label>
            <textarea class="form-control" id="competence_visees" name="competence_visees" rows="3">{{ old('competence_visees') }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-success">Ajouter</button>
        <a href="{{ route('dashboard.theme-formations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Recherche dans les sous-domaines
    const searchInput = document.getElementById('search_sous_domaine');
    const sousDomaineSelect = document.getElementById('sous_domaine_code');
    
    if (searchInput && sousDomaineSelect) {
        // Sauvegarder toutes les options originales
        const originalOptions = Array.from(sousDomaineSelect.options);
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            // Vider le select
            sousDomaineSelect.innerHTML = '';
            
            // Filtrer et afficher les options correspondantes
            originalOptions.forEach(option => {
                const text = option.textContent.toLowerCase();
                const value = option.value.toLowerCase();
                
                if (text.includes(searchTerm) || value.includes(searchTerm) || searchTerm === '') {
                    sousDomaineSelect.appendChild(option.cloneNode(true));
                }
            });
            
            // Si aucun résultat, afficher un message
            if (sousDomaineSelect.options.length === 0) {
                const noResult = document.createElement('option');
                noResult.textContent = 'Aucun résultat trouvé';
                noResult.value = '';
                noResult.disabled = true;
                sousDomaineSelect.appendChild(noResult);
            }
        });
        
        // Au clic sur le select, vider la recherche pour tout voir
        sousDomaineSelect.addEventListener('focus', function() {
            if (searchInput.value === '') {
                // Réafficher toutes les options
                sousDomaineSelect.innerHTML = '';
                originalOptions.forEach(option => {
                    sousDomaineSelect.appendChild(option.cloneNode(true));
                });
            }
        });
    }
});
</script>
@endpush
@endsection
                
                fetch(url)
                    .then(response => {
                        console.log('Réponse reçue:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Données sous-domaines reçues:', data);
                        sousDomaineSelect.innerHTML = '<option value="">Sélectionner un sous-domaine</option>';
                        
                        if (data && data.length > 0) {
                            data.forEach(sousDomaine => {
                                const option = document.createElement('option');
                                option.value = sousDomaine.code;
                                option.textContent = `${sousDomaine.code} - ${sousDomaine.description}`;
                                sousDomaineSelect.appendChild(option);
                            });
                        } else {
                            sousDomaineSelect.innerHTML = '<option value="">Aucun sous-domaine disponible</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des sous-domaines:', error);
                        sousDomaineSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                    });
            } else {
                sousDomaineSelect.innerHTML = '<option value="">Sélectionner d\'abord un domaine</option>';
            }
        });        // Charger les axes en fonction du sous-domaine sélectionné
        sousDomaineSelect.addEventListener('change', function() {
            const sousDomaineCode = this.value;
            console.log('Sous-domaine sélectionné:', sousDomaineCode);
            
            axeSelect.innerHTML = '<option value="">Chargement...</option>';
              if (sousDomaineCode) {
                const url = `/api/test-axes/sous-domaine/${sousDomaineCode}`;
                console.log('Appel API axes:', url);
                
                fetch(url)
                    .then(response => {
                        console.log('Réponse axes reçue:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Données axes reçues:', data);
                        axeSelect.innerHTML = '<option value="">Sélectionner un axe</option>';
                        
                        if (data && data.length > 0) {
                            data.forEach(axe => {
                                const option = document.createElement('option');
                                option.value = axe.id;
                                option.textContent = axe.nom;
                                axeSelect.appendChild(option);
                            });
                        } else {
                            axeSelect.innerHTML = '<option value="">Aucun axe disponible</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors du chargement des axes:', error);
                        axeSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                    });
            } else {
                axeSelect.innerHTML = '<option value="">Sélectionner d\'abord un sous-domaine</option>';
            }
        });
        
        // Ajout d'un nouveau domaine
        const saveDomaineBtn = document.getElementById('saveDomaineBtn');
        const domaineModal = new bootstrap.Modal(document.getElementById('addDomaineModal'));
        
        saveDomaineBtn.addEventListener('click', function() {
            const domaineNom = document.getElementById('domaine_nom').value;
            
            if (!domaineNom) {
                alert('Veuillez saisir un nom de domaine');
                return;
            }
            
            // Envoi des données au serveur
            fetch('/api/domaines', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ nom: domaineNom })
            })
            .then(response => response.json())
            .then(data => {
                // Ajouter le nouveau domaine à la liste déroulante
                const option = document.createElement('option');
                option.value = data.id;
                option.textContent = data.nom;
                domaineSelect.appendChild(option);
                
                // Sélectionner le nouveau domaine
                domaineSelect.value = data.id;
                
                // Déclencher l'événement change pour charger les sous-domaines
                const event = new Event('change');
                domaineSelect.dispatchEvent(event);
                
                // Fermer le modal et réinitialiser le formulaire
                domaineModal.hide();
                document.getElementById('domaineForm').reset();
            })
            .catch(error => {
                console.error('Erreur lors de l\'ajout du domaine:', error);
                alert('Une erreur est survenue lors de l\'ajout du domaine');
            });
        });
          // Gestion du modal de sous-domaine
        const saveSousDomaineBtn = document.getElementById('saveSousDomaineBtn');
        const sousDomaineModal = new bootstrap.Modal(document.getElementById('addSousDomaineModal'));
        const addSousDomaineModalEl = document.getElementById('addSousDomaineModal');

        // Mise à jour du domaine_code quand le modal s'ouvre
        addSousDomaineModalEl.addEventListener('show.bs.modal', function() {
            const selectedDomaineId = domaineSelect.value;
            if (!selectedDomaineId) {
                alert('Veuillez d\'abord sélectionner un domaine');
                return false;
            }
            document.getElementById('sous_domaine_domaine_code').value = selectedDomaineId;
        });
        
        // Mettre à jour le domaine_code caché lors de l'ouverture du modal
        document.getElementById('addSousDomaineModal').addEventListener('show.bs.modal', function() {
            document.getElementById('sous_domaine_domaine_code').value = domaineSelect.value;
        });
          saveSousDomaineBtn.addEventListener('click', function() {
            // Récupérer et nettoyer les valeurs
            const code = document.getElementById('sous_domaine_code').value.trim().toUpperCase();
            const description = document.getElementById('sous_domaine_description').value.trim();
            const domaine_code = document.getElementById('sous_domaine_domaine_code').value;
            
            // Validation côté client renforcée
            let errors = [];
            
            if (!code) {
                errors.push('Le code du sous-domaine est requis');
            } else if (code.length > 10) {
                errors.push('Le code ne doit pas dépasser 10 caractères');
            } else if (!/^[A-Z0-9\-]+$/.test(code)) {
                errors.push('Le code doit contenir uniquement des majuscules, des chiffres et des tirets');
            }
            
            if (!description) {
                errors.push('La description est requise');
            }
            
            if (!domaine_code) {
                errors.push('Veuillez d\'abord sélectionner un domaine');
            }
            
            if (errors.length > 0) {
                alert(errors.join('\n'));
                return;
            }
              // Envoi des données au serveur avec CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch('/api/sous-domaines', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    code: code,
                    description: description,
                    domaine_code: domaine_code
                })
            })            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        console.error('Erreur serveur:', err);
                        const message = err.message || 'Une erreur est survenue lors de l\'ajout du sous-domaine';
                        throw new Error(message);
                    });
                }
                return response.json();
            })            .then(data => {
                // Mettre à jour la liste des sous-domaines pour le domaine sélectionné
                const domaineId = document.getElementById('domaine_select').value;
                fetch(`/api/domaines/${domaineId}/sous-domaines`)
                    .then(response => response.json())
                    .then(sousDomaines => {
                        // Vider et reconstruire la liste des sous-domaines
                        sousDomaineSelect.innerHTML = '<option value="">Sélectionner un sous-domaine</option>';
                        sousDomaines.forEach(sousDomaine => {
                            const option = document.createElement('option');
                            option.value = sousDomaine.code;
                            option.textContent = `${sousDomaine.code} - ${sousDomaine.description}`;
                            sousDomaineSelect.appendChild(option);
                            
                            // Sélectionner le nouveau sous-domaine si c'est celui qu'on vient d'ajouter
                            if (sousDomaine.code === data.sous_domaine.code) {
                                sousDomaineSelect.value = sousDomaine.code;
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Erreur lors du rechargement des sous-domaines:', error);
                    });

                // Fermer le modal et réinitialiser le formulaire
                sousDomaineModal.hide();
                document.getElementById('sousDomaineForm').reset();

                alert('Sous-domaine ajouté avec succès!');
            })
            .catch(error => {
                console.error('Erreur:', error);
                if (error.response && error.response.status === 422) {
                    // Erreur de validation
                    error.response.json().then(data => {
                        const messages = data.errors ? Object.values(data.errors).flat() : [data.message];
                        alert(messages.join('\n'));
                    });
                } else {
                    // Autre type d'erreur
                    alert(error.message || 'Une erreur est survenue. Veuillez réessayer.');
                }
            });
        });
    });
</script>
@endpush
@endsection
