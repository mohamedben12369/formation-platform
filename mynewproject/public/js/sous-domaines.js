class SousDomaineManager {
    constructor() {
        this.sousDomaineSelect = document.getElementById('sous_domaine_select');
        this.domaineSelect = document.getElementById('domaine_select');
        this.saveSousDomaineBtn = document.getElementById('saveSousDomaineBtn');
        this.sousDomaineModal = new bootstrap.Modal(document.getElementById('addSousDomaineModal'));
        
        this.setupEventListeners();
    }

    setupEventListeners() {
        this.saveSousDomaineBtn.addEventListener('click', () => this.handleSaveSousDomaine());
        
        // Mise à jour du domaine_code lors de l'ouverture du modal
        document.getElementById('addSousDomaineModal').addEventListener('show.bs.modal', (event) => {
            const selectedDomaineId = this.domaineSelect.value;
            if (!selectedDomaineId) {
                alert('Veuillez d\'abord sélectionner un domaine');
                event.preventDefault();
                return;
            }
            document.getElementById('sous_domaine_domaine_code').value = selectedDomaineId;
        });
    }

    async handleSaveSousDomaine() {
        try {
            const code = document.getElementById('sous_domaine_code').value.trim().toUpperCase();
            const description = document.getElementById('sous_domaine_description').value.trim();
            const domaine_code = document.getElementById('sous_domaine_domaine_code').value;

            // Validation
            if (!this.validateInputs(code, description, domaine_code)) {
                return;
            }

            const response = await this.saveSousDomaine(code, description, domaine_code);
            if (response.success) {
                await this.updateSousDomainesList(domaine_code, response.sous_domaine.code);
                this.resetForm();
                alert('Sous-domaine ajouté avec succès!');
            }
        } catch (error) {
            console.error('Erreur:', error);
            alert(error.message || 'Une erreur est survenue lors de l\'ajout du sous-domaine');
        }
    }

    validateInputs(code, description, domaine_code) {
        if (!code || !description || !domaine_code) {
            alert('Tous les champs sont obligatoires');
            return false;
        }
        if (code.length > 10) {
            alert('Le code ne doit pas dépasser 10 caractères');
            return false;
        }
        if (!/^[A-Z0-9\-]+$/.test(code)) {
            alert('Le code doit contenir uniquement des majuscules, des chiffres et des tirets');
            return false;
        }
        return true;
    }

    async saveSousDomaine(code, description, domaine_code) {
        const response = await fetch('/api/sous-domaines', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ code, description, domaine_code })
        });

        const data = await response.json();
        
        if (!response.ok) {
            throw new Error(data.message || 'Erreur lors de l\'ajout du sous-domaine');
        }

        return data;
    }

    async updateSousDomainesList(domaineId, newSousDomaineCode) {
        const response = await fetch(`/api/domaines/${domaineId}/sous-domaines`);
        const sousDomaines = await response.json();

        this.sousDomaineSelect.innerHTML = '<option value="">Sélectionner un sous-domaine</option>';
        
        sousDomaines.forEach(sousDomaine => {
            const option = document.createElement('option');
            option.value = sousDomaine.code;
            option.textContent = `${sousDomaine.code} - ${sousDomaine.description}`;
            this.sousDomaineSelect.appendChild(option);
            
            if (sousDomaine.code === newSousDomaineCode) {
                this.sousDomaineSelect.value = sousDomaine.code;
            }
        });
    }

    resetForm() {
        this.sousDomaineModal.hide();
        document.getElementById('sousDomaineForm').reset();
    }
}

// Initialiser le gestionnaire quand le DOM est chargé
document.addEventListener('DOMContentLoaded', () => {
    new SousDomaineManager();
});
