@extends('layouts.app')

@section('content')
<div class="container-fluid p-4">
    <h2>Ajouter un utilisateur</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('dashboard.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Téléphone</label>
            <input type="text" name="tel" id="tel" class="form-control" value="{{ old('tel') }}">
        </div>
        <div class="mb-3">
            <label for="date_de_naissance" class="form-label">Date de naissance</label>
            <input type="date" name="date_de_naissance" id="date_de_naissance" class="form-control" value="{{ old('date_de_naissance') }}">
        </div>
        <div class="mb-3">
            <label for="role_id" class="form-label">Rôle</label>
            <select name="role_id" id="role_id" class="form-select" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="securite_question_id" class="form-label">Question de sécurité</label>
            <select name="securite_question_id" id="securite_question_id" class="form-select">
                @foreach($securiteQuestions as $question)
                    <option value="{{ $question->id }}" {{ old('securite_question_id') == $question->id ? 'selected' : '' }}>{{ $question->question }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="reponse" class="form-label">Réponse à la question de sécurité</label>
            <input type="text" name="reponse" id="reponse" class="form-control" value="{{ old('reponse') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Statut du compte</label><br>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Activer le compte</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Permissions</label>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm{{ $permission->id }}" {{ (collect(old('permissions'))->contains($permission->id)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perm{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
