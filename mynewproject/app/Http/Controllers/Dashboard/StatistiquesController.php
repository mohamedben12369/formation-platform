<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use App\Models\Diplome;
use App\Models\Experience;
use App\Models\TypeDiplome;
use App\Models\Formation;
use App\Models\ThemeFormation;

class StatistiquesController extends Controller
{    public function index()
    {
        $totalCompetences = Competence::count();
        
        $data = [
            'formationsCount' => Formation::count(),
            'themeFormationsCount' => ThemeFormation::count(), 
            'totalCompetences' => $totalCompetences,
            'completedCompetences' => intval($totalCompetences * 0.7), // Approximation basée sur le total
            'inProgressCompetences' => intval($totalCompetences * 0.3), // Approximation basée sur le total
            'totalDiplomes' => Diplome::count(),
            'totalExperiences' => Experience::count(),
            'diplomesParType' => TypeDiplome::count(),
            'yearsExperience' => Experience::whereNotNull('date_debut')
                ->whereNotNull('date_fin')
                ->selectRaw('SUM(YEAR(date_fin) - YEAR(date_debut)) as years')
                ->first()->years ?? 0,
            'currentExperiences' => Experience::whereNull('date_fin')->count(),
        ];

        return view('dashboard.statistiques.index', compact('data'));
    }    public function competences()
    {
        $stats = [
            'total' => Competence::count(),
            'parUser' => Competence::with(['user', 'niveau', 'sousDomaine'])
                ->get()
                ->groupBy('user_id')
                ->map(function ($competences) {
                    return [
                        'user' => $competences->first()->user,
                        'competences' => $competences,
                        'count' => $competences->count(),
                        'niveaux' => $competences->groupBy('niveau_id')
                    ];
                }),
            'parNiveau' => Competence::selectRaw('niveau_id, COUNT(*) as count')
                ->groupBy('niveau_id')
                ->with('niveau')
                ->get(),
        ];

        return view('dashboard.statistiques.competences', compact('stats'));
    }    public function diplomes()
    {
        $stats = [
            'total' => Diplome::count(),
            'parUser' => Diplome::with(['user', 'typeDiplome', 'etablissement', 'domaine'])
                ->get()
                ->groupBy('user_id')
                ->map(function ($diplomes) {
                    return [
                        'user' => $diplomes->first()->user,
                        'diplomes' => $diplomes,
                        'count' => $diplomes->count(),
                        'domaines' => $diplomes->groupBy('domaine_id')
                    ];
                }),
            'parType' => Diplome::selectRaw('type_diplome_id, COUNT(*) as count')
                ->groupBy('type_diplome_id')
                ->with('typeDiplome')
                ->get(),
            'parEtablissement' => Diplome::selectRaw('etablissement_id, COUNT(*) as count')
                ->groupBy('etablissement_id')
                ->with('etablissement')
                ->get(),
            'parDomaine' => Diplome::selectRaw('domaine_id, COUNT(*) as count')
                ->groupBy('domaine_id')
                ->with('domaine')
                ->get(),
            'parAnnee' => Diplome::selectRaw('YEAR(date_obtention) as annee, COUNT(*) as count')
                ->groupBy('annee')
                ->orderBy('annee')
                ->get(),
        ];

        return view('dashboard.statistiques.diplomes', compact('stats'));
    }    public function experiences()
    {
        $stats = [
            'total' => Experience::count(),
            'enCours' => Experience::whereNull('date_fin')->count(),
            'parUser' => Experience::selectRaw('user_id, COUNT(*) as count')
                ->whereNotNull('user_id')
                ->groupBy('user_id')
                ->with('user')
                ->get(),
            'parType' => Experience::selectRaw('type_experience_id, COUNT(*) as count')
                ->whereNotNull('type_experience_id')
                ->groupBy('type_experience_id')
                ->with('typeExperience')
                ->get(),
            'parEntreprise' => Experience::selectRaw('entreprise, COUNT(*) as count')
                ->whereNotNull('entreprise')
                ->where('entreprise', '!=', '')
                ->groupBy('entreprise')
                ->get(),
            'parAnnee' => Experience::selectRaw('YEAR(date_debut) as annee, COUNT(*) as count')
                ->whereNotNull('date_debut')
                ->groupBy('annee')
                ->orderBy('annee')
                ->get(),
        ];

        return view('dashboard.statistiques.experiences', compact('stats'));
    }
}
