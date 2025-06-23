<?php

namespace App\Http\Controllers\Profile;

use App\Models\Diplome;
use App\Models\TypeDiplome;
use App\Models\Etablissement;
use App\Models\Domaine;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class DiplomeController extends Controller
{    public function index()
    {
        $diplomes = Auth::user()->diplomes;
        $typeDiplomes = TypeDiplome::all();
        $etablissements = Etablissement::all();
        $domaines = Domaine::all();
        $niveaux = Niveau::all();
        
        return view('profile.diplomes', compact('diplomes', 'typeDiplomes', 'etablissements', 'domaines', 'niveaux'));
    }

    public function store(Request $request)
    {        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type_diplome_id' => 'required|exists:type_diplomes,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_obtention' => 'required|date',
            'domaine_id' => 'required|exists:domaines,id',
            'niveau_id' => 'nullable|exists:niveaux,id',
            'description' => 'nullable|string|max:1000',
            'certificat' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:10240',
        ]);

        $diplome = new Diplome($validated);
        $diplome->user_id = Auth::id();

        if ($request->hasFile('certificat')) {
            $path = $request->file('certificat')->store('certificats', 'public');
            $diplome->certificat = $path;
        }

        $diplome->save();

        return redirect()->route('profile.diplomes.index')->with('success', 'Diplôme ajouté avec succès');
    }    public function edit(Diplome $diplome)
    {
        if ($diplome->user_id !== Auth::id()) {
            abort(403, 'Cette action n\'est pas autorisée.');
        }
        
        $typeDiplomes = TypeDiplome::all();
        $etablissements = Etablissement::all();
        $domaines = Domaine::all();
        $niveaux = Niveau::all();
        
        return view('profile.diplomes.edit', compact('diplome', 'typeDiplomes', 'etablissements', 'domaines', 'niveaux'));
    }

    public function update(Request $request, Diplome $diplome)
    {
        if ($diplome->user_id !== Auth::id()) {
            abort(403, 'Cette action n\'est pas autorisée.');
        }        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type_diplome_id' => 'required|exists:type_diplomes,id',
            'etablissement_id' => 'required|exists:etablissements,id',
            'date_obtention' => 'required|date',
            'domaine_id' => 'nullable|exists:domaines,id',
            'niveau_id' => 'nullable|exists:niveaux,id',
            'description' => 'nullable|string|max:1000',
            'certificat' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('certificat')) {
            if ($diplome->certificat) {
                Storage::disk('public')->delete($diplome->certificat);
            }
            $path = $request->file('certificat')->store('certificats', 'public');
            $validated['certificat'] = $path;
        }

        $diplome->update($validated);

        return redirect()->route('profile.diplomes.index')->with('success', 'Diplôme mis à jour avec succès');
    }

    public function destroy(Diplome $diplome)
    {
        if ($diplome->user_id !== Auth::id()) {
            abort(403, 'Cette action n\'est pas autorisée.');
        }

        if ($diplome->certificat) {
            Storage::disk('public')->delete($diplome->certificat);
        }
        
        $diplome->delete();

        return redirect()->route('profile.diplomes.index')->with('success', 'Diplôme supprimé avec succès');
    }

    public function showCertificate($id)
    {
        $diplome = Diplome::findOrFail($id);
        
        if (!$diplome->certificat) {
            abort(404);
        }

        return response()->file(storage_path('app/public/' . $diplome->certificat));
    }
}
