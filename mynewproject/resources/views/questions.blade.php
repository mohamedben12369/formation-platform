@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Gestion des Questions de Sécurité</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Bouton pour ouvrir le modal d'ajout -->
    <button class="btn btn-primary mb-3 w-100" data-bs-toggle="modal" data-bs-target="#addQuestionModal">Ajouter une Question de Sécurité</button>

    <!-- Modal d'ajout -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('dashboard.questions.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addQuestionModalLabel">Ajouter une Question de Sécurité</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control" id="question" name="question" required>
                            @error('question')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Créé le</th>
                    <th>Modifié le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($questions ?? [] as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->created_at ? $question->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                    <td>{{ $question->updated_at ? $question->updated_at->format('d/m/Y H:i') : 'N/A' }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editQuestionModal{{ $question->id }}">Modifier</button>
                        <form action="{{ route('dashboard.questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal de modification -->
                <div class="modal fade" id="editQuestionModal{{ $question->id }}" tabindex="-1" aria-labelledby="editQuestionModalLabel{{ $question->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('dashboard.questions.update', $question->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editQuestionModalLabel{{ $question->id }}">Modifier Question</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="question{{ $question->id }}" class="form-label">Question</label>
                                        <input type="text" class="form-control" id="question{{ $question->id }}" name="question" value="{{ $question->question }}" required>
                                        @error('question')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune question de sécurité trouvée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    .table-responsive {
        margin-top: 20px;
    }
    .btn-group {
        display: flex;
        gap: 5px;
    }
    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    .modal-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
    }
    .alert {
        margin-bottom: 20px;
    }
</style>
@endsection

@push('styles')
    @vite('resources/css/questions-section.css')
@endpush
