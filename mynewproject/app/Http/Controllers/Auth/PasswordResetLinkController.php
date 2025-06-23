<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'tel' => ['required'],
            'date_naissance' => ['required', 'date'],
            'securite_question_id' => ['required', 'exists:securite_question,id'],
            'reponse' => ['required'],
        ]);

        $user = User::where('email', $request->email)
            ->where('tel', $request->tel)
            ->where('date_de_naissance', $request->date_naissance)
            ->where('securite_question_id', $request->securite_question_id)
            ->where('reponse', $request->reponse)
            ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Les informations fournies ne correspondent pas à nos enregistrements.',
            ]);
        }

        $token = Password::createToken($user);

        return redirect()->route('password.reset', ['token' => $token, 'email' => $request->email])
            ->with('status', 'Veuillez réinitialiser votre mot de passe.');
    }

    public function reset(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset(
            $request->only('password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('welcome')->with('status', 'Votre mot de passe a été réinitialisé avec succès.');
        }

        return back()->withErrors(['email' => [__($status)]]);
    }
}
