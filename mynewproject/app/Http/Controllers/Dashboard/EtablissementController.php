<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Etablissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EtablissementController extends Controller
{
    public function index()
    {
        $etablissements = Etablissement::all();
        return view('etablissements', compact('etablissements'));
    }

    public function create()
    {
        return view('dashboard.etablissement.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lien_localisation' => 'nullable|url|max:255'
        ]);

        if ($request->hasFile('logo')) {
            // Créer le dossier s'il n'existe pas
            if (!Storage::disk('public')->exists('logos')) {
                Storage::disk('public')->makeDirectory('logos');
            }
            
            // Stocker le logo avec un nom unique
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        Etablissement::create($validated);

        return redirect()->route('dashboard.etablissements.index')
            ->with('success', 'Établissement ajouté avec succès.');
    }

    public function edit(Etablissement $etablissement)
    {
        return view('dashboard.etablissement.edit', compact('etablissement'));
    }

    public function update(Request $request, Etablissement $etablissement)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'lien_localisation' => 'nullable|url|max:255'
        ]);

        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo s'il existe
            if ($etablissement->logo && Storage::disk('public')->exists($etablissement->logo)) {
                Storage::disk('public')->delete($etablissement->logo);
            }
            
            // Créer le dossier s'il n'existe pas
            if (!Storage::disk('public')->exists('logos')) {
                Storage::disk('public')->makeDirectory('logos');
            }
            
            // Stocker le nouveau logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        $etablissement->update($validated);

        return redirect()->route('dashboard.etablissements.index')
            ->with('success', 'Établissement mis à jour avec succès.');
    }

    public function destroy(Etablissement $etablissement)
    {
        if ($etablissement->logo && Storage::disk('public')->exists($etablissement->logo)) {
            Storage::disk('public')->delete($etablissement->logo);
        }
        
        $etablissement->delete();

        return redirect()->route('dashboard.etablissements.index')
            ->with('success', 'Établissement supprimé avec succès.');
    }
} 