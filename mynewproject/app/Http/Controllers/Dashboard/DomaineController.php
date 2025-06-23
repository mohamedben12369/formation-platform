<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Domaine;
use Illuminate\Http\Request;

class DomaineController extends Controller
{
    public function index()
    {
        $domaines = Domaine::paginate(5);
        return view('domaines', compact('domaines'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required|string|max:255|unique:domaines'
            ]);

            $domaine = Domaine::create($validated);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'domaine' => $domaine,
                    'message' => 'Domaine créé avec succès'
                ]);
            }

            return redirect()->route('dashboard.domaines.index')
                ->with('success', 'Domaine créé avec succès.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }

            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, Domaine $domaine)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required|string|max:255|unique:domaines,nom,' . $domaine->id
            ]);

            $domaine->update($validated);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'domaine' => $domaine,
                    'message' => 'Domaine mis à jour avec succès'
                ]);
            }

            return redirect()->route('dashboard.domaines.index')
                ->with('success', 'Domaine mis à jour avec succès.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }

            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy(Domaine $domaine)
    {
        try {
            $domaine->delete();

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Domaine supprimé avec succès'
                ]);
            }

            return redirect()->route('dashboard.domaines.index')
                ->with('success', 'Domaine supprimé avec succès.');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }

            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Get all sous-domaines for a specific domaine (API endpoint)
     */
    public function getSousDomaines($id)
    {
        try {
            $domaine = Domaine::findOrFail($id);
            $sousDomaines = $domaine->sousDomaines()
                ->select('id', 'code', 'description')
                ->orderBy('description')
                ->get()
                ->map(function($sousDomaine) {
                    return [
                        'id' => $sousDomaine->id,
                        'code' => $sousDomaine->code,
                        'description' => $sousDomaine->description,
                        'label' => $sousDomaine->code . ' - ' . $sousDomaine->description
                    ];
                });
            
            return response()->json($sousDomaines);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors du chargement des sous-domaines'], 500);
        }
    }

    /**
     * Create a new domaine via API
     */
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:domaines',
        ]);

        $domaine = Domaine::create($validated);

        return response()->json($domaine, 201);
    }
}
