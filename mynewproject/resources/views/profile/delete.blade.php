@extends('layouts.profhead')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-danger text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <h5 class="mb-0">Supprimer le compte</h5>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <div class="alert alert-warning border-0" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle text-warning me-3"></i>
                            <div>
                                <h6 class="mb-1">Action irréversible</h6>
                                <p class="mb-0 small">Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center py-4">
                        <i class="fas fa-user-slash text-danger mb-3" style="font-size: 3rem;"></i>
                        <h4 class="text-danger mb-3">Êtes-vous sûr de vouloir supprimer votre compte ?</h4>
                        <p class="text-muted mb-4">Cette action ne peut pas être annulée. Tous vos données, formations, compétences et documents seront perdus définitivement.</p>
                        
                        <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                            <i class="fas fa-trash-alt me-2"></i>
                            Supprimer définitivement mon compte
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title" id="confirmDeleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Confirmation de suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <i class="fas fa-skull-crossbones text-danger mb-3" style="font-size: 2.5rem;"></i>
                    <h5 class="text-danger">Dernière chance !</h5>
                    <p class="text-muted">Veuillez confirmer votre mot de passe pour procéder à la suppression définitive de votre compte.</p>
                </div>
                
                <form method="post" action="{{ route('profile.destroy') }}" id="deleteAccountForm">
                    @csrf
                    @method('delete')
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-1"></i>
                            Mot de passe *
                        </label>
                        <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                               id="password" name="password" placeholder="Entrez votre mot de passe actuel" required>
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </form>
            </div>
            
            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>
                    Annuler
                </button>
                <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteAccountForm').submit()">
                    <i class="fas fa-trash-alt me-2"></i>
                    Supprimer définitivement
                </button>
            </div>
        </div>
    </div>
</div>

@if($errors->userDeletion->isNotEmpty())
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    modal.show();
});
</script>
@endif

@endsection