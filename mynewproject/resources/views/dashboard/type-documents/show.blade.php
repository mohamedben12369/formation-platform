@extends('layouts.app')

@section('title', 'Détails du type de document')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="{{ $typeDocument->icone ?? 'fas fa-file' }} me-2" 
                           style="color: {{ $typeDocument->couleur ?? '#6c757d' }}"></i>
                        {{ $typeDocument->nom }}
                    </h5>
                    <div>
                        @if($typeDocument->actif)
                            <span class="badge bg-success">Actif</span>
                        @else
                            <span class="badge bg-warning">Inactif</span>
                        @endif
                        
                        @if($typeDocument->obligatoire)
                            <span class="badge bg-danger">Obligatoire</span>
                        @else
                            <span class="badge bg-secondary">Optionnel</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-primary border-bottom pb-2">
                                <i class="fas fa-info-circle me-2"></i>Informations générales
                            </h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Nom :</strong></td>
                                    <td>{{ $typeDocument->nom }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Description :</strong></td>
                                    <td>{{ $typeDocument->description ?? 'Aucune description' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Icône :</strong></td>
                                    <td>
                                        <i class="{{ $typeDocument->icone ?? 'fas fa-file' }} me-2" 
                                           style="color: {{ $typeDocument->couleur ?? '#6c757d' }}"></i>
                                        <code>{{ $typeDocument->icone ?? 'fas fa-file' }}</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Couleur :</strong></td>
                                    <td>
                                        <span class="badge" style="background-color: {{ $typeDocument->couleur ?? '#6c757d' }}">
                                            {{ $typeDocument->couleur ?? '#6c757d' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-primary border-bottom pb-2">
                                <i class="fas fa-cog me-2"></i>Configuration
                            </h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Formats autorisés :</strong></td>
                                    <td>
                                        @foreach(explode(',', $typeDocument->formats_autorises) as $format)
                                            <span class="badge bg-info me-1">{{ strtoupper(trim($format)) }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Taille maximale :</strong></td>
                                    <td>{{ $typeDocument->taille_max_mb }} MB</td>
                                </tr>
                                <tr>
                                    <td><strong>Obligatoire :</strong></td>
                                    <td>
                                        @if($typeDocument->obligatoire)
                                            <i class="fas fa-check-circle text-success"></i> Oui
                                        @else
                                            <i class="fas fa-times-circle text-danger"></i> Non
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Statut :</strong></td>
                                    <td>
                                        @if($typeDocument->actif)
                                            <i class="fas fa-check-circle text-success"></i> Actif
                                        @else
                                            <i class="fas fa-times-circle text-warning"></i> Inactif
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Statistiques d'utilisation -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary border-bottom pb-2">
                                <i class="fas fa-chart-bar me-2"></i>Statistiques d'utilisation
                            </h6>
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h3 class="text-primary">{{ $typeDocument->candidature_documents_count }}</h3>
                                            <p class="mb-0">Documents fournis</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h3 class="text-info">{{ $typeDocument->formats_autorises_array_attribute ? count($typeDocument->formats_autorises_array_attribute) : 0 }}</h3>
                                            <p class="mb-0">Formats acceptés</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h3 class="text-warning">{{ $typeDocument->taille_max_octets ? round($typeDocument->taille_max_octets / 1024 / 1024, 1) : 0 }}</h3>
                                            <p class="mb-0">MB max</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations techniques -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-primary border-bottom pb-2">
                                <i class="fas fa-code me-2"></i>Informations techniques
                            </h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Attribut accept HTML :</strong></td>
                                    <td><code>{{ $typeDocument->accept }}</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Taille en octets :</strong></td>
                                    <td>{{ number_format($typeDocument->taille_max_octets) }} octets</td>
                                </tr>
                                <tr>
                                    <td><strong>Date de création :</strong></td>
                                    <td>{{ $typeDocument->created_at->format('d/m/Y à H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Dernière modification :</strong></td>
                                    <td>{{ $typeDocument->updated_at->format('d/m/Y à H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('dashboard.type-documents.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                                </a>
                                <div>
                                    <a href="{{ route('dashboard.type-documents.edit', $typeDocument) }}" class="btn btn-warning">
                                        <i class="fas fa-edit me-2"></i>Modifier
                                    </a>
                                    
                                    <form method="POST" 
                                          action="{{ route('dashboard.type-documents.toggle-actif', $typeDocument) }}" 
                                          style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" 
                                                class="btn {{ $typeDocument->actif ? 'btn-outline-warning' : 'btn-success' }}">
                                            <i class="fas {{ $typeDocument->actif ? 'fa-eye-slash' : 'fa-eye' }} me-2"></i>
                                            {{ $typeDocument->actif ? 'Désactiver' : 'Activer' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
