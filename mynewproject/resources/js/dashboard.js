// Toggle visibility for roles and questions lists and forms

document.addEventListener('DOMContentLoaded', function () {
    // Toggle roles list
    const rolesHeader = document.getElementById('roles-header');
    const rolesList = document.getElementById('roles-list');
    if (rolesHeader && rolesList) {
        rolesHeader.style.cursor = 'pointer';
        rolesHeader.addEventListener('click', function () {
            rolesList.style.display = rolesList.style.display === 'none' ? 'block' : 'none';
        });
    }

    // Toggle security questions list
    const questionsHeader = document.getElementById('questions-header');
    const questionsList = document.getElementById('questions-list');
    if (questionsHeader && questionsList) {
        questionsHeader.style.cursor = 'pointer';
        questionsHeader.addEventListener('click', function () {
            questionsList.style.display = questionsList.style.display === 'none' ? 'block' : 'none';
        });
    }

    // Hide and toggle role form
    const roleFormToggle = document.getElementById('toggle-role-form');
    const roleForm = document.getElementById('role-form');
    if (roleForm && roleFormToggle) {
        roleForm.style.display = 'none';
        roleFormToggle.addEventListener('click', function () {
            roleForm.style.display = roleForm.style.display === 'none' ? 'block' : 'none';
        });
    }

    // Hide and toggle question form
    const questionFormToggle = document.getElementById('toggle-question-form');
    const questionForm = document.getElementById('question-form');
    if (questionForm && questionFormToggle) {
        questionForm.style.display = 'none';
        questionFormToggle.addEventListener('click', function () {
            questionForm.style.display = questionForm.style.display === 'none' ? 'block' : 'none';
        });
    }

    // Tab switching logic for the competences section
    document.querySelectorAll('.dashboard-tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.dashboard-tab-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('roles-section').style.display = (this.dataset.tab === 'roles') ? 'block' : 'none';
            document.getElementById('questions-section').style.display = (this.dataset.tab === 'questions') ? 'block' : 'none';
            document.getElementById('domaines-section').style.display = (this.dataset.tab === 'domaines') ? 'block' : 'none';
            document.getElementById('axes-section').style.display = (this.dataset.tab === 'axes') ? 'block' : 'none';
            document.getElementById('sous-domaines-section').style.display = (this.dataset.tab === 'sous-domaines') ? 'block' : 'none';
            document.getElementById('theme-formations-section').style.display = (this.dataset.tab === 'theme-formations') ? 'block' : 'none';
            document.getElementById('competences-section').style.display = (this.dataset.tab === 'competences') ? 'block' : 'none';
        });
    });
});

// Modal logic for add forms (domaines, axes, etc.)
function showCenteredModal(formId) {
    let modal = document.getElementById('dashboard-modal');
    let modalContent = document.getElementById('dashboard-modal-content');
    let form = document.getElementById(formId);
    if (modal && modalContent && form) {
        modal.style.display = 'flex';
        modalContent.innerHTML = '';
        modalContent.appendChild(form.cloneNode(true));
        // Remove id from cloned form to avoid duplicate ids
        modalContent.querySelector('form').id = '';
        // Focus first input
        let firstInput = modalContent.querySelector('input,select,textarea');
        if (firstInput) firstInput.focus();
    }
}
function hideCenteredModal() {
    let modal = document.getElementById('dashboard-modal');
    if (modal) modal.style.display = 'none';
}
// Attach listeners for add buttons
['add-domaine-btn','add-axe-btn','add-sous-domaine-btn','add-theme-formation-btn'].forEach(btnId => {
    let btn = document.getElementById(btnId);
    if (btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            let formId = btn.getAttribute('data-form-id');
            showCenteredModal(formId);
        });
    }
});
// Hide modal on background click or close
window.addEventListener('DOMContentLoaded', function() {
    let modal = document.getElementById('dashboard-modal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) hideCenteredModal();
        });
    }
    let closeBtn = document.getElementById('dashboard-modal-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', hideCenteredModal);
    }
});
document.addEventListener('DOMContentLoaded', function () {
    // Add hover effect for badge tooltips (for mobile compatibility)
    document.querySelectorAll('.badge-fk').forEach(function(badge) {
        badge.addEventListener('touchstart', function(e) {
            var tooltip = document.createElement('div');
            tooltip.className = 'badge-tooltip';
            tooltip.innerText = badge.getAttribute('title');
            badge.appendChild(tooltip);
        });
        badge.addEventListener('touchend', function(e) {
            var tooltip = badge.querySelector('.badge-tooltip');
            if (tooltip) badge.removeChild(tooltip);
        });
    });
    // Toggle badge/select on edit/save for sous-domaines
    document.querySelectorAll('.edit-sous-domaine-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var row = btn.closest('tr');
            row.querySelectorAll('.sous-domaine-editable').forEach(function(input) {
                input.removeAttribute('readonly');
                input.classList.add('editing');
            });
            row.querySelectorAll('.fk-badge').forEach(function(badge) {
                badge.style.display = 'none';
            });
            row.querySelectorAll('.fk-select').forEach(function(sel) {
                sel.disabled = false;
                sel.style.display = 'inline-block';
            });
            btn.style.display = 'none';
            row.querySelector('.save-sous-domaine-btn').style.display = 'inline-block';
        });
    });
    document.querySelectorAll('.save-sous-domaine-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var row = btn.closest('tr');
            row.querySelectorAll('.sous-domaine-editable').forEach(function(input) {
                input.setAttribute('readonly', true);
                input.classList.remove('editing');
            });
            row.querySelectorAll('.fk-badge').forEach(function(badge) {
                badge.style.display = 'inline-block';
            });
            row.querySelectorAll('.fk-select').forEach(function(sel) {
                sel.disabled = true;
                sel.style.display = 'none';
            });
            btn.style.display = 'none';
            row.querySelector('.edit-sous-domaine-btn').style.display = 'inline-block';
        });
    });
        // Tooltip handled by CSS :hover
    });