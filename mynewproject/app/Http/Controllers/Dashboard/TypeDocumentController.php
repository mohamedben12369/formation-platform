<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TypeDocument;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{
    public function index()
    {
        $typeDocuments = TypeDocument::orderBy('obligatoire', 'desc')
                                   ->orderBy('nom')
                                   ->paginate(5);
        
        return view('dashboard.type-documents.index', compact('typeDocuments'));
    }

    public function create()
    {
        return view('dashboard.type-documents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:type_documents',
            'description' => 'nullable|string|max:500',
            'icone' => 'nullable|string|max:100',
            'couleur' => 'nullable|string|max:7',
            'obligatoire' => 'boolean',
            'formats_autorises' => 'required|string|max:255',
            'taille_max_mb' => 'required|integer|min:1|max:100',
            'actif' => 'boolean'
        ]);

        TypeDocument::create($validated);

        return redirect()->route('dashboard.type-documents.index')
            ->with('success', 'Type de document créé avec succès');
    }

    public function show(TypeDocument $typeDocument)
    {
        $typeDocument->loadCount('candidatureDocuments');
        
        return view('dashboard.type-documents.show', compact('typeDocument'));
    }

    public function edit(TypeDocument $typeDocument)
    {
        return view('dashboard.type-documents.edit', compact('typeDocument'));
    }

    public function update(Request $request, TypeDocument $typeDocument)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:type_documents,nom,' . $typeDocument->id,
            'description' => 'nullable|string|max:500',
            'icone' => 'nullable|string|max:100',
            'couleur' => 'nullable|string|max:7',
            'obligatoire' => 'boolean',
            'formats_autorises' => 'required|string|max:255',
            'taille_max_mb' => 'required|integer|min:1|max:100',
            'actif' => 'boolean'
        ]);

        $typeDocument->update($validated);

        return redirect()->route('dashboard.type-documents.index')
            ->with('success', 'Type de document mis à jour avec succès');
    }

    public function destroy(TypeDocument $typeDocument)
    {
        // Vérifier s'il y a des documents associés
        if ($typeDocument->candidatureDocuments()->exists()) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer ce type de document car il est utilisé dans des candidatures');
        }

        $typeDocument->delete();

        return redirect()->route('dashboard.type-documents.index')
            ->with('success', 'Type de document supprimé avec succès');
    }

    public function toggleActif(TypeDocument $typeDocument)
    {
        $typeDocument->update([
            'actif' => !$typeDocument->actif
        ]);

        $status = $typeDocument->actif ? 'activé' : 'désactivé';
        
        return redirect()->back()
            ->with('success', "Type de document {$status} avec succès");
    }
}
