<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Formation;

use App\Http\Controllers\Profile\{ProfileController, ExperienceController, DiplomeController, CompetenceController};
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PermissionController as AdminPermissionController;
use App\Http\Controllers\SecuriteQuestionController;
use App\Http\Controllers\Dashboard\SecuriteQuestionController as DashboardSecuriteQuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AxeController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\TypeExperienceController;
use App\Http\Controllers\TypeDiplomeController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\ThemeFormationController;
use App\Http\Controllers\SousDomaineController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\TypeFormationController;
use App\Http\Controllers\Dashboard\{
    FormationController as DashboardFormationController,
    AxeController as DashboardAxeController,
    DomaineController as DashboardDomaineController,
    SousDomaineController as DashboardSousDomaineController,
    ThemeFormationController as DashboardThemeFormationController,
    TypeDiplomeController as DashboardTypeDiplomeController,
    EtablissementController as DashboardEtablissementController,
    TypeFormationController as DashboardTypeFormationController,
    StatutFormationController,
    NiveauController as DashboardNiveauController,
    TypeExperienceController as DashboardTypeExperienceController,
    EntrepriseController,
    UserController as DashboardUserController,
    FormateurController as DashboardFormateurController,
    CandidatureController as DashboardCandidatureController
};
use App\Http\Controllers\CandidatureController;

// ------------------------------
// Routes publiques
// ------------------------------
Route::get('/', function () {
    $formations = Formation::with(['typeFormation', 'statutFormation', 'themes', 'entreprise'])->get();
    return view('welcome', compact('formations'));
})->name('welcome');

// Routes publiques pour les formations
Route::get('/formations/{formation}', [DashboardFormationController::class, 'show'])->name('formations.show');

// Routes publiques pour les candidatures
Route::get('/candidatures', function () {
    $formations = Formation::with(['typeFormation', 'statutFormation', 'themes', 'entreprise'])->get();
    return view('candidatures.index', compact('formations'));
})->name('candidatures.index');
Route::get('/formations/{formation}/candidater', [CandidatureController::class, 'create'])->name('candidatures.create');
Route::post('/formations/{formation}/candidater', [CandidatureController::class, 'store'])->name('candidatures.store');
Route::get('/candidatures/documents/{document}/download', [CandidatureController::class, 'downloadDocument'])->name('candidatures.download-document');
Route::get('/candidatures/documents/{document}/view', [CandidatureController::class, 'viewDocument'])->name('candidatures.view-document');

Route::view('/home', 'redirect')->name('home');
Route::view('/decouvrez-nous', 'decouvrez-nous')->name('decouvrez-nous');
Route::view('/about', 'about')->name('about');

// API route for sous-domaines (added for direct access without middleware)
Route::get('/api/domaines/{domaineId}/sous-domaines', [DashboardSousDomaineController::class, 'getSousDomainesParDomaine'])
    ->name('api.sous-domaines.direct');

Route::get('/ops', function () {
    try {
        DB::connection()->getPdo();
        return "✅ Connexion réussie à la base : " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "❌ Erreur : " . $e->getMessage();
    }
});

// Auth routes
require __DIR__.'/auth.php';

