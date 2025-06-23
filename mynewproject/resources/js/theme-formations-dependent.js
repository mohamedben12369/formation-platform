// Dépendant: Domaine -> Sous-domaine -> Axe
$(document).ready(function() {
    // 1. Charger les domaines (si pas déjà dans le blade)
    // 2. Quand domaine change, charger les sous-domaines
    // 3. Quand sous-domaine change, charger les axes

    // On suppose que le select domaine existe dans le blade (à ajouter)
    const domaineSelect = $("#domaine-select");
    const sousDomaineSelect = $("select[name='sous_domaine_code']");
    const axeSelect = $("select[name='axes_id']");

    domaineSelect.on('change', function() {
        const domaineId = $(this).val();
        sousDomaineSelect.html('<option value="">Chargement...</option>');
        axeSelect.html('<option value="">Sélectionner un axe</option>');
        if (domaineId) {
            $.get('/api/sous-domaines/' + domaineId, function(data) {
                let options = '<option value="">Sélectionner un sous domaine</option>';
                data.forEach(function(sd) {
                    options += `<option value="${sd.code}">${sd.code} - ${sd.description}</option>`;
                });
                sousDomaineSelect.html(options);
            });
        } else {
            sousDomaineSelect.html('<option value="">Sélectionner un sous domaine</option>');
        }
    });

    sousDomaineSelect.on('change', function() {
        const sousDomaineCode = $(this).val();
        axeSelect.html('<option value="">Chargement...</option>');
        if (sousDomaineCode) {
            $.get('/api/axes/' + sousDomaineCode, function(data) {
                let options = '<option value="">Sélectionner un axe</option>';
                data.forEach(function(axe) {
                    options += `<option value="${axe.id}">${axe.nom}</option>`;
                });
                axeSelect.html(options);
            });
        } else {
            axeSelect.html('<option value="">Sélectionner un axe</option>');
        }
    });
});
