<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use App\Models\TypeDiplome;
use App\Models\Axe;
use App\Models\Domaine;
use App\Models\SousDomaine;
use App\Models\Competence;
use App\Models\ThemeFormation;
use App\Models\Formation;
use App\Models\TypeExperience;
use App\Models\Entreprise; // Added Entreprise model
use App\Models\User;
use App\Models\SecuriteQuestion;
use App\Models\Candidature;
use App\Models\TypeDocument;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $competencesData = [
            'totalCompetences' => Competence::count(),
            'completedCompetences' => 0,
            'inProgressCompetences' => Competence::count(),
        ];

        $data = [
            'etablissementsCount' => Etablissement::count(),
            'typeDiplomesCount' => TypeDiplome::count(),
            'axesCount' => Axe::count(),
            'domainesCount' => Domaine::count(),
            'sousDomainesCount' => SousDomaine::count(),
            'themeFormationsCount' => ThemeFormation::count(),
            'formationsCount' => Formation::count(),
            'typeExperiencesCount' => TypeExperience::count(),
            'entreprisesCount' => Entreprise::count(),
            'formateursCount' => User::whereHas('role', function ($query) {
                $query->where('nom', 'formateur');
            })->count(),
            'securiteQuestionsCount' => SecuriteQuestion::count(),
            'candidaturesCount' => Candidature::count(),
            'candidaturesEnAttenteCount' => Candidature::where('statut', 'en_attente')->count(),
            'candidaturesAccepteesCount' => Candidature::where('statut', 'accepte')->count(),
            'typeDocumentsCount' => TypeDocument::count(),
        ];

        return view('dashboard', array_merge($data, $competencesData));
    }

    public function etablissements()
    {
        return view('dashboard.etablissements', [
            'etablissements' => Etablissement::all()
        ]);
    }

    public function typeDiplomes()
    {
        return view('dashboard.type-diplomes', [
            'typeDiplomes' => TypeDiplome::all()
        ]);
    }

    public function storeEtablissement(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:255',
        ]);

        Etablissement::create($validated);

        return redirect()->route('dashboard.etablissements')
            ->with('success', 'Établissement ajouté avec succès.');
    }

    public function updateEtablissement(Request $request, Etablissement $etablissement)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:255',
        ]);

        $etablissement->update($validated);

        return redirect()->route('dashboard.etablissements')
            ->with('success', 'Établissement mis à jour avec succès.');
    }

    public function destroyEtablissement(Etablissement $etablissement)
    {
        $etablissement->delete();

        return redirect()->route('dashboard.etablissements')
            ->with('success', 'Établissement supprimé avec succès.');
    }

    public function storeTypeDiplome(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:type_diplomes',
        ]);

        TypeDiplome::create($validated);

        return redirect()->route('dashboard.type-diplomes')
            ->with('success', 'Type de diplôme ajouté avec succès.');
    }

    public function updateTypeDiplome(Request $request, TypeDiplome $typeDiplome)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:type_diplomes,nom,' . $typeDiplome->id,
        ]);

        $typeDiplome->update($validated);

        return redirect()->route('dashboard.type-diplomes')
            ->with('success', 'Type de diplôme mis à jour avec succès.');
    }

    public function destroyTypeDiplome(TypeDiplome $typeDiplome)
    {
        $typeDiplome->delete();

        return redirect()->route('dashboard.type-diplomes')
            ->with('success', 'Type de diplôme supprimé avec succès.');
    }

    public function generalStatistics()
    {
        // Gather any data needed for the general statistics page
        // For example, similar to the index method or more specific stats
        $data = [
            'etablissementsCount' => Etablissement::count(),
            'typeDiplomesCount' => TypeDiplome::count(),
            'axesCount' => Axe::count(),
            'domainesCount' => Domaine::count(),
            'sousDomainesCount' => SousDomaine::count(),
            'themeFormationsCount' => ThemeFormation::count(),
            'formationsCount' => Formation::count(),
            // Add more specific statistics as needed
        ];
        return view('dashboard.statistiques-generales', $data);
    }
}