<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Formation;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    public function index(Request $request)
    {
        $query = Candidature::with(['formation', 'user', 'documents.typeDocument']);
        
        // Filtres
        if ($request->filled('formation_id')) {
            $query->where('formation_id', $request->formation_id);
        }
        
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $candidatures = $query->orderBy('created_at', 'desc')->paginate(15);
        $formations = Formation::orderBy('nom')->get();
        
        return view('dashboard.candidatures.index', compact('candidatures', 'formations'));
    }

    public function show(Candidature $candidature)
    {
        $candidature->load(['formation', 'user', 'documents.typeDocument']);
        
        return view('dashboard.candidatures.show', compact('candidature'));
    }

    public function updateStatut(Request $request, Candidature $candidature)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,accepte,refuse'
        ]);

        $candidature->update([
            'statut' => $request->statut
        ]);

        return redirect()->back()->with('success', 'Statut mis à jour avec succès');
    }

    public function destroy(Candidature $candidature)
    {
        $candidature->delete();
        
        return redirect()->route('dashboard.candidatures.index')
            ->with('success', 'Candidature supprimée avec succès');
    }
}
