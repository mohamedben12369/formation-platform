@extends('layouts.app')

@section('content')
<div class="container mt-4 theme-formations-section">
    <h2>Thèmes de Formation</h2>
    <a href="{{ route('dashboard.theme-formations.create') }}" class="btn btn-primary mb-3">Ajouter un thème</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Sous Domaine</th>
                <th>Domaine</th>
                <th>Axe</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse(($theme_formations ?? collect()) as $theme)
                <tr>
                    <td>{{ $theme->titre }}</td>
                    <td>{{ optional(($sous_domaines ?? collect())->where('code', $theme->sous_domaine_code)->first())->description }}</td>
                    <td>{{ optional(($domaines ?? collect())->where('id', optional(($sous_domaines ?? collect())->where('code', $theme->sous_domaine_code)->first())->domaine_code)->first())->nom ?? '' }}</td>
                    <td>{{ optional(($axes ?? collect())->where('id', $theme->axes_id)->first())->nom }}</td>
                    <td>
                        <a href="{{ route('dashboard.theme-formations.edit', $theme->idtheme) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('dashboard.theme-formations.destroy', $theme->idtheme) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce thème ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Aucun thème de formation trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
