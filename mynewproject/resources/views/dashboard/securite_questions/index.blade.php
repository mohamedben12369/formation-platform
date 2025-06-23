@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-question-circle me-2"></i>Gestion des Questions de Sécurité</h1>
        <button id="btnShowAddForm" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Ajouter une Question
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Formulaire d'ajout (masqué par défaut) -->
    <div id="addForm" class="card mb-4" style="display: none;">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-plus me-2"></i>Ajouter une Question de Sécurité
                <button type="button" id="btnCancelAdd" class="btn btn-sm btn-outline-light float-end">
                    <i class="fas fa-times"></i> Annuler
                </button>
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.securite-questions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="add_question" class="form-label">Question de Sécurité <span class="text-danger">*</span></label>
                    <textarea name="question" id="add_question" class="form-control @error('question') is-invalid @enderror" 
                              rows="3" placeholder="Entrez votre question de sécurité..." required>{{ old('question') }}</textarea>
                    @error('question')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                    <button type="button" id="btnCancelAdd2" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Formulaire d'édition (masqué par défaut) -->
    <div id="editForm" class="card mb-4" style="display: none;">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                <i class="fas fa-edit me-2"></i>Modifier la Question de Sécurité
                <button type="button" id="btnCancelEdit" class="btn btn-sm btn-outline-light float-end">
                    <i class="fas fa-times"></i> Annuler
                </button>
            </h5>
        </div>
        <div class="card-body">
            <form id="editFormElement" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="edit_question" class="form-label">Question de Sécurité <span class="text-danger">*</span></label>
                    <textarea name="question" id="edit_question" class="form-control" 
                              rows="3" placeholder="Entrez votre question de sécurité..." required></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save me-2"></i>Mettre à jour
                    </button>
                    <button type="button" id="btnCancelEdit2" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des questions -->
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Liste des Questions de Sécurité</h5>
        </div>
        <div class="card-body">
            @if($questions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-warning">
                            <tr>
                                <th>ID</th>
                                <th>Question</th>
                                <th>Date de Création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                                <tr id="question-row-{{ $question->id }}">
                                    <td>{{ $question->id }}</td>
                                    <td>{{ $question->question }}</td>
                                    <td>{{ $question->created_at ? $question->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary btnEdit" 
                                                data-id="{{ $question->id }}" 
                                                data-question="{{ $question->question }}">
                                            <i class="fas fa-edit"></i> Modifier
                                        </button>
                                        <form action="{{ route('dashboard.securite-questions.destroy', $question->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?')">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Aucune question de sécurité trouvée</h5>
                    <p class="text-muted">Commencez par ajouter votre première question de sécurité.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnShowAddForm = document.getElementById('btnShowAddForm');
    const addForm = document.getElementById('addForm');
    const editForm = document.getElementById('editForm');
    const btnCancelAdd = document.getElementById('btnCancelAdd');
    const btnCancelAdd2 = document.getElementById('btnCancelAdd2');
    const btnCancelEdit = document.getElementById('btnCancelEdit');
    const btnCancelEdit2 = document.getElementById('btnCancelEdit2');
    const editFormElement = document.getElementById('editFormElement');
    const editQuestionInput = document.getElementById('edit_question');
    const btnEdits = document.querySelectorAll('.btnEdit');

    // Afficher le formulaire d'ajout
    btnShowAddForm.addEventListener('click', function() {
        addForm.style.display = 'block';
        editForm.style.display = 'none';
        document.getElementById('add_question').focus();
        btnShowAddForm.style.display = 'none';
    });

    // Masquer le formulaire d'ajout
    function hideAddForm() {
        addForm.style.display = 'none';
        btnShowAddForm.style.display = 'inline-block';
    }

    btnCancelAdd.addEventListener('click', hideAddForm);
    btnCancelAdd2.addEventListener('click', hideAddForm);

    // Masquer le formulaire d'édition
    function hideEditForm() {
        editForm.style.display = 'none';
        btnShowAddForm.style.display = 'inline-block';
    }

    btnCancelEdit.addEventListener('click', hideEditForm);
    btnCancelEdit2.addEventListener('click', hideEditForm);

    // Gérer les boutons de modification
    btnEdits.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const questionId = this.getAttribute('data-id');
            const questionText = this.getAttribute('data-question');
            
            // Masquer le formulaire d'ajout et afficher celui d'édition
            addForm.style.display = 'none';
            editForm.style.display = 'block';
            btnShowAddForm.style.display = 'none';
            
            // Remplir le formulaire d'édition
            editQuestionInput.value = questionText;
            editFormElement.action = '{{ route("dashboard.securite-questions.update", ":id") }}'.replace(':id', questionId);
            
            // Focus sur le champ
            editQuestionInput.focus();
        });
    });

    // Si il y a des erreurs de validation, afficher le bon formulaire
    @if($errors->any())
        @if(old('_method') === 'PUT')
            // C'était une tentative d'édition
            const editId = '{{ old("id") }}';
            if (editId) {
                editForm.style.display = 'block';
                btnShowAddForm.style.display = 'none';
            }
        @else
            // C'était une tentative d'ajout
            addForm.style.display = 'block';
            btnShowAddForm.style.display = 'none';
        @endif
    @endif
});
</script>

@endsection
