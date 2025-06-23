<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThemeFormation;
use App\Models\SousDomaine;
use App\Models\Axe;
use App\Models\Domaine;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ThemeFormationController extends Controller
{
    /**
     * Afficher la liste des thèmes de formation
     */
    public function index()
    {
        try {
            $themes = ThemeFormation::with(['axe', 'sousDomaine.domaine'])
                ->orderBy('idtheme', 'desc')
                ->paginate(5);
            
            return view('themes.index', compact('themes'));
        } catch (\Exception $e) {
            Log::error('Erreur lors du chargement des thèmes:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erreur lors du chargement des thèmes de formation.');
        }
    }

    /**
     * Afficher le formulaire de création d'un thème
     */
    public function create()
    {
        try {
            // Charger tous les sous-domaines et axes directement (plus besoin d'AJAX)
            $sous_domaines = SousDomaine::with('domaine')->orderBy('description')->get();
            $axes = Axe::orderBy('nom')->get();
            
            return view('themes.create', compact('sous_domaines', 'axes'));
        } catch (\Exception $e) {
            Log::error('Erreur lors du chargement du formulaire de création:', ['error' => $e->getMessage()]);
            return redirect()->route('dashboard.theme-formations.index')
                ->with('error', 'Erreur lors du chargement du formulaire.');
        }
    }

    /**
     * Enregistrer un nouveau thème de formation
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            // Validation des données
            $validated = $request->validate([
                'titre' => 'required|string|max:255',
                'sous_domaine_code' => 'required|exists:sous_domaines,code',
                'axes_id' => 'required|exists:axes,id',
                'prix' => 'nullable|numeric|min:0',
                'duree' => 'nullable|integer|min:1',
                'prerequis' => 'nullable|string|max:1000',
                'competence_visees' => 'nullable|string|max:1000'
            ], [
                'titre.required' => 'Le titre est obligatoire',
                'titre.max' => 'Le titre ne doit pas dépasser 255 caractères',
                'sous_domaine_code.required' => 'Le sous-domaine est obligatoire',
                'sous_domaine_code.exists' => 'Le sous-domaine sélectionné n\'existe pas',
                'axes_id.required' => 'L\'axe est obligatoire',
                'axes_id.exists' => 'L\'axe sélectionné n\'existe pas',
                'prix.numeric' => 'Le prix doit être un nombre',
                'prix.min' => 'Le prix ne peut pas être négatif',
                'duree.integer' => 'La durée doit être un nombre entier',
                'duree.min' => 'La durée doit être d\'au moins 1 heure',
                'prerequis.max' => 'Les prérequis ne doivent pas dépasser 1000 caractères',
                'competence_visees.max' => 'Les compétences visées ne doivent pas dépasser 1000 caractères'
            ]);

            // Vérifier que l'axe appartient bien au sous-domaine sélectionné
            $axe = Axe::find($validated['axes_id']);
            $axeThemes = ThemeFormation::where('sous_domaine_code', $validated['sous_domaine_code'])
                ->where('axes_id', $validated['axes_id'])
                ->exists();
            
            // Si aucun thème n'existe avec cette combinaison axe/sous-domaine, on vérifie si c'est valide
            // Pour simplifier, on autorise toute combinaison pour le moment

            $theme = ThemeFormation::create($validated);
            
            DB::commit();
            
            Log::info('Nouveau thème créé:', [
                'id' => $theme->idtheme,
                'titre' => $theme->titre,
                'user_id' => Auth::check() ? Auth::id() : null
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'theme' => $theme->load(['axe', 'sousDomaine.domaine']),
                    'message' => 'Thème de formation créé avec succès.'
                ]);
            }

            return redirect()->route('dashboard.theme-formations.index')
                ->with('success', 'Thème de formation créé avec succès.');

        } catch (ValidationException $e) {
            DB::rollBack();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                    'message' => 'Erreur de validation'
                ], 422);
            }
            
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création du thème:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all()
            ]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur est survenue lors de la création du thème.'
                ], 500);
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création du thème.');
        }
    }

    /**
     * Afficher un thème spécifique
     */
    public function show($id)
    {
        try {
            $theme = ThemeFormation::with(['sousDomaine.domaine', 'axe'])
                ->where('idtheme', $id)
                ->firstOrFail();
            
            return view('theme_formations.show', compact('theme'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'affichage du thème:', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('dashboard.theme-formations.index')
                ->with('error', 'Thème de formation introuvable.');
        }
    }

    /**
     * Afficher le formulaire d'édition d'un thème
     */
    public function edit($id)
    {
        try {
            $theme = ThemeFormation::with(['sousDomaine.domaine', 'axe'])
                ->where('idtheme', $id)
                ->firstOrFail();
            
            $domaines = Domaine::orderBy('nom')->get();
            $sous_domaines = SousDomaine::where('domaine_code', $theme->sousDomaine->domaine_code ?? null)
                ->orderBy('description')
                ->get();
            $axes = Axe::orderBy('nom')->get();
            
            return view('themes.edit', compact('theme', 'domaines', 'sous_domaines', 'axes'));
        } catch (\Exception $e) {
            Log::error('Erreur lors du chargement du formulaire d\'édition:', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('dashboard.theme-formations.index')
                ->with('error', 'Thème de formation introuvable.');
        }
    }

    /**
     * Mettre à jour un thème de formation
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            
            $theme = ThemeFormation::where('idtheme', $id)->firstOrFail();
            
            // Validation des données
            $validated = $request->validate([
                'titre' => 'required|string|max:255',
                'sous_domaine_code' => 'required|exists:sous_domaines,code',
                'axes_id' => 'required|exists:axes,id',
                'prix' => 'nullable|numeric|min:0',
                'duree' => 'nullable|integer|min:1',
                'prerequis' => 'nullable|string|max:1000',
                'competence_visees' => 'nullable|string|max:1000'
            ], [
                'titre.required' => 'Le titre est obligatoire',
                'titre.max' => 'Le titre ne doit pas dépasser 255 caractères',
                'sous_domaine_code.required' => 'Le sous-domaine est obligatoire',
                'sous_domaine_code.exists' => 'Le sous-domaine sélectionné n\'existe pas',
                'axes_id.required' => 'L\'axe est obligatoire',
                'axes_id.exists' => 'L\'axe sélectionné n\'existe pas',
                'prix.numeric' => 'Le prix doit être un nombre',
                'prix.min' => 'Le prix ne peut pas être négatif',
                'duree.integer' => 'La durée doit être un nombre entier',
                'duree.min' => 'La durée doit être d\'au moins 1 heure',
                'prerequis.max' => 'Les prérequis ne doivent pas dépasser 1000 caractères',
                'competence_visees.max' => 'Les compétences visées ne doivent pas dépasser 1000 caractères'
            ]);

            $theme->update($validated);
            
            DB::commit();
            
            Log::info('Thème mis à jour:', [
                'id' => $theme->idtheme,
                'titre' => $theme->titre,
                'user_id' => Auth::id()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'theme' => $theme->load(['axe', 'sousDomaine.domaine']),
                    'message' => 'Thème de formation mis à jour avec succès.'
                ]);
            }

            return redirect()->route('dashboard.theme-formations.index')
                ->with('success', 'Thème de formation mis à jour avec succès.');

        } catch (ValidationException $e) {
            DB::rollBack();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                    'message' => 'Erreur de validation'
                ], 422);
            }
            
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la mise à jour du thème:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur est survenue lors de la mise à jour du thème.'
                ], 500);
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour du thème.');
        }
    }

    /**
     * Supprimer un thème de formation
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $theme = ThemeFormation::where('idtheme', $id)->firstOrFail();
            $titre = $theme->titre; // Sauvegarder le titre pour le message
            
            // Vérifier s'il y a des formations associées (si ce modèle existe)
            // À implémenter selon votre logique métier
            
            $theme->delete();
            
            DB::commit();
            
            Log::info('Thème supprimé:', [
                'id' => $id,
                'titre' => $titre,
                'user_id' => Auth::id()
            ]);
            
            return redirect()->route('dashboard.theme-formations.index')
                ->with('success', "Le thème '$titre' a été supprimé avec succès.");
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la suppression du thème:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->route('dashboard.theme-formations.index')
                ->with('error', 'Une erreur est survenue lors de la suppression du thème.');
        }
    }

    /**
     * API: Récupérer les thèmes par domaine
     */
    public function getThemesByDomaine($domaineId)
    {
        try {
            $themes = ThemeFormation::byDomaine($domaineId)
                ->with(['sousDomaine', 'axe'])
                ->select('idtheme', 'titre', 'prix', 'sous_domaine_code', 'axes_id')
                ->orderBy('titre')
                ->get()
                ->map(function ($theme) {
                    return [
                        'idtheme' => $theme->idtheme,
                        'titre' => $theme->titre,
                        'prix' => $theme->prix,
                        'sous_domaine' => $theme->sousDomaine ? $theme->sousDomaine->description : null,
                        'axe' => $theme->axe ? $theme->axe->nom : null
                    ];
                });

            return response()->json($themes);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des thèmes par domaine:', [
                'domaine_id' => $domaineId,
                'error' => $e->getMessage()
            ]);
            return response()->json([], 500);
        }
    }

    /**
     * API: Récupérer les sous-domaines par domaine (simple)
     */
    public function getSousDomainesSimple($domaineId)
    {
        try {
            $sousDomaines = SousDomaine::where('domaine_code', $domaineId)
                ->select('code', 'description')
                ->orderBy('description')
                ->get();
            
            return response()->json($sousDomaines);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des sous-domaines:', [
                'domaine_id' => $domaineId,
                'error' => $e->getMessage()
            ]);
            return response()->json([], 500);
        }
    }

    /**
     * API: Récupérer les axes par sous-domaine (simple)
     */
    public function getAxesSimple($sousDomaineCode)
    {
        try {
            $axes = Axe::whereHas('themeformation', function ($query) use ($sousDomaineCode) {
                $query->where('sous_domaine_code', $sousDomaineCode);
            })
            ->select('id', 'nom')
            ->orderBy('nom')
            ->get();

            // Si aucun axe n'est trouvé, retourner tous les axes disponibles
            if ($axes->isEmpty()) {
                $axes = Axe::select('id', 'nom')->orderBy('nom')->get();
            }

            return response()->json($axes);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des axes:', [
                'sous_domaine_code' => $sousDomaineCode,
                'error' => $e->getMessage()
            ]);
            return response()->json([], 500);
        }
    }
}
