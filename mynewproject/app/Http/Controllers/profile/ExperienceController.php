<?php

namespace App\Http\Controllers\Profile;

use App\Models\Experience;
use App\Models\TypeExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::where('user_id', Auth::id())->with('typeExperience')->get();
        $typeExperiences = TypeExperience::all();
        return view('profile.experiences.index', compact('experiences', 'typeExperiences'));
    }

    public function create()
    {
        $typeExperiences = TypeExperience::all();
        return view('profile.experiences.create', compact('typeExperiences'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'type_experience_id' => 'required|exists:type_experiences,id',
            'entreprise' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'description' => 'nullable|string',
            'attestation' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:10240',
        ]);

        $experienceData = [
            'titre' => $validated['titre'],
            'nom' => $validated['titre'],
            'type_experience_id' => $validated['type_experience_id'],
            'entreprise' => $validated['entreprise'],
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'] ?? null,
            'description' => $validated['description'] ?? null,
            'lieu' => $validated['entreprise'],
            'user_id' => Auth::id(),
        ];
        
        if ($request->hasFile('attestation')) {
            $path = $request->file('attestation')->store('attestations', 'public');
            $experienceData['attestation'] = $path;
        }
        
        try {
            $experience = Experience::create($experienceData);
            return redirect()->route('profile.experiences.index')
                ->with('success', 'Expérience ajoutée avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Erreur lors de l\'enregistrement: ' . $e->getMessage()]);
        }
    }

    public function edit(Experience $experience)
    {
        if ($experience->user_id !== Auth::id()) {
            abort(403, 'Cette action n\'est pas autorisée.');
        }
        
        $typeExperiences = TypeExperience::all();
        
        return view('profile.experiences.edit', compact('experience', 'typeExperiences'));
    }

    public function update(Request $request, Experience $experience)
    {
        if ($experience->user_id !== Auth::id()) {
            abort(403, 'Cette action n\'est pas autorisée.');
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'type_experience_id' => 'required|exists:type_experiences,id',
            'entreprise' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'description' => 'nullable|string',
            'attestation' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:10240',
        ]);        $data = [
            'titre' => $validated['titre'],
            'nom' => $validated['titre'],
            'type_experience_id' => $validated['type_experience_id'],
            'entreprise' => $validated['entreprise'],
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'description' => $validated['description'],
            'lieu' => $validated['entreprise'] // Utilise l'entreprise comme lieu
        ];

        if ($request->hasFile('attestation')) {
            if ($experience->attestation) {
                Storage::disk('public')->delete($experience->attestation);
            }
            $path = $request->file('attestation')->store('attestations', 'public');
            $data['attestation'] = $path;
        }

        $experience->update($data);

        return redirect()->route('profile.experiences.index')
            ->with('success', 'Expérience mise à jour avec succès');
    }

    public function destroy(Experience $experience)
    {
        if ($experience->user_id !== Auth::id()) {
            abort(403, 'Cette action n\'est pas autorisée.');
        }

        if ($experience->attestation) {
            Storage::disk('public')->delete($experience->attestation);
        }

        $experience->delete();

        return redirect()->route('profile.experiences.index')
            ->with('success', 'Expérience supprimée avec succès');
    }
    
    /**
     * Display the attestation file for an experience.
     */
    public function showAttestation(Experience $experience)
    {
        if ($experience->user_id !== Auth::id()) {
            abort(403, 'Cette action n\'est pas autorisée.');
        }
        
        if (!$experience->attestation) {
            abort(404, 'Aucune attestation trouvée pour cette expérience.');
        }
        
        return response()->file(storage_path('app/public/' . $experience->attestation));
    }
}