@extends('layouts.app')

@section('title', 'Gestion des types de documents')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>
                        Gestion des types de documents
                    </h5>
                    <a href="{{ route('dashboard.type-documents.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Nouveau type
                    </a>
                </div>
                <div class="card-body">
                    @if($typeDocuments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Formats</th>
                                        <th>Taille max</th>
                                        <th>Obligatoire</th>
                                        <th>Statut</th>
                                        <th>Utilisations</th>
                                        <th width="200">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($typeDocuments as $typeDocument)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="{{ $typeDocument->icone ?? 'fas fa-file' }} me-2" 
                                                   style="color: {{ $typeDocument->couleur ?? '#6c757d' }}"></i>
                                                <strong>{{ $typeDocument->nom }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <small>{{ Str::limit($typeDocument->description, 50) ?? 'Aucune description' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ strtoupper($typeDocument->formats_autorises) }}</span>
                                        </td>
                                        <td>{{ $typeDocument->taille_max_mb }} MB</td>
                                        <td>
                                            @if($typeDocument->obligatoire)
                                                <span class="badge bg-danger">Obligatoire</span>
                                            @else
                                                <span class="badge bg-secondary">Optionnel</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($typeDocument->actif)
                                                <span class="badge bg-success">Actif</span>
                                            @else
                                                <span class="badge bg-warning">Inactif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $typeDocument->candidature_documents_count ?? 0 }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('dashboard.type-documents.show', $typeDocument) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('dashboard.type-documents.edit', $typeDocument) }}" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <form method="POST" 
                                                      action="{{ route('dashboard.type-documents.toggle-actif', $typeDocument) }}" 
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" 
                                                            class="btn btn-sm {{ $typeDocument->actif ? 'btn-outline-warning' : 'btn-outline-success' }}" 
                                                            title="{{ $typeDocument->actif ? 'Désactiver' : 'Activer' }}">
                                                        <i class="fas {{ $typeDocument->actif ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                                    </button>
                                                </form>
                                                
                                                <form method="POST" 
                                                      action="{{ route('dashboard.type-documents.destroy', $typeDocument) }}" 
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            title="Supprimer"
                                                            onclick="return confirm('Supprimer ce type de document ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $typeDocuments->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun type de document</h5>
                            <p class="text-muted">Créez votre premier type de document pour commencer.</p>
                            <a href="{{ route('dashboard.type-documents.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Créer un type de document
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
