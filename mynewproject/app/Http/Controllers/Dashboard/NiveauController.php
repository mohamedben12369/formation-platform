<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    public function index()
    {
        $niveaux = Niveau::all();
        return view('niveaux', compact('niveaux'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Niveau::create($request->all());

        return redirect()->route('dashboard.niveaux.index')
            ->with('success', 'Niveau créé avec succès.');
    }

    public function update(Request $request, Niveau $niveau)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $niveau->update($request->all());

        return redirect()->route('dashboard.niveaux.index')
            ->with('success', 'Niveau mis à jour avec succès.');
    }

    public function destroy(Niveau $niveau)
    {
        $niveau->delete();

        return redirect()->route('dashboard.niveaux.index')
            ->with('success', 'Niveau supprimé avec succès.');
    }
} 