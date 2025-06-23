<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'tel' => ['required', 'string', 'max:20'],
            'date_de_naissance' => ['required', 'date'],
            'securite_question_id' => ['required', 'exists:securite_question,id'],
            'reponse' => ['required', 'string'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'tel' => $request->tel,
            'date_de_naissance' => $request->date_de_naissance,
            'role_id' => $request->role_id,
            'reponse' => $request->reponse,
            'is_active' => true,
            'password' => Hash::make($request->password),
            'securite_question_id' => $request->securite_question_id,
            'remember_token' => Str::random(60),
            'profile_image' => null,
            'background_image' => null
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('welcome')->with('status', 'Bienvenue ! Votre compte a été créé avec succès.');
    }
}
