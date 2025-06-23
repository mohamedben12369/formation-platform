<?php

namespace App\Http\Controllers\Profile;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{    /**
     * Display the user's profile.
     */
    public function show(): View
    {
        $user = User::with(['competences.niveau', 'competences.sousDomaine', 'experiences.typeExperience', 'diplomes.typeDiplome', 'diplomes.etablissement', 'diplomes.domaine'])
            ->findOrFail(Auth::id());
            
        return view('profile.show', [
            'user' => $user,
        ]);
    }
    
    /**
     * Display the user's profile edit form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user()->load([
            'competences.niveau', 
            'competences.sousDomaine', 
            'experiences.typeExperience', 
            'diplomes.typeDiplome', 
            'diplomes.etablissement', 
            'diplomes.domaine'
        ]);
        
        return view('profile.edit', [
            'user' => $user,
        ]);
    }    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {        try {
            $user = $request->user();
            $data = $request->validated();

            // Check if email is being changed
            $emailChanged = $data['email'] !== $user->email;

            $user->fill($data); // D'abord remplir les champs classiques

            // If email changed, mark as unverified
            if ($emailChanged && $user->hasVerifiedEmail()) {
                $user->email_verified_at = null;
            }

            // Upload photo de profil avec Storage
            if ($request->hasFile('profile_image')) {
                // Supprimer l'ancienne image si elle existe
                if ($user->profile_image) {
                    Storage::disk('public')->delete($user->profile_image);
                }
                $file = $request->file('profile_image');
                $path = $file->store('profile-images', 'public');
                $user->profile_image = $path;
            }
            
            // Upload bannière avec Storage
            if ($request->hasFile('background_image')) {
                // Supprimer l'ancienne image si elle existe
                if ($user->background_image) {
                    Storage::disk('public')->delete($user->background_image);
                }
                $file = $request->file('background_image');
                $path = $file->store('background-images', 'public');
                $user->background_image = $path;
            }

            $user->save();

            $message = $emailChanged ? 'Profil mis à jour. Veuillez vérifier votre nouvelle adresse e-mail.' : 'Profil mis à jour avec succès.';
            
            return Redirect::route('profile.edit')->with('status', $message);
        } catch (\Exception $e) {
            return Redirect::route('profile.edit')->with('error', 'Une erreur est survenue lors de la mise à jour du profil.');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'profile-deleted');
    }    /**
     * Update the user's profile photo.
     */
    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            $user = $request->user();

            // Supprimer l'ancienne photo si elle existe
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Sauvegarder la nouvelle photo
            $path = $request->file('profile_image')->store('profile-images', 'public');
            $user->profile_image = $path;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Photo de profil mise à jour avec succès',
                'profile_image_url' => Storage::url($path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de la photo de profil'
            ], 500);
        }
    }    /**
     * Update the user's background photo.
     */
    public function updateBackgroundPhoto(Request $request)
    {
        $request->validate([
            'background_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        try {
            $user = $request->user();

            // Supprimer l'ancienne photo de fond si elle existe
            if ($user->background_image) {
                Storage::disk('public')->delete($user->background_image);
            }

            // Sauvegarder la nouvelle photo de fond
            $path = $request->file('background_image')->store('background-images', 'public');
            $user->background_image = $path;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Photo de fond mise à jour avec succès',
                'background_image_url' => Storage::url($path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour de la photo de fond'
            ], 500);
        }
    }    /**
     * Delete the user's profile photo.
     */
    public function deleteProfilePhoto(Request $request)
    {
        try {
            $user = $request->user();

            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
                $user->profile_image = null;
                $user->save();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Photo de profil supprimée avec succès'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Aucune photo de profil à supprimer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de la photo de profil'
            ], 500);
        }
    }    /**
     * Delete the user's background photo.
     */
    public function deleteBackgroundPhoto(Request $request)
    {
        try {
            $user = $request->user();

            if ($user->background_image) {
                Storage::disk('public')->delete($user->background_image);
                $user->background_image = null;
                $user->save();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Photo de fond supprimée avec succès'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Aucune photo de fond à supprimer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de la photo de fond'
            ], 500);
        }
    }
}