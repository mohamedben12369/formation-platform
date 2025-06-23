<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // Affiche le formulaire d'édition du profil
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Met à jour le profil utilisateur
    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Ajoutez d'autres champs selon votre formulaire
        ]);
       
        return redirect()->route('profile.edit')->with('success', 'Profil mis à jour !');
    }

    // Affiche le profil d'un utilisateur spécifique
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profile.show', compact('user'));
    }
}