// ------------------------------
// Routes Authentifiées
// ------------------------------
Route::middleware(['auth'])->group(function () {
    
    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Group all profile related routes
    Route::prefix('profile')->name('profile.')->group(function () {
        // Profile overview
        Route::get('/show', [ProfileController::class, 'show'])->name('show');
        
        // Competence routes
        Route::get('/competences', [CompetenceController::class, 'index'])->name('competences.index');
        Route::post('/competences', [CompetenceController::class, 'store'])->name('competences.store');
        Route::get('/competences/{competence}/edit', [CompetenceController::class, 'edit'])->name('competences.edit');
        Route::put('/competences/{competence}', [CompetenceController::class, 'update'])->name('competences.update');
        Route::delete('/competences/{competence}', [CompetenceController::class, 'destroy'])->name('competences.destroy');

        // Experience routes
        Route::resource('experiences', ExperienceController::class)->except(['show']);
        Route::get('/experiences/{experience}/attestation', [ExperienceController::class, 'showAttestation'])->name('experiences.attestation');

        // Diplome routes
        Route::resource('diplomes', DiplomeController::class)->except(['show', 'create']);
        Route::get('/diplomes/{diplome}/certificat', [DiplomeController::class, 'showCertificate'])->name('diplomes.certificat');

        // Other profile routes
        Route::get('/information', function() {
            $user = \App\Models\User::with('securiteQuestion')->find(Auth::id());
            $securiteQuestions = \App\Models\SecuriteQuestion::all();
            return view('profile.information', compact('user', 'securiteQuestions'));
        })->name('information');
        Route::view('/password', 'profile.password')->name('password');
        Route::view('/delete', 'profile.delete')->name('delete');
        Route::view('/settings', 'profile.settings')->name('settings');
        Route::view('/test-upload', 'profile.test-upload')->name('test-upload');
        
        // Image upload routes
        Route::post('/update-photo', [ProfileController::class, 'updateProfilePhoto'])->name('update.photo');
        Route::delete('/delete-photo', [ProfileController::class, 'deleteProfilePhoto'])->name('delete.photo');
        Route::post('/update-background', [ProfileController::class, 'updateBackgroundPhoto'])->name('update.background');
        Route::delete('/delete-background', [ProfileController::class, 'deleteBackgroundPhoto'])->name('delete.background');
    });

    // Dashboard routes
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/statistiques-generales', [DashboardController::class, 'statistiquesGenerales'])->name('statistiques-generales');
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::get('/permissions', [AdminPermissionController::class, 'index'])->name('permissions.index');
    });

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // ------------------------------
    // Dashboard
    // ------------------------------
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        // Routes pour les statistiques détaillées
        Route::prefix('statistiques')->name('statistiques.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Dashboard\StatistiquesController::class, 'index'])->name('index');
            Route::get('/competences', [\App\Http\Controllers\Dashboard\StatistiquesController::class, 'competences'])->name('competences');
            Route::get('/diplomes', [\App\Http\Controllers\Dashboard\StatistiquesController::class, 'diplomes'])->name('diplomes');
            Route::get('/experiences', [\App\Http\Controllers\Dashboard\StatistiquesController::class, 'experiences'])->name('experiences');
        });

        Route::view('/questions', 'dashboard.questions')->name('questions');

        Route::resource('formations', DashboardFormationController::class);
        // Attention à l'ordre des routes - les routes avec des paramètres doivent être après les routes statiques
        Route::get('formations/statistiques', [DashboardFormationController::class, 'statistiques'])->name('formations.statistiques');
        Route::get('formations/{formation}/document', [DashboardFormationController::class, 'showDocument'])->name('formations.document');

        // Routes pour la gestion des candidatures
        Route::resource('candidatures', DashboardCandidatureController::class)->only(['index', 'show', 'destroy']);
        Route::put('candidatures/{candidature}/statut', [DashboardCandidatureController::class, 'updateStatut'])->name('candidatures.update-statut');

        Route::resource('axes', DashboardAxeController::class)->except(['show']);
        Route::resource('domaines', DashboardDomaineController::class)->except(['show']);
        Route::resource('sous-domaines', DashboardSousDomaineController::class)->except(['show']);
        Route::resource('theme-formations', DashboardThemeFormationController::class)->except(['show']);
        Route::resource('type-diplomes', DashboardTypeDiplomeController::class)->except(['show']);
        Route::resource('etablissements', DashboardEtablissementController::class)->except(['show']);
        Route::resource('statut-formations', StatutFormationController::class)->except(['show', 'create', 'edit']);
        Route::resource('type-experiences', DashboardTypeExperienceController::class)->except(['show']);
        Route::resource('niveaux', DashboardNiveauController::class)->except(['show']);
        Route::resource('type-formations', DashboardTypeFormationController::class)->except(['show']);
        Route::resource('entreprises', EntrepriseController::class)->except(['show']);
        Route::resource('formateurs', DashboardFormateurController::class);
        Route::resource('securite-questions', DashboardSecuriteQuestionController::class)->except(['show']);
        Route::resource('roles', AdminRoleController::class)->except(['show']);

        // Routes pour les candidatures
        Route::resource('candidatures', DashboardCandidatureController::class)->only(['index', 'show', 'destroy']);
        Route::put('/candidatures/{candidature}/statut', [DashboardCandidatureController::class, 'updateStatut'])->name('candidatures.update-statut');

        // Routes pour les types de documents
        Route::resource('type-documents', \App\Http\Controllers\Dashboard\TypeDocumentController::class);
        Route::put('/type-documents/{typeDocument}/toggle-actif', [\App\Http\Controllers\Dashboard\TypeDocumentController::class, 'toggleActif'])->name('type-documents.toggle-actif');

        Route::get('/diplomes', [DiplomeController::class, 'index'])->name('diplomes.index');
    });

    // Routes pour l'espace entreprise
    Route::prefix('entreprise')->name('entreprise.')->group(function () {
        Route::get('/dashboard', function () {
            $entreprise = Auth::user()->entreprise;
            if (!$entreprise) {
                return redirect()->route('entreprise.create')
                    ->with('warning', 'Vous devez d\'abord créer votre entreprise.');
            }
            return view('entreprise.dashboard', compact('entreprise'));
        })->name('dashboard');

        Route::get('/create', function () {
            if (Auth::user()->entreprise) {
                return redirect()->route('entreprise.dashboard')
                    ->with('info', 'Vous avez déjà une entreprise enregistrée.');
            }
            return view('entreprise.create');
        })->name('create');

        Route::post('/', function (Illuminate\Http\Request $request) {
            $validated = $request->validate([
                'nom' => 'required|string|max:100',
                'email' => 'required|email|max:100|unique:entreprises',
                'Adresse' => 'required|string|max:255',
                'tel' => 'required|string|max:20',
                'fax' => 'nullable|string|max:20',
                'CNSS' => 'required|string|max:50',
            ]);
            
            // Add the currently authenticated user's ID
            $validated['user_id'] = Auth::id();
            
            // Create the enterprise
            App\Models\Entreprise::create($validated);
            
            return redirect()->route('entreprise.dashboard')
                ->with('success', 'Votre entreprise a été créée avec succès.');
        })->name('store');
    });
});

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        
        // Photo upload routes
        Route::post('/update-photo', [ProfileController::class, 'updateProfilePhoto'])->name('update.photo');
        Route::delete('/delete-photo', [ProfileController::class, 'deleteProfilePhoto'])->name('delete.photo');
        Route::post('/update-background', [ProfileController::class, 'updateBackgroundPhoto'])->name('update.background');
        Route::delete('/delete-background', [ProfileController::class, 'deleteBackgroundPhoto'])->name('delete.background');
    });
});

