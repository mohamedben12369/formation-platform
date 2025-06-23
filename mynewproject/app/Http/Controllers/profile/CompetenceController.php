<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Support\Facades\Log;
use App\Models\Competence;
use App\Models\Niveau;
use App\Models\SousDomaine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CompetenceController extends Controller
{
    public function index()
    {
        $competences = Auth::user()->competences()
            ->with(['niveau', 'sousDomaine'])
            ->latest()
            ->get();

        $niveaux = Niveau::all();
        $sousDomaines = SousDomaine::select('id', 'code', 'description')->get();

        return view('profile.competences', compact('competences', 'niveaux', 'sousDomaines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'niveau_id' => 'required|exists:niveaux,id',
            'sous_domaines_id' => 'required|exists:sous_domaines,id',
        ]);

        try {
            $competence = Competence::create([
                'nom' => $request->nom,
                'niveau_id' => $request->niveau_id,
                'sous_domaines_id' => $request->sous_domaines_id,
                'user_id' => Auth::id(),
            ]);

            \Illuminate\Support\Facades\Log::info('Nouvelle compétence créée:', ['competence' => $competence->toArray()]);
            return back()->with('success', 'Compétence ajoutée avec succès !');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erreur lors de la création de la compétence:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Une erreur est survenue lors de l\'ajout de la compétence.']);
        }
    }

    public function destroy($id)
    {
        try {
            $competence = Competence::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
                
            $competence->delete();
            \Illuminate\Support\Facades\Log::info('Compétence supprimée:', ['id' => $id]);
            return back()->with('success', 'Compétence supprimée avec succès !');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erreur lors de la suppression de la compétence:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la suppression de la compétence.']);
        }
    }

    public function edit($id)
    {
        try {
            $competence = Competence::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
                
            $niveaux = Niveau::all();
            $sousDomaines = SousDomaine::select('id', 'code', 'description')->get();

            \Illuminate\Support\Facades\Log::info('Édition de compétence:', ['competence' => $competence->toArray()]);
            return view('profile.edit-competence', compact('competence', 'niveaux', 'sousDomaines'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erreur lors de l\'accès à l\'édition de la compétence:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Compétence non trouvée ou non autorisée.']);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'niveau_id' => 'required|exists:niveaux,id',
            'sous_domaines_id' => 'required|exists:sous_domaines,id',
        ]);

        try {
            $competence = Competence::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $competence->update([
                'nom' => $request->nom,
                'niveau_id' => $request->niveau_id,
                'sous_domaines_id' => $request->sous_domaines_id,
            ]);

            \Illuminate\Support\Facades\Log::info('Compétence mise à jour:', ['competence' => $competence->toArray()]);
            return redirect()->route('profile.competences.index')->with('success', 'Compétence mise à jour avec succès !');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Erreur lors de la mise à jour de la compétence:', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour de la compétence.']);
        }
    }

    /**
     * Get competence data for AJAX
     */
    public function show($id)
    {
        try {
            $competence = Competence::where('id', $id)
                ->where('user_id', Auth::id())
                ->with(['niveau', 'sousDomaine'])
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'competence' => $competence
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Compétence non trouvée'
            ], 404);
        }
    }

    /**
     * Store competence via AJAX
     */
    public function storeAjax(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'niveau_id' => 'nullable|exists:niveaux,id',
            'sous_domaine_id' => 'nullable|exists:sous_domaines,id',
        ]);

        try {
            $competence = Competence::create([
                'nom' => $request->nom,
                'niveau_id' => $request->niveau_id,
                'sous_domaines_id' => $request->sous_domaine_id,
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Compétence ajoutée avec succès',
                'competence' => $competence->load(['niveau', 'sousDomaine'])
            ]);
        } catch (\Exception $e) {
            Log::error('Competence store error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout de la compétence'
            ], 500);
        }
    }

    /**
     * Update competence via AJAX
     */
    public function updateAjax(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'niveau_id' => 'nullable|exists:niveaux,id',
            'sous_domaine_id' => 'nullable|exists:sous_domaines,id',
        ]);

        try {
            $competence = Competence::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $competence->update([
                'nom' => $request->nom,
                'niveau_id' => $request->niveau_id,
                'sous_domaines_id' => $request->sous_domaine_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Compétence mise à jour avec succès',
                'competence' => $competence->load(['niveau', 'sousDomaine'])
            ]);
        } catch (\Exception $e) {
            Log::error('Competence update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de la compétence'
            ], 500);
        }
    }

    /**
     * Delete competence via AJAX
     */
    public function destroyAjax($id)
    {
        try {
            $competence = Competence::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $competence->delete();

            return response()->json([
                'success' => true,
                'message' => 'Compétence supprimée avec succès'
            ]);
        } catch (\Exception $e) {
            Log::error('Competence delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de la compétence'
            ], 500);
        }
    }
}
