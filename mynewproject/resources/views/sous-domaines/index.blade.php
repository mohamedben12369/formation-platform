<div class="container mt-4 sous-domaines-section">
    <h2>Sous Domaines</h2>
    <a href="{{ route('sous-domaines.create') }}" class="btn btn-primary mb-3">Ajouter un sous domaine</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Code</th>
                <th>Description</th>
                <th>Domaine</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse(($sous_domaines ?? collect()) as $sousDomaine)
                <tr>
                    <td>{{ $sousDomaine->code }}</td>
                    <td>{{ $sousDomaine->description }}</td>
                    <td>{{ optional(($domaines ?? collect())->where('id', $sousDomaine->domaine_code)->first())->nom }}</td>
                    <td>
                        <a href="{{ route('sous-domaines.edit', $sousDomaine->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('sous-domaines.destroy', $sousDomaine->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce sous domaine ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Aucun sous-domaine trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
