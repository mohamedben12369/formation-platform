<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TypeExperience;
use Illuminate\Http\Request;

class TypeExperienceController extends Controller
{
    public function index()
    {
        $types = TypeExperience::all();
        return view('dashboard.type-experiences.index', compact('types'));
    }

    public function create()
    {
        return view('dashboard.type-experiences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:type_experiences',
        ]);

        TypeExperience::create($validated);

        return redirect()->route('dashboard.type-experiences.index')
            ->with('success', 'Type d\'expérience ajouté avec succès.');
    }

    public function edit(TypeExperience $typeExperience)
    {
        return view('dashboard.type-experiences.edit', compact('typeExperience'));
    }

    public function update(Request $request, TypeExperience $typeExperience)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:type_experiences,nom,' . $typeExperience->id,
        ]);

        $typeExperience->update($validated);

        return redirect()->route('dashboard.type-experiences.index')
            ->with('success', 'Type d\'expérience mis à jour avec succès.');
    }

    public function destroy(TypeExperience $typeExperience)
    {
        $typeExperience->delete();

        return redirect()->route('dashboard.type-experiences.index')
            ->with('success', 'Type d\'expérience supprimé avec succès.');
    }
} 