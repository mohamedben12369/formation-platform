// JS for Theme Formations dashboard section: modal logic, add/edit/delete, etc.
document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-theme-formation-btn');
    const addForm = document.getElementById('add-theme-formation-form');
    const modal = document.getElementById('dashboard-modal');
    const modalContent = document.getElementById('dashboard-modal-content');
    const closeBtn = document.getElementById('dashboard-modal-close');
    if (addBtn && addForm && modal && modalContent) {
        addBtn.addEventListener('click', function(e) {
            e.preventDefault();
            modal.style.display = 'flex';
            modalContent.innerHTML = '';
            modalContent.appendChild(addForm.cloneNode(true));
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
