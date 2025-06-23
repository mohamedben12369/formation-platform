<div class="domaines-section">
    <h2>Domaines</h2>
    <a href="{{ route('dashboard.index') }}" class="btn btn-primary mb-3">Ajouter un domaine</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse(($domaines ?? collect()) as $domaine)
                <tr>
                    <td>{{ $domaine->id }}</td>
                    <td>{{ $domaine->nom }}</td>
                    <td>{{ $domaine->description }}</td>
                    <td>
                        <a href="{{ route('dashboard', $domaine) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('dashboard', $domaine) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce domaine ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Aucun domaine trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
