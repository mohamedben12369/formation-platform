@vite(['resources/css/forgot.css'])
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <h1>{{ __('Réinitialisation du mot de passe') }}</h1>
                    <p>{{ __('Veuillez remplir les informations suivantes pour réinitialiser votre mot de passe.') }}</p>
                </div>

                <div class="back-link">
                    <a href="{{ route('login') }}" class="flex items-center">
                        <i class="fas fa-arrow-left"></i>
                        {{ __('Retour à la connexion') }}
                    </a>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="error-message" />
                    </div>

                    <!-- Téléphone -->
                    <div class="form-group">
                        <label for="tel" class="form-label">{{ __('Téléphone') }}</label>
                        <input id="tel" class="form-input" type="tel" name="tel" :value="old('tel')" required />
                        <x-input-error :messages="$errors->get('tel')" class="error-message" />
                    </div>

                    <!-- Date de naissance -->
                    <div class="form-group">
                        <label for="date_naissance" class="form-label">{{ __('Date de naissance') }}</label>
                        <input id="date_naissance" class="form-input" type="date" name="date_naissance" :value="old('date_naissance')" required />
                        <x-input-error :messages="$errors->get('date_naissance')" class="error-message" />
                    </div>

                    <!-- Question de sécurité -->
                    <div class="form-group">
                        <label for="securite_question_id" class="form-label">{{ __('Question de sécurité') }}</label>
                        <select id="securite_question_id" name="securite_question_id" class="form-input" required>
                            <option value="">{{ __('Sélectionnez une question') }}</option>
                            @foreach(\App\Models\SecuriteQuestion::all() as $question)
                                <option value="{{ $question->id }}" {{ old('securite_question_id') == $question->id ? 'selected' : '' }}>
                                    {{ $question->question }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('securite_question_id')" class="error-message" />
                    </div>

                    <!-- Réponse -->
                    <div class="form-group">
                        <label for="reponse" class="form-label">{{ __('Réponse') }}</label>
                        <input id="reponse" class="form-input" type="text" name="reponse" :value="old('reponse')" required />
                        <x-input-error :messages="$errors->get('reponse')" class="error-message" />
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