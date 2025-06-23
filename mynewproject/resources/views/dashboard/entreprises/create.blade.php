@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ajouter une entreprise</h5>
                    <a href="{{ route('dashboard.entreprises.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>                <div class="card-body">
                    <form action="{{ route('dashboard.entreprises.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nom" class="form-label">Nom de l'entreprise <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="Adresse" class="form-label">Adresse <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('Adresse') is-invalid @enderror" id="Adresse" name="Adresse" value="{{ old('Adresse') }}" required>
                            @error('Adresse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tel" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('tel') is-invalid @enderror" id="tel" name="tel" value="{{ old('tel') }}" required>
                                    @error('tel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="fax" class="form-label">Fax <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('fax') is-invalid @enderror" id="fax" name="fax" value="{{ old('fax') }}" required>
                                    @error('fax')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="CNSS" class="form-label">CNSS <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('CNSS') is-invalid @enderror" id="CNSS" name="CNSS" value="{{ old('CNSS') }}" required>
                                    @error('CNSS')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="user_id" class="form-label">Utilisateur associé <span class="text-danger">*</span></label>
                                    <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                        <option value="">Sélectionner un utilisateur</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="IF" class="form-label">Identifiant Fiscal (IF)</label>
                                    <input type="text" class="form-control @error('IF') is-invalid @enderror" id="IF" name="IF" value="{{ old('IF') }}">
                                    @error('IF')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="RC" class="form-label">Registre de Commerce (RC)</label>
                                    <input type="text" class="form-control @error('RC') is-invalid @enderror" id="RC" name="RC" value="{{ old('RC') }}">
                                    @error('RC')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="ICE" class="form-label">Identifiant Commun de l'Entreprise (ICE)</label>
                                    <input type="text" class="form-control @error('ICE') is-invalid @enderror" id="ICE" name="ICE" value="{{ old('ICE') }}">
                                    @error('ICE')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="patente" class="form-label">Patente</label>
                                    <input type="text" class="form-control @error('patente') is-invalid @enderror" id="patente" name="patente" value="{{ old('patente') }}">
                                    @error('patente')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>                        <div class="form-group mb-3">
                            <label for="date_creation" class="form-label">Date de création</label>
                            <input type="date" class="form-control @error('date_creation') is-invalid @enderror" id="date_creation" name="date_creation" value="{{ old('date_creation') }}">
                            @error('date_creation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="website" class="form-label">Site web</label>
                                    <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}" placeholder="https://www.example.com">
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="image" class="form-label">Logo de l'entreprise</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
