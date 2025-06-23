@vite(['resources/css/auth.css'])
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <h1>{{ __('Réinitialisation du mot de passe') }}</h1>
                    <p>{{ __('Veuillez entrer votre nouveau mot de passe.') }}</p>
                </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    
                    <!-- Email Address -->
                    <input type="hidden" name="email" value="{{ $request->email }}">
                    <x-input-error :messages="$errors->get('email')" class="error-message mt-2" />

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Nouveau mot de passe') }}</label>
                        <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="error-message" />
            </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">{{ __('Confirmer le mot de passe') }}</label>
                        <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
            </div>

            <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="submit-button">
                            {{ __('Réinitialiser le mot de passe') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
