// JS for Axes dashboard section: modal logic, add/edit/delete, etc.
document.addEventListener('DOMContentLoaded', function () {
    // Modal logic for add axe
    const addAxeBtn = document.getElementById('add-axe-btn');
    const addAxeForm = document.getElementById('add-axe-form');
    const modal = document.getElementById('dashboard-modal');
    const modalContent = document.getElementById('dashboard-modal-content');
    const closeBtn = document.getElementById('dashboard-modal-close');
    if (addAxeBtn && addAxeForm && modal && modalContent) {
        addAxeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            modal.style.display = 'flex';
            modalContent.innerHTML = '';
            modalContent.appendChild(addAxeForm.cloneNode(true));
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
    // Edit/save logic for axes
    document.querySelectorAll('.edit-axe-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = btn.closest('tr');
            row.querySelectorAll('.axe-editable').forEach(input => input.removeAttribute('readonly'));
            row.querySelector('.save-axe-btn').style.display = 'inline-block';
            btn.style.display = 'none';
        });
    });
});
