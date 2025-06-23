<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TypeDiplome;
use Illuminate\Http\Request;

class TypeDiplomeController extends Controller
{
    public function index()
    {
        $typeDiplomes = TypeDiplome::all();
        return view('dashboard.type-diplomes.index', compact('typeDiplomes'));
    }

    public function create()
    {
        return view('dashboard.type-diplomes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:type_diplomes',
            'description' => 'nullable|string'
        ]);

        TypeDiplome::create($validated);

        return redirect()->route('dashboard.type-diplomes.index')
            ->with('success', 'Type de diplôme ajouté avec succès.');
    }

    public function edit(TypeDiplome $typeDiplome)
    {
        return view('dashboard.type-diplomes.edit', compact('typeDiplome'));
    }

    public function update(Request $request, TypeDiplome $typeDiplome)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:type_diplomes,nom,' . $typeDiplome->id,
            'description' => 'nullable|string'
        ]);

        $typeDiplome->update($validated);

        return redirect()->route('dashboard.type-diplomes.index')
            ->with('success', 'Type de diplôme mis à jour avec succès.');
    }

    public function destroy(TypeDiplome $typeDiplome)
    {
        $typeDiplome->delete();

        return redirect()->route('dashboard.type-diplomes.index')
            ->with('success', 'Type de diplôme supprimé avec succès.');
    }
} 