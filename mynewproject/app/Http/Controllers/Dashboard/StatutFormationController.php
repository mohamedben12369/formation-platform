<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\StatutFormation;
use Illuminate\Http\Request;

class StatutFormationController extends Controller
{
    public function index()
    {
        $statuts = StatutFormation::orderBy('code')->get();
        return view('statuts-formation', compact('statuts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:statut_formations',
            'nom' => 'required|string|max:100|unique:statut_formations',
        ]);

        StatutFormation::create([
            'code' => $request->code,
            'nom' => $request->nom,
            'dateCreation' => now()->format('Y-m-d'),
        ]);

        return redirect()->route('dashboard.statut-formations.index')
            ->with('success', 'Statut de formation ajouté avec succès.');
    }

    public function update(Request $request, StatutFormation $statutFormation)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:statut_formations,code,' . $statutFormation->id,
            'nom' => 'required|string|max:100|unique:statut_formations,nom,' . $statutFormation->id,
        ]);

        $statutFormation->update([
            'code' => $request->code,
            'nom' => $request->nom,
        ]);

        return redirect()->route('dashboard.statut-formations.index')
            ->with('success', 'Statut de formation modifié avec succès.');
    }

    public function destroy(StatutFormation $statutFormation)
    {
        $statutFormation->delete();

        return redirect()->route('dashboard.statut-formations.index')
            ->with('success', 'Statut de formation supprimé avec succès.');
    }
} 