<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Types de Diplômes') }}
            </h2>
            <a href="{{ route('dashboard.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Retour au Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Bouton pour ouvrir le modal d'ajout -->
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTypeDiplomeModal">
                        Ajouter un Type de Diplôme
                    </button>

                    <!-- Modal d'ajout -->
                    <div class="modal fade" id="addTypeDiplomeModal" tabindex="-1" aria-labelledby="addTypeDiplomeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('dashboard.type-diplomes.store') }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addTypeDiplomeModalLabel">Ajouter un Type de Diplôme</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="nom" name="nom" required>
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

                    <!-- Liste des types de diplômes -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($typeDiplomes as $type)
                            <tr>
                                <td>{{ $type->id }}</td>
                                <td>{{ $type->nom }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTypeDiplomeModal{{ $type->id }}">
                                        Modifier
                                    </button>
                                    <form action="{{ route('dashboard.type-diplomes.destroy', $type->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type de diplôme ?')">
                                            Supprimer
                                        </button>
                                    </form>

                                    <!-- Modal d'édition -->
                                    <div class="modal fade" id="editTypeDiplomeModal{{ $type->id }}" tabindex="-1" aria-labelledby="editTypeDiplomeModalLabel{{ $type->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('dashboard.type-diplomes.update', $type->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTypeDiplomeModalLabel{{ $type->id }}">Modifier Type de Diplôme</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nom{{ $type->id }}" class="form-label">Nom</label>
                                                            <input type="text" class="form-control" id="nom{{ $type->id }}" name="nom" value="{{ $type->nom }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 