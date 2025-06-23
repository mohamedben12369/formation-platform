@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Gestion des Entreprises</h2>
        <a href="{{ route('dashboard.entreprises.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Ajouter une entreprise
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Logo</th>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Site web</th>
                            <th>Adresse</th>
                            <th>Téléphone</th>
                            <th>Fax</th>
                            <th>CNSS</th>
                            <th>IF</th>
                            <th>RC</th>
                            <th>ICE</th>
                            <th>Patente</th>
                            <th>Date création</th>
                            <th>Utilisateur</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($entreprises as $entreprise)
                        <tr>                            <td>
                                @if($entreprise->hasImage())
                                    <img src="{{ $entreprise->image_url }}" 
                                         alt="Logo {{ $entreprise->nom }}" 
                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;" 
                                         class="border">
                                @elseif($entreprise->image)
                                    <div class="bg-warning border rounded d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;" 
                                         title="Image introuvable: {{ $entreprise->image }}">
                                        <i class="fas fa-exclamation-triangle text-dark"></i>
                                    </div>
                                @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-building text-secondary"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $entreprise->id }}</td>
                            <td>{{ $entreprise->nom }}</td>
                            <td>{{ $entreprise->email }}</td>
                            <td>
                                @if($entreprise->website)
                                    <a href="{{ $entreprise->website }}" target="_blank" class="text-primary">
                                        <i class="fas fa-external-link-alt me-1"></i>Site web
                                    </a>
                                @endif
                            </td>
                            <td>{{ $entreprise->Adresse }}</td>
                            <td>{{ $entreprise->tel }}</td>
                            <td>{{ $entreprise->fax }}</td>
                            <td>{{ $entreprise->CNSS }}</td>
                            <td>{{ $entreprise->IF }}</td>
                            <td>{{ $entreprise->RC }}</td>
                            <td>{{ $entreprise->ICE }}</td>
                            <td>{{ $entreprise->patente }}</td>
                            <td>{{ $entreprise->date_creation }}</td>
                            <td>{{ $entreprise->user->name ?? 'Non assigné' }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('dashboard.entreprises.edit', $entreprise) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dashboard.entreprises.destroy', $entreprise) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="16" class="text-center py-4">Aucune entreprise trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
