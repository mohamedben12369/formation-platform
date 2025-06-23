@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1">Bienvenue dans votre espace entreprise</h2>
                            <h5 class="mb-0">{{ $entreprise->nom }}</h5>
                        </div>
                        <div>
                            <a href="{{ route('dashboard.entreprises.edit', $entreprise->id) }}" class="btn btn-light">
                                <i class="fas fa-edit me-2"></i>Modifier mes informations
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box bg-primary-light me-3">
                            <i class="fas fa-info-circle text-primary"></i>
                        </div>
                        <h5 class="card-title mb-0">Informations de l'entreprise</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Nom:</span>
                            <span>{{ $entreprise->nom }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Email:</span>
                            <span>{{ $entreprise->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Téléphone:</span>
                            <span>{{ $entreprise->tel }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="fw-bold">CNSS:</span>
                            <span>{{ $entreprise->CNSS }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box bg-success-light me-3">
                            <i class="fas fa-chalkboard-teacher text-success"></i>
                        </div>
                        <h5 class="card-title mb-0">Formations</h5>
                    </div>
                    <p>Gérez les formations pour vos collaborateurs.</p>
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-outline-success">
                            <i class="fas fa-search me-2"></i>Rechercher des formations
                        </a>
                        <a href="#" class="btn btn-outline-success">
                            <i class="fas fa-history me-2"></i>Historique des formations
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box bg-warning-light me-3">
                            <i class="fas fa-users text-warning"></i>
                        </div>
                        <h5 class="card-title mb-0">Collaborateurs</h5>
                    </div>
                    <p>Gérez vos collaborateurs et leurs compétences.</p>
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-outline-warning">
                            <i class="fas fa-user-plus me-2"></i>Ajouter un collaborateur
                        </a>
                        <a href="#" class="btn btn-outline-warning">
                            <i class="fas fa-list me-2"></i>Liste des collaborateurs
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box bg-danger-light me-3">
                            <i class="fas fa-file-alt text-danger"></i>
                        </div>
                        <h5 class="card-title mb-0">Documents</h5>
                    </div>
                    <p>Gérez les documents liés à votre entreprise et vos formations.</p>
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-outline-danger">
                            <i class="fas fa-upload me-2"></i>Téléverser un document
                        </a>
                        <a href="#" class="btn btn-outline-danger">
                            <i class="fas fa-folder-open me-2"></i>Mes documents
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box bg-secondary-light me-3">
                            <i class="fas fa-cog text-secondary"></i>
                        </div>
                        <h5 class="card-title mb-0">Paramètres</h5>
                    </div>
                    <p>Configurez les paramètres de votre espace entreprise.</p>
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-outline-secondary">
                            <i class="fas fa-cogs me-2"></i>Paramètres généraux
                        </a>
                        <a href="#" class="btn btn-outline-secondary">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .bg-primary-light {
        background-color: rgba(37, 99, 235, 0.1);
    }
    
    .bg-success-light {
        background-color: rgba(16, 185, 129, 0.1);
    }
    
    .bg-warning-light {
        background-color: rgba(245, 158, 11, 0.1);
    }
    
    .bg-info-light {
        background-color: rgba(6, 182, 212, 0.1);
    }
    
    .bg-danger-light {
        background-color: rgba(239, 68, 68, 0.1);
    }
    
    .bg-secondary-light {
        background-color: rgba(107, 114, 128, 0.1);
    }
</style>
@endsection
