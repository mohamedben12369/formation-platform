<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\CandidatureDocument;
use App\Models\Formation;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CandidatureController extends Controller
{    public function create(Formation $formation)
    {
        $typeDocuments = TypeDocument::where('actif', true)->orderBy('obligatoire', 'desc')->get();
        $user = Auth::user(); // Récupérer l'utilisateur connecté
        
        return view('candidatures.create', compact('formation', 'typeDocuments', 'user'));
    }

    public function store(Request $request, Formation $formation)
    {
        // Validation des données de base
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:candidatures,email,NULL,id,formation_id,' . $formation->id,
            'telephone' => 'required|string|max:20',
            'motivation' => 'nullable|string|max:1000',
        ]);

        // Validation des documents
        $typeDocuments = TypeDocument::where('actif', true)->get();
        $documentRules = [];
        
        foreach ($typeDocuments as $typeDocument) {
            $fieldName = 'document_' . $typeDocument->id;
            $rules = [];
            
            if ($typeDocument->obligatoire) {
                $rules[] = 'required';
            } else {
                $rules[] = 'nullable';
            }
            
            $rules[] = 'file';
            $rules[] = 'max:' . ($typeDocument->taille_max_mb * 1024); // En kilobytes
            $rules[] = 'mimes:' . $typeDocument->formats_autorises;
            
            $documentRules[$fieldName] = implode('|', $rules);
        }
        
        $request->validate($documentRules);        // Création de la candidature
        $candidature = Candidature::create([
            'formation_id' => $formation->id,
            'user_id' => Auth::check() ? Auth::user()->id : null,
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'motivation' => $validated['motivation'],
            'statut' => 'en_attente'
        ]);

        // Traitement des documents
        foreach ($typeDocuments as $typeDocument) {
            $fieldName = 'document_' . $typeDocument->id;
            
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $this->storeDocument($candidature, $typeDocument, $file);
            }
        }

        return redirect()->route('formations.show', $formation)
            ->with('success', 'Votre candidature a été soumise avec succès !');
    }

    private function storeDocument(Candidature $candidature, TypeDocument $typeDocument, $file)
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::uuid() . '.' . $extension;
        $folderPath = 'candidatures/' . $candidature->id;
        
        // Stocker le fichier
        $path = $file->storeAs($folderPath, $fileName, 'public');
        
        // Créer l'enregistrement en base
        CandidatureDocument::create([
            'candidature_id' => $candidature->id,
            'type_document_id' => $typeDocument->id,
            'nom_fichier' => $fileName,
            'nom_original' => $originalName,
            'chemin_fichier' => $path,
            'extension' => $extension,
            'taille_ko' => round($file->getSize() / 1024)
        ]);
    }    public function downloadDocument(CandidatureDocument $document)
    {
        if (!$document->exists()) {
            abort(404, 'Document non trouvé');
        }

        return response()->download(
            storage_path('app/public/' . $document->chemin_fichier),
            $document->nom_original
        );
    }
    public function viewDocument(CandidatureDocument $document)
    {
        if (!$document->exists()) {
            abort(404, 'Document non trouvé');
        }

        $filePath = storage_path('app/public/' . $document->chemin_fichier);
        
        // Déterminer le type MIME
        $mimeType = mime_content_type($filePath);
        
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $document->nom_original . '"'
        ]);
    }
}
