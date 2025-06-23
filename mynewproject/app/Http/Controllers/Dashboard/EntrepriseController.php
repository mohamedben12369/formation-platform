<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntrepriseRequest;
use App\Models\Entreprise;
use App\Models\User;
use App\Traits\HasImage;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    use HasImage;/**
     * Affiche la liste des entreprises
     */
    public function index(Request $request)
    {
        $query = Entreprise::with('user');

        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        $entreprises = $query->paginate(10);

        return view('dashboard.entreprises.index', compact('entreprises'));
    }/**
     * Affiche une entreprise spécifique
     */
    public function show(Entreprise $entreprise)
    {
        return view('dashboard.entreprises.show', compact('entreprise'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle entreprise
     */
    public function create()
    {
        $users = User::all();
        return view('dashboard.entreprises.create', compact('users'));
    }    /**
     * Enregistre une nouvelle entreprise
     */
    public function store(EntrepriseRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request->file('image'), 'entreprises');
        }

        Entreprise::create($validated);

        return redirect()->route('dashboard.entreprises.index')
            ->with('success', 'Entreprise ajoutée avec succès.');
    }

    /**
     * Affiche le formulaire de modification d'une entreprise existante
     */
    public function edit(Entreprise $entreprise)
    {
        $users = User::all();
        return view('dashboard.entreprises.edit', compact('entreprise', 'users'));
    }    /**
     * Met à jour une entreprise existante
     */
    public function update(EntrepriseRequest $request, Entreprise $entreprise)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $this->updateImage(
                $request->file('image'), 
                $entreprise->image, 
                'entreprises'
            );
        }

        $entreprise->update($validated);

        return redirect()->route('dashboard.entreprises.index')
            ->with('success', 'Entreprise mise à jour avec succès.');
    }    /**
     * Supprime une entreprise
     */
    public function destroy(Entreprise $entreprise)
    {
        // Delete image if it exists
        $this->deleteImage($entreprise->image);
        
        $entreprise->delete();

        return redirect()->route('dashboard.entreprises.index')
            ->with('success', 'Entreprise supprimée avec succès.');
    }

    /**
     * Obtenir les statistiques des entreprises
     */
    public function stats()
    {
        $stats = [
            'total' => Entreprise::count(),
            'with_website' => Entreprise::whereNotNull('website')->count(),
            'with_image' => Entreprise::whereNotNull('image')->count(),
            'recent' => Entreprise::where('created_at', '>=', now()->subDays(30))->count(),
        ];

        return response()->json($stats);
    }
}
