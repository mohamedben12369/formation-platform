@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Modifier la Question de Sécurité</h5>
                        <a href="{{ route('dashboard.securite-questions.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('dashboard.securite-questions.update', $question->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="question" class="form-label">Question de Sécurité <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('question') is-invalid @enderror" 
                                   id="question" 
                                   name="question" 
                                   value="{{ old('question', $question->question) }}"
                                   placeholder="Ex: Quel est le nom de votre premier animal de compagnie ?" 
                                   required>
                            @error('question')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Modifiez la question de sécurité qui sera utilisée pour la récupération de mot de passe.
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                Créée le : {{ $question->created_at ? $question->created_at->format('d/m/Y à H:i') : 'N/A' }}
                                @if($question->updated_at && $question->updated_at != $question->created_at)
                                    <br>
                                    <i class="fas fa-edit me-1"></i>
                                    Dernière modification : {{ $question->updated_at->format('d/m/Y à H:i') }}
                                @endif
                            </small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('dashboard.securite-questions.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i>Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
