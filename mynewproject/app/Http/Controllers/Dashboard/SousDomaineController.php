<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SousDomaine;
use App\Models\Domaine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SousDomaineController extends Controller
{
    /**
     * Afficher la liste des sous-domaines.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Charger les sous-domaines avec leurs relations, paginés par 5 éléments
            $sousDomaines = SousDomaine::with(['domaine', 'themes'])
                ->orderBy('created_at', 'desc')
                ->paginate(5)
                ->onEachSide(1)
                ->withPath(route('dashboard.sous-domaines.index'));
                
            // Récupérer tous les domaines pour le formulaire d'ajout
            $domaines = Domaine::orderBy('nom')->get();
            
            // Retourner la vue avec les données
            return view('sous-domaines-new', compact('sousDomaines', 'domaines'));
        } catch (\Exception $e) {
            Log::error('Erreur lors du chargement des sous-domaines: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors du chargement des sous-domaines.');
        }
    }

    /**
     * Afficher le formulaire de création d'un sous-domaine.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        try {
            $domaines = Domaine::orderBy('nom')->get();
            return view('sous-domaines.create', compact('domaines'));
        } catch (\Exception $e) {
            Log::error('Erreur lors du chargement du formulaire de création: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors du chargement du formulaire.');
        }
    }

    /**
     * Enregistrer un nouveau sous-domaine.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            // Validation des données
            $validated = $request->validate([
                'code' => 'required|string|max:10|unique:sous_domaines,code',
                'description' => 'required|string|max:255',
                'domaine_code' => 'required|exists:domaines,id'
            ], [
                'code.required' => 'Le code du sous-domaine est obligatoire.',
                'code.unique' => 'Ce code de sous-domaine existe déjà.',
                'description.required' => 'La description est obligatoire.',
                'domaine_code.required' => 'Veuillez sélectionner un domaine.',
                'domaine_code.exists' => 'Le domaine sélectionné n\'existe pas.'
            ]);
            
            // Création du sous-domaine
            SousDomaine::create($validated);
            
            // Redirection avec message de succès
            return redirect()->route('dashboard.sous-domaines.index')
                ->with('success', 'Sous-domaine créé avec succès.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du sous-domaine: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la création du sous-domaine.')
                ->withInput();
        }
    }

    /**
     * Afficher les détails d'un sous-domaine spécifique.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $sousDomaine = SousDomaine::with(['domaine', 'themes'])->findOrFail($id);
            return view('sous-domaines.show', compact('sousDomaine'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'affichage du sous-domaine: ' . $e->getMessage());
            return redirect()->route('dashboard.sous-domaines.index')
                ->with('error', 'Le sous-domaine demandé n\'existe pas ou a été supprimé.');
        }
    }

    /**
     * Afficher le formulaire d'édition d'un sous-domaine.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $sousDomaine = SousDomaine::findOrFail($id);
            $domaines = Domaine::orderBy('nom')->get();
            return view('sous-domaines.edit', compact('sousDomaine', 'domaines'));
        } catch (\Exception $e) {
            Log::error('Erreur lors du chargement du formulaire d\'édition: ' . $e->getMessage());
            return redirect()->route('dashboard.sous-domaines.index')
                ->with('error', 'Le sous-domaine demandé n\'existe pas ou a été supprimé.');
        }
    }

    /**
     * Mettre à jour un sous-domaine spécifique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SousDomaine  $sousDomaine
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, SousDomaine $sousDomaine)
    {
        try {
            // Validation des données avec règles spécifiques pour l'update
            $validated = $request->validate([
                'code' => [
                    'required',
                    'string',
                    'max:10',
                    Rule::unique('sous_domaines')->ignore($sousDomaine->id)
                ],
                'description' => 'required|string|max:255',
                'domaine_code' => 'required|exists:domaines,id'
            ], [
                'code.required' => 'Le code du sous-domaine est obligatoire.',
                'code.unique' => 'Ce code de sous-domaine existe déjà.',
                'description.required' => 'La description est obligatoire.',
                'domaine_code.required' => 'Veuillez sélectionner un domaine.',
                'domaine_code.exists' => 'Le domaine sélectionné n\'existe pas.'
            ]);

            // Mise à jour du sous-domaine avec les données validées uniquement
            $sousDomaine->update($validated);

            // Redirection avec message de succès
            return redirect()->route('dashboard.sous-domaines.index')
                ->with('success', 'Sous-domaine mis à jour avec succès.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour du sous-domaine: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour du sous-domaine.')
                ->withInput();
        }
    }

    /**
     * Supprimer un sous-domaine spécifique.
     *
     * @param  \App\Models\SousDomaine  $sousDomaine
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(SousDomaine $sousDomaine)
    {
        try {
            // Vérifier si le sous-domaine a des thèmes associés
            $themeCount = $sousDomaine->themes()->count();
            
            if ($themeCount > 0) {
                return redirect()->back()
                    ->with('error', 'Impossible de supprimer ce sous-domaine car il est associé à ' . $themeCount . ' thème(s) de formation.');
            }
            
            // Supprimer le sous-domaine
            $sousDomaine->delete();

            // Redirection avec message de succès
            return redirect()->route('dashboard.sous-domaines.index')
                ->with('success', 'Sous-domaine supprimé avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression du sous-domaine: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la suppression du sous-domaine.');
        }
    }

    /**
     * Create a new sous-domaine via API
     */
    public function apiStore(Request $request)
    {
        try {
            Log::info('Données reçues:', $request->all());
            
            $validated = $request->validate([
                'code' => 'required|string|max:10|unique:sous_domaines,code',
                'description' => 'required|string|max:255',
                'domaine_code' => 'required|exists:domaines,id'
            ], [
                'code.required' => 'Le code du sous-domaine est obligatoire',
                'code.max' => 'Le code ne doit pas dépasser 10 caractères',
                'code.unique' => 'Ce code de sous-domaine existe déjà',
                'description.required' => 'La description est obligatoire',
                'domaine_code.required' => 'Le domaine est obligatoire',
                'domaine_code.exists' => 'Le domaine sélectionné n\'existe pas'
            ]);
            
            DB::beginTransaction();
            
            try {
                $sousDomaine = SousDomaine::create($validated);
                DB::commit();
                
                return response()->json([
                    'success' => true,
                    'sous_domaine' => $sousDomaine,
                    'message' => 'Sous-domaine créé avec succès'
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (ValidationException $e) {
            Log::error('Erreur de validation:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du sous-domaine:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la création du sous-domaine'
            ], 500);
        }
    }

    /**
     * Get themes for a specific sous-domaine
     */
    public function getThemes($code)
    {
        try {
            // Récupérer le sous-domaine avec son domaine associé
            $sousDomaine = SousDomaine::with('domaine')
                ->where('code', $code)
                ->firstOrFail();

            // Récupérer tous les thèmes qui appartiennent à ce sous-domaine
            // et qui sont associés au bon domaine
            $themes = \App\Models\ThemeFormation::with(['sousDomaine.domaine'])
                ->where('sous_domaine_code', $code)
                ->byDomaine($sousDomaine->domaine_code)
                ->get(['idtheme', 'titre', 'prix'])
                ->map(function($theme) {
                    return [
                        'idtheme' => $theme->idtheme,
                        'titre' => $theme->titre,
                        'prix' => $theme->prix
                    ];
                });
            
            Log::info('Thèmes trouvés:', ['count' => $themes->count(), 'sous_domaine' => $code]);
            return response()->json($themes);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des thèmes:', ['error' => $e->getMessage()]);
            return response()->json([]);
        }
    }

    public function getSousDomainesAvecThemes($domaineId)
    {
        try {
            Log::info('Récupération des sous-domaines pour le domaine: ' . $domaineId);
            
            $sousDomaines = SousDomaine::where('domaine_code', $domaineId)
                ->with(['domaine', 'themes'])
                ->get();

            Log::info('Nombre de sous-domaines trouvés: ' . $sousDomaines->count());
            
            return response()->json($sousDomaines);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des sous-domaines: ' . $e->getMessage());
            return response()->json(['error' => 'Une erreur est survenue'], 500);
        }
    }

    /**
     * Récupérer les sous-domaines pour un domaine donné
     */
    public function getSousDomainesParDomaine($domaineId)
    {
        try {
            $sousDomaines = SousDomaine::where('domaine_code', $domaineId)
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
            Log::error('Erreur lors de la récupération des sous-domaines:', ['error' => $e->getMessage()]);
            return response()->json([], 500);
        }
    }
}