// Debug route for profile image
Route::get('/debug-profile-image', function () {
    if (!Auth::check()) {
        return response()->json(['error' => 'Utilisateur non connecté']);
    }
    
    $user = Auth::user();
    
    $debug = [
        'user_id' => $user->id,
        'user_name' => $user->name,
        'image_field' => $user->image,
        'image_exists' => $user->image ? true : false,
        'storage_path' => $user->image ? storage_path('app/public/' . $user->image) : null,
        'file_exists' => $user->image ? file_exists(storage_path('app/public/' . $user->image)) : false,
        'public_url' => $user->image ? asset('storage/' . $user->image) : null,
        'storage_url' => $user->image ? \Illuminate\Support\Facades\Storage::url($user->image) : null,
        'fallback_avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=667eea&color=fff&size=128',
    ];
    
    return response()->json($debug, 200, [], JSON_PRETTY_PRINT);
})->name('debug.profile.image')->middleware('auth');

// ------------------------------
// API Routes (AJAX par ex.)
// ------------------------------
Route::prefix('api')->group(function () {
    Route::get('/domaines/{id}/sous-domaines', [DashboardDomaineController::class, 'getSousDomaines']);
    Route::post('/domaines', [DashboardDomaineController::class, 'apiStore']);
    Route::get('/sous-domaines/{code}/themes', [DashboardSousDomaineController::class, 'getThemes']);

    Route::post('/themes', function (Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'domaine_id' => 'required|exists:domaines,id',
            'sous_domaine_code' => 'required|exists:sous_domaines,code',
        ]);

        $theme = new \App\Models\ThemeFormation();
        $theme->titre = $validated['titre'];
        $theme->description = $validated['description'];
        $theme->domaine_id = $validated['domaine_id'];
        $theme->sous_domaine_code = $validated['sous_domaine_code'];
        $theme->save();

        return response()->json($theme);
    });

    // Routes API temporaires pour test des thèmes
    Route::get('/test-themes/domaine/{domaine_id}', function($domaine_id) {
        try {
            $themes = \App\Models\ThemeFormation::byDomaine($domaine_id)
                ->with(['sousDomaine', 'axe'])
                ->get(['idtheme', 'titre', 'prix', 'sous_domaine_code', 'axes_id'])
                ->map(function($theme) {
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
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });

    Route::get('/test-axes/sous-domaine/{sous_domaine_code}', function($sous_domaine_code) {
        try {
            $axes = \App\Models\Axe::whereHas('themeformation', function($q) use ($sous_domaine_code) {
                $q->where('sous_domaine_code', $sous_domaine_code);
            })->get(['id', 'nom']);
            
            // Si aucun axe n'est trouvé, retourner tous les axes
            if ($axes->isEmpty()) {
                $axes = \App\Models\Axe::select('id', 'nom')->orderBy('nom')->get();
            }
            
            return response()->json($axes);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });

    // Route de test pour vérifier les données
    Route::get('/test-data', function() {
        try {
            $domaines = \App\Models\Domaine::all(['id', 'nom']);
            $sousDomaines = \App\Models\SousDomaine::all(['id', 'code', 'description', 'domaine_code']);
            $axes = \App\Models\Axe::all(['id', 'nom']);
            
            return response()->json([
                'domaines' => $domaines,
                'sous_domaines' => $sousDomaines,
                'axes' => $axes,
                'count' => [
                    'domaines' => $domaines->count(),
                    'sous_domaines' => $sousDomaines->count(),
                    'axes' => $axes->count()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    });

    // Routes simples pour le formulaire de thème
    Route::get('/api/get-sous-domaines/{domaine_id}', [DashboardThemeFormationController::class, 'getSousDomainesSimple']);
    Route::get('/api/get-axes/{sous_domaine_code}', [DashboardThemeFormationController::class, 'getAxesSimple']);
});
