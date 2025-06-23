<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FormateurController extends Controller
{
    /**
     * Display a listing of formateurs (users with 'formateur' role).
     */
    public function index()
    {        // Get all users with the 'formateur' role
        $formateurs = User::whereHas('role', function ($query) {
            $query->where('nom', 'formateur');
        })->with(['role'])->paginate(10);

        return view('dashboard.formateurs.index', compact('formateurs'));
    }

    /**
     * Show the form for creating a new formateur.
     */
    public function create()
    {
        return view('dashboard.formateurs.create');
    }

    /**
     * Store a newly created formateur in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);        $user = User::create([
            'nom' => $validated['name'], // Assuming you want to store in 'nom' field
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Find the formateur role and assign it
        $formateurRole = \App\Models\Role::where('nom', 'formateur')->first();
        if ($formateurRole) {
            $user->role_id = $formateurRole->id;
            $user->save();
        }

        return redirect()->route('dashboard.formateurs.index')
            ->with('success', 'Formateur créé avec succès.');
    }    /**
     * Display the specified formateur.
     */
    public function show(User $formateur)
    {
        // Ensure the user has the formateur role
        if (!$formateur->role || $formateur->role->nom !== 'formateur') {
            abort(404);
        }

        return view('dashboard.formateurs.show', compact('formateur'));
    }    /**
     * Show the form for editing the specified formateur.
     */
    public function edit(User $formateur)
    {
        // Ensure the user has the formateur role
        if (!$formateur->role || $formateur->role->nom !== 'formateur') {
            abort(404);
        }

        return view('dashboard.formateurs.edit', compact('formateur'));
    }    /**
     * Update the specified formateur in storage.
     */
    public function update(Request $request, User $formateur)
    {
        // Ensure the user has the formateur role
        if (!$formateur->role || $formateur->role->nom !== 'formateur') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $formateur->id,
        ]);

        $formateur->update([
            'nom' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('dashboard.formateurs.index')
            ->with('success', 'Formateur mis à jour avec succès.');
    }    /**
     * Remove the specified formateur from storage.
     */
    public function destroy(User $formateur)
    {
        // Ensure the user has the formateur role
        if (!$formateur->role || $formateur->role->nom !== 'formateur') {
            abort(404);
        }

        $formateur->delete();

        return redirect()->route('dashboard.formateurs.index')
            ->with('success', 'Formateur supprimé avec succès.');
    }
}
