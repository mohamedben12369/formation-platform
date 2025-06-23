@vite(['resources/css/auth.css'])
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
            <div class="auth-container">
                <div class="auth-card">
                    <div class="auth-header">
                    <h1>{{ __('Bienvenue') }}</h1>
                    <p>{{ __('Connectez-vous à votre compte') }}</p>
                    </div>

                <div class="back-link">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-arrow-left"></i>
                        {{ __('Retour à l\'accueil') }}
                        </a>
                    </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="error-message" />
                        </div>

                        <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                        <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="error-message" />
                        </div>

                        <!-- Remember Me -->
                    <div class="remember-me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">{{ __('Se souvenir de moi') }}</label>
                        </div>

                    <div class="auth-footer">
                            @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                            @endif

                        <button type="submit" class="submit-button">
                                {{ __('Se connecter') }}
                        </button>
                        </div>
                        
                        <div class="auth-links mt-4">
                            <p class="text-center">
                                <a href="{{ route('register') }}" class="register-link">
                                    {{ __('Pas encore de compte ? S\'inscrire') }}
                                </a>
                            </p>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</x-guest-layout>

<style>
    .min-h-screen {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .auth-container {
            width: 100%;
            padding: 1rem;
        }
    }

    .back-link {
        position: relative;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .back-link a {
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .nav-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .nav-link {
        font-size: 0.875rem;
        color: #4b5563;
        text-decoration: none;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }
    
    .nav-link:hover {
        background-color: #f3f4f6;
        color: #2563eb;
    }
    
    .nav-link i {
        font-size: 0.75rem;
    }
    
    .auth-links {
        margin-top: 1.5rem;
    }
    
    .register-link, .entreprise-link {
        color: #2563eb;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .register-link:hover, .entreprise-link:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }
    
    .entreprise-link {
        display: inline-flex;
        align-items: center;
        background-color: #f3f4f6;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        border: 1px solid #e5e7eb;
    }
    
    .entreprise-link:hover {
        background-color: #e5e7eb;
    }
    
    .entreprise-link i {
        margin-right: 0.5rem;
    }
    
    .mt-2 {
        margin-top: 0.5rem;
    }
    
    .mt-4 {
        margin-top: 1rem;
    }
    
    .text-center {
        text-align: center;
    }
    
    .me-1 {
        margin-right: 0.25rem;
    }
</style>
