// JS for Domaines dashboard section: modal logic, add/edit/delete, etc.
document.addEventListener('DOMContentLoaded', function () {
    // Modal logic for add domaine
    const addDomaineBtn = document.getElementById('add-domaine-btn');
    const addDomaineForm = document.getElementById('add-domaine-form');
    const modal = document.getElementById('dashboard-modal');
    const modalContent = document.getElementById('dashboard-modal-content');
    const closeBtn = document.getElementById('dashboard-modal-close');
    if (addDomaineBtn && addDomaineForm && modal && modalContent) {
        addDomaineBtn.addEventListener('click', function(e) {
            e.preventDefault();
            modal.style.display = 'flex';
            modalContent.innerHTML = '';
            modalContent.appendChild(addDomaineForm.cloneNode(true));
            modalContent.querySelector('form').id = '';
            let firstInput = modalContent.querySelector('input,select,textarea');
            if (firstInput) firstInput.focus();
        });
    }
    if (modal && closeBtn) {
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
        modal.addEventListener('click', function(e) {
            if (e.target === modal) modal.style.display = 'none';
        });
    }
});
