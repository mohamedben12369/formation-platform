<?php
    /**
     * Affiche le document PDF sécurisé d'une formation
     */
   

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\TypeFormation;
use App\Models\StatutFormation;
use App\Models\ThemeFormation;
use App\Models\Domaine;
use App\Models\SousDomaine;
use App\Models\Axe;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::with([
            'typeFormation', 
            'statutFormation', 
            'formateurs',
            'themes' => function($query) {
                $query->select('theme_formations.*');
            }
        ])->get();
        
        $types = TypeFormation::all();
        $statuts = StatutFormation::all();
        $themes = ThemeFormation::all();
        $domaines = Domaine::all();
        $sous_domaines = SousDomaine::all();
        $axes = Axe::all();
        
        // Get all users with 'formateur' role
        $formateurs = User::whereHas('role', function ($query) {
            $query->where('nom', 'formateur');
        })->get();
        
        // Get all enterprises
        $entreprises = \App\Models\Entreprise::all();
        
        return view('dashboard.formations.index', compact(
            'formations', 
            'types', 
            'statuts', 
            'themes', 
            'domaines', 
            'sous_domaines', 
            'axes',
            'formateurs',
            'entreprises'
        ));
    }

    public function create()
    {
        $typeFormations = TypeFormation::all();
        $statutFormations = StatutFormation::all();
        $themeFormations = ThemeFormation::all();
        $domaines = Domaine::all();
        $sousDomainesList = SousDomaine::all();
        $axes = Axe::all();
        
        // Get all users with 'formateur' role
        $formateurs = User::whereHas('role', function ($query) {
            $query->where('nom', 'formateur');
        })->get();
        
        // Get all enterprises
        $entreprises = \App\Models\Entreprise::all();
        
        return view('dashboard.formations.create', compact(
            'typeFormations', 
            'statutFormations', 
            'themeFormations', 
            'domaines', 
            'sousDomainesList', 
            'axes', 
            'formateurs',
            'entreprises'
        ));
    }

    public function store(Request $request)
    {
        // Debug: afficher toutes les données reçues
        Log::info('=== DEBUT AJOUT FORMATION ===');
        Log::info('Données POST reçues:', $request->all());
        Log::info('Fichiers reçus:', $request->allFiles());
        
        try {
            Log::info('Démarrage de la validation...');
            
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'dateDebut' => 'required|date',
                'dateFin' => 'required|date|after:dateDebut',
                'lieu' => 'required|string|max:100',
                'DatedeCreation' => 'nullable|date',
                'nombre_ouvriers' => 'nullable|integer|min:0',
                'nombre_encadrants' => 'nullable|integer|min:0',
                'nombre_cadres' => 'nullable|integer|min:0',
                'moyennes' => 'nullable|string',
                'programme' => 'required|string',
                'objectifs' => 'required|string',
                'type_formation_id' => 'required|exists:type_formations,id',
                'statut_formation_id' => 'required|exists:statut_formations,id',
                'domaine_id' => 'nullable|exists:domaines,id',
                'entreprise_id' => 'nullable|exists:entreprises,id',
                'themes' => 'required|array|min:1',
                'themes.*' => 'exists:theme_formations,idtheme',
                'formateurs' => 'nullable|array',
                'formateurs.*' => 'exists:users,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'document_pdf' => 'nullable|file|mimes:pdf|max:10240'
            ]);

            Log::info('Validation réussie! Données validées:', $validated);

            // Gestion de l'upload d'image
            if ($request->hasFile('image')) {
                Log::info('Upload d\'image détecté');
                $imagePath = $request->file('image')->store('formations/images', 'public');
                $validated['image'] = 'storage/' . $imagePath;
                Log::info('Image uploadée:', ['path' => $validated['image']]);
            }

            // Gestion de l'upload de PDF
            if ($request->hasFile('document_pdf')) {
                Log::info('Upload de PDF détecté');
                $pdfPath = $request->file('document_pdf')->store('formations/documents', 'public');
                $validated['document_pdf'] = '/storage/' . $pdfPath;
                Log::info('PDF uploadé:', ['path' => $validated['document_pdf']]);
            }

            $validated['DatedeCreation'] = now();
            
            // Ajouter une durée par défaut si elle n'est pas fournie
            if (!isset($validated['duree'])) {
                $validated['duree'] = 0; // Sera calculée après l'ajout des thèmes
            }
            
            // Les prérequis seront calculés automatiquement à partir des thèmes
            $validated['prerequis'] = '';
            
            Log::info('Données finales avant création:', $validated);
            
            // Créer la formation
            Log::info('Tentative de création de la formation...');
            $formation = Formation::create($validated);
            Log::info('Formation créée avec succès!', ['id' => $formation->id]);

            // Attacher les thèmes avec les données par défaut
            if (!empty($request->themes)) {
                Log::info('Attachement des thèmes:', $request->themes);
                
                // Préparer les données pour chaque thème
                $themesData = [];
                foreach ($request->themes as $themeId) {
                    $theme = ThemeFormation::find($themeId);
                    if ($theme) {
                        $themesData[$themeId] = [
                            'prix' => $theme->prix ?? 0,
                            'duree_heures' => $theme->duree ?? 0,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }
                
                $formation->themes()->attach($themesData);
                Log::info('Thèmes attachés avec succès');
                
                // Recharger la formation avec ses relations pour calculer la durée
                $formation->load('themes');
                $dureeTotale = $formation->duree_totale;
                Log::info('Durée totale calculée:', ['duree' => $dureeTotale]);
                if ($dureeTotale > 0) {
                    $formation->update(['duree' => $dureeTotale]);
                    Log::info('Durée mise à jour');
                }
            }
            
            // Attacher les formateurs
            if (!empty($request->formateurs)) {
                Log::info('Attachement des formateurs:', $request->formateurs);
                $formation->formateurs()->attach($request->formateurs);
                Log::info('Formateurs attachés avec succès');
            }
            
            Log::info('=== AJOUT FORMATION TERMINÉ AVEC SUCCÈS ===');
            
            return redirect()->route('dashboard.formations.index')
                ->with('success', 'Formation ajoutée avec succès.');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('ERREUR DE VALIDATION:', $e->errors());
            return back()
                ->withInput()
                ->withErrors($e->validator);
        } catch (\Exception $e) {
            Log::error('ERREUR LORS DE L\'AJOUT:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()
                ->withInput()
                ->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    public function edit(Formation $formation)
    {
        $typeFormations = TypeFormation::all();
        $statutFormations = StatutFormation::all();
        $themeFormations = ThemeFormation::all();
        $domaines = Domaine::all();
        $sousDomainesList = SousDomaine::all();
        $axes = Axe::all();
        
        // Get all users with 'formateur' role
        $formateurs = User::whereHas('role', function ($query) {
            $query->where('nom', 'formateur');
        })->get();
        
        // Get all enterprises
        $entreprises = \App\Models\Entreprise::all();
        
        return view('dashboard.formations.edit', compact(
            'formation', 
            'typeFormations', 
            'statutFormations', 
            'themeFormations', 
            'domaines', 
            'sousDomainesList', 
            'axes',
            'formateurs',
            'entreprises'
        ));
    }

    public function update(Request $request, Formation $formation)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after:dateDebut',
            'lieu' => 'required|string|max:100',
            'DatedeCreation' => 'nullable|date',
            'nombre_ouvriers' => 'nullable|integer|min:0',
            'nombre_encadrants' => 'nullable|integer|min:0',
            'nombre_cadres' => 'nullable|integer|min:0',
            'moyennes' => 'nullable|string',
            'programme' => 'required|string',
            'objectifs' => 'required|string',
            'type_formation_id' => 'required|exists:type_formations,id',
            'statut_formation_id' => 'required|exists:statut_formations,id',
            'domaine_id' => 'nullable|exists:domaines,id',
            'entreprise_id' => 'nullable|exists:entreprises,id',
            'themes' => 'required|array|min:1',
            'themes.*' => 'exists:theme_formations,idtheme',
            'formateurs' => 'nullable|array',
            'formateurs.*' => 'exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'document_pdf' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        if ($request->hasFile('image')) {
            if ($formation->image) {
                $oldImagePath = str_replace('/storage/', 'public/', $formation->image);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }
            // Enregistrer l'image dans le dossier formations/images
            $imagePath = $request->file('image')->store('formations/images', 'public');
            $validated['image'] = 'storage/' . $imagePath;
            
            // Log l'opération pour débogage
            Log::info('Image mise à jour:', [
                'new_path' => $validated['image'],
                'storage_path' => $imagePath
            ]);
        }

        if ($request->hasFile('document_pdf')) {
            if ($formation->document_pdf) {
                $oldPdfPath = str_replace('/storage/', 'public/', $formation->document_pdf);
                if (Storage::exists($oldPdfPath)) {
                    Storage::delete($oldPdfPath);
                }
            }
            // Enregistrer le PDF dans le dossier formations/documents
            $pdfPath = $request->file('document_pdf')->store('formations/documents', 'public');
            $validated['document_pdf'] = 'storage/' . $pdfPath;
            
            // Log l'opération pour débogage
            Log::info('Document PDF mis à jour:', [
                'new_path' => $validated['document_pdf'],
                'storage_path' => $pdfPath
            ]);
        }

        $formation->update($validated);

        // Synchroniser les thèmes avec leurs données pivot
        if (!empty($request->themes)) {
            $themesData = [];
            foreach ($request->themes as $themeId) {
                $theme = ThemeFormation::find($themeId);
                if ($theme) {
                    // Conserver les données existantes ou utiliser les valeurs par défaut du thème
                    $existingPivot = $formation->themes()->where('theme_id', $themeId)->first();
                    $themesData[$themeId] = [
                        'prix' => $existingPivot ? $existingPivot->pivot->prix : ($theme->prix ?? 0),
                        'duree_heures' => $existingPivot ? $existingPivot->pivot->duree_heures : ($theme->duree ?? 0),
                        'date_debut' => $existingPivot ? $existingPivot->pivot->date_debut : null,
                        'date_fin' => $existingPivot ? $existingPivot->pivot->date_fin : null,
                        'updated_at' => now()
                    ];
                }
            }
            $formation->themes()->sync($themesData);
        } else {
            $formation->themes()->sync([]);
        }
        
        // Recharger et mettre à jour la durée et les prérequis de la formation
        $formation->load('themes');
        $formation->updateFromThemes();
        
        // Synchroniser les formateurs
        if ($request->has('formateurs')) {
            $formation->formateurs()->sync($request->formateurs);
        } else {
            $formation->formateurs()->sync([]);
        }
        
        return redirect()->route('dashboard.formations.index')
            ->with('success', 'Formation modifiée avec succès.');
    }

    public function destroy(Formation $formation)
    {
        $formation->themes()->detach();
        $formation->delete();
        return redirect()->route('dashboard.formations.index')
            ->with('success', 'Formation supprimée avec succès.');
    }
    public function statistiques()
    {
        $statistiques = ThemeFormation::withCount('formations')->get();
        
        $total_formations = $statistiques->sum('formations_count');
        $total_themes = $statistiques->count();
        $themes_sans_formation = $statistiques->where('formations_count', 0)->count();
        
        return view('dashboard.themes.statistiques', compact('statistiques', 'total_formations', 'total_themes', 'themes_sans_formation'));
    }
    public function show(Formation $formation)
    {
        // Charger toutes les relations nécessaires pour l'affichage détaillé
        $formation->load([
            'typeFormation', 
            'statutFormation', 
            'entreprise',
            'domaine',
            'themes' => function($query) {
                $query->select('theme_formations.*');
            },
            'formateurs'
        ]);
        
        return view('dashboard.formations.show', compact('formation'));
    }

    /**
     * Affiche le document PDF sécurisé d'une formation
     *
     * @param Formation $formation
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\RedirectResponse
     */
    public function showDocument(Formation $formation)
    {
        // Vérifier si l'utilisateur a le droit d'accéder au document
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('login');
        }

        // Vérifier si le document existe
        if (!$formation->document_pdf) {
            return back()->withErrors(['error' => 'Le document n\'existe pas.']);
        }

        // Normaliser le chemin du fichier
        $documentPath = $formation->document_pdf;
        
        // Normaliser le chemin pour trouver le fichier physique
        // Si le chemin commence par 'storage/', on l'utilise directement
        if (strpos($documentPath, 'storage/') === 0) {
            $relativePath = substr($documentPath, 8); // Enlever 'storage/'
        } else {
            // Pour la rétrocompatibilité, gérer les anciens formats de chemin
            $relativePath = str_replace(['/storage/', 'storage/'], '', $documentPath);
        }
        
        $fullPath = storage_path('app/public/' . $relativePath);

        Log::info('Tentative d\'accès au document', [
            'document_path' => $documentPath,
            'relative_path' => $relativePath,
            'full_path' => $fullPath,
            'file_exists' => file_exists($fullPath)
        ]);

        if (!file_exists($fullPath)) {
            Log::error('Document PDF non trouvé', [
                'path' => $fullPath, 
                'document_path' => $documentPath
            ]);
            return back()->withErrors(['error' => 'Le document n\'existe pas sur le serveur.']);
        }

        // Retourner le document avec les bons headers
        return response()->file($fullPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($relativePath) . '"'
        ]);
    }
}
