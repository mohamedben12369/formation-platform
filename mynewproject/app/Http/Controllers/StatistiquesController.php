<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use App\Models\Diplome;
use App\Models\Experience;
use Illuminate\Http\Request;

class StatistiquesController extends Controller
{
    public function competences()
    {
        $stats = [
            'total' => Competence::count(),
            'completees' => Competence::where('status', 'completed')->count(),
            'enCours' => Competence::where('status', 'in_progress')->count(),
            'parNiveau' => Competence::selectRaw('niveau_id, COUNT(*) as count')
                ->groupBy('niveau_id')
                ->with('niveau')
                ->get(),
        ];

        return view('dashboard.statistiques.competences', compact('stats'));
    }

    public function diplomes()
    {
        $stats = [
            'total' => Diplome::count(),
            'parType' => Diplome::selectRaw('type_diplome_id, COUNT(*) as count')
                ->groupBy('type_diplome_id')
                ->with('typeDiplome')
                ->get(),
            'parEtablissement' => Diplome::selectRaw('etablissement_id, COUNT(*) as count')
                ->groupBy('etablissement_id')
                ->with('etablissement')
                ->get(),
            'parAnnee' => Diplome::selectRaw('YEAR(date_obtention) as annee, COUNT(*) as count')
                ->groupBy('annee')
                ->orderBy('annee')
                ->get(),
        ];

        return view('dashboard.statistiques.diplomes', compact('stats'));
    }

    public function experiences()
    {
        $stats = [
            'total' => Experience::count(),
            'enCours' => Experience::whereNull('date_fin')->count(),
            'parType' => Experience::selectRaw('type_experience_id, COUNT(*) as count')
                ->groupBy('type_experience_id')
                ->with('typeExperience')
                ->get(),
            'parEntreprise' => Experience::selectRaw('entreprise_id, COUNT(*) as count')
                ->groupBy('entreprise_id')
                ->with('entreprise')
                ->get(),
            'parAnnee' => Experience::selectRaw('YEAR(date_debut) as annee, COUNT(*) as count')
                ->groupBy('annee')
                ->orderBy('annee')
                ->get(),
        ];

        return view('dashboard.statistiques.experiences', compact('stats'));
    }
}
