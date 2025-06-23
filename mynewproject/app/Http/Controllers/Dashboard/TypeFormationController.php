<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TypeFormation;
use Illuminate\Http\Request;

class TypeFormationController extends Controller
{    public function index()
    {
        $typeFormations = TypeFormation::all();
        return view('dashboard.type-formations.index', compact('typeFormations'));
    }    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:type_formations,code',
            'nom' => 'required|string|max:255',
        ]);

        TypeFormation::create($validated);

        return redirect()->route('dashboard.type-formations.index')
            ->with('success', 'Type de formation créé avec succès.');
    }    public function update(Request $request, TypeFormation $typeFormation)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:type_formations,code,' . $typeFormation->id,
            'nom' => 'required|string|max:255',
        ]);

        $typeFormation->update($validated);

        return redirect()->route('dashboard.type-formations.index')
            ->with('success', 'Type de formation mis à jour avec succès.');
    }

    public function destroy(TypeFormation $typeFormation)
    {
        $typeFormation->delete();

        return redirect()->route('dashboard.type-formations.index')
            ->with('success', 'Type de formation supprimé avec succès.');
    }
} 