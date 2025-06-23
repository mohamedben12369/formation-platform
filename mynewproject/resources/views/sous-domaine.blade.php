<tr>
    <form method="POST" action="{{ route('sous_domaines.update', $sousDomaine->id) }}" class="d-inline">
        @csrf
        @method('PUT')
        <td><input type="text" name="code" value="{{ $sousDomaine->code }}" class="form-control" required></td>
        <td><input type="text" name="description" value="{{ $sousDomaine->description }}" class="form-control"></td>
        <td>
            <select name="domaine_code" class="form-control" required>
                @foreach($domaines as $domaine)
                    <option value="{{ $domaine->id }}" @if($sousDomaine->domaine_code == $domaine->id) selected @endif>{{ $domaine->nom }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <button class="btn btn-sm btn-warning" type="submit">Modifier</button>
    </form>
    <form method="POST" action="{{ route('sous_domaines.destroy', $sousDomaine->id) }}" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
    </form>
        </td>
</tr>
