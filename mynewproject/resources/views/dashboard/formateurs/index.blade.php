@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-chalkboard-teacher me-2"></i>
                        Gestion des Formateurs
                    </h3>
                    <a href="{{ route('dashboard.users.create', ['role' => 'formateur']) }}" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i>Ajouter un Formateur
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($formateurs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Rôle</th>
                                        <th>Date de création</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($formateurs as $formateur)
                                        <tr>
                                            <td>{{ $formateur->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user-circle me-2 text-purple"></i>
                                                    {{ $formateur->name }}
                                                </div>
                                            </td>                                            <td>{{ $formateur->email }}</td>
                                            <td>
                                                @if($formateur->role)
                                                    <span class="badge bg-success">{{ $formateur->role->nom }}</span>
                                                @else
                                                    <span class="badge bg-secondary">Aucun rôle</span>
                                                @endif
                                            </td>
                                            <td>{{ $formateur->created_at->format('d/m/Y H:i') }}</td>                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('dashboard.users.index') }}?user={{ $formateur->id }}" 
                                                       class="btn btn-sm btn-info" 
                                                       title="Voir dans la gestion des utilisateurs">
                                                        <i class="fas fa-user"></i>
                                                    </a>
                                                    <a href="{{ route('dashboard.users.edit', $formateur->id) }}" 
                                                       class="btn btn-sm btn-warning" 
                                                       title="Modifier l'utilisateur">
                                                        <i class="fas fa-user-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-danger" 
                                                            title="Supprimer l'utilisateur"
                                                            onclick="confirmDelete({{ $formateur->id }}, '{{ $formateur->name }}')">
                                                        <i class="fas fa-user-times"></i>
                                                    </button>
                                                </div>
                                                
                                                <!-- Hidden form for deletion -->
                                                <form id="delete-form-{{ $formateur->id }}" 
                                                      action="{{ route('dashboard.users.destroy', $formateur->id) }}" 
                                                      method="POST" 
                                                      style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $formateurs->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-chalkboard-teacher fa-5x text-muted mb-3"></i>                            <h4 class="text-muted">Aucun formateur trouvé</h4>
                            <p class="text-muted">Commencez par ajouter votre premier formateur.</p>
                            <a href="{{ route('dashboard.users.create', ['role' => 'formateur']) }}" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Ajouter un Formateur
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .text-purple {
        color: #8b5cf6 !important;
    }
    
    .card-header {
        background-color: #1e1e2d;
        color: white;
        border-bottom: 1px solid #323248;
    }
    
    .table-dark {
        background-color: #2b2b40;
    }
    
    .btn-group .btn {
        margin-right: 2px;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    
    .badge {
        font-size: 0.8rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>
@endpush

@push('scripts')
<script>
function confirmDelete(formateurId, formateurName) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer le formateur "${formateurName}" ?\n\nCette action est irréversible.`)) {
        document.getElementById('delete-form-' + formateurId).submit();
    }
}
</script>
@endpush
@endsection
