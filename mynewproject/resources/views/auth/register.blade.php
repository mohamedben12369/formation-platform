@vite(['resources/css/auth.css'])

<x-guest-layout>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>{{ __('Create Account') }}</h1>
                <p>{{ __('Fill in your details to get started') }}</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="register-form">
                @csrf

                <!-- Role Selection -->
                <div class="form-group">
                    <x-input-label for="role_id" :value="__('Account Type')" />
                    <div class="styled-select">
                        <select id="role_id" name="role_id" class="form-input" required>
                            <option value="">{{ __('Select your account type') }}</option>
                            @foreach(App\Models\Role::where('nom', '!=', 'admin')->get() as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->nom }}
                                </option>
                            @endforeach
                        </select>
                        <span class="select-arrow">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('role_id')" class="error-message" />
                </div>

                <!-- Name Fields -->
                <div class="name-fields">
                    <div class="form-group">
                        <x-input-label for="prenom" :value="__('First Name')" />
                        <x-text-input id="prenom" class="form-input" type="text" name="prenom" :value="old('prenom')" required />
                        <x-input-error :messages="$errors->get('prenom')" class="error-message" />
                    </div>

                    <div class="form-group">
                        <x-input-label for="nom" :value="__('Last Name')" />
                        <x-text-input id="nom" class="form-input" type="text" name="nom" :value="old('nom')" required />
                        <x-input-error :messages="$errors->get('nom')" class="error-message" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="error-message" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="password-field">
                        <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
                        <span class="password-toggle" onclick="togglePassword('password', this)">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="error-message" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <div class="password-field">
                        <x-text-input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <span class="password-toggle" onclick="togglePassword('password_confirmation', this)">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
                </div>

                <!-- Security Question -->
                <div class="form-group">
                    <x-input-label for="securite_question_id" :value="__('Security Question')" />
                    <div class="styled-select">
                        <select id="securite_question_id" name="securite_question_id" class="form-input" required>
                            <option value="">{{ __('Select a security question') }}</option>
                            @foreach(App\Models\SecuriteQuestion::all() as $question)
                                <option value="{{ $question->id }}" {{ old('securite_question_id') == $question->id ? 'selected' : '' }}>
                                    {{ $question->question }}
                                </option>
                            @endforeach
                        </select>
                        <span class="select-arrow">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('securite_question_id')" class="error-message" />
                </div>

                <!-- Security Answer -->
                <div class="form-group">
                    <x-input-label for="reponse" :value="__('Security Answer')" />
                    <x-text-input id="reponse" class="form-input" type="text" name="reponse" :value="old('reponse')" required />
                    <x-input-error :messages="$errors->get('reponse')" class="error-message" />
                </div>

                <!-- Date of Birth -->
                <div class="form-group">
                    <x-input-label for="date_de_naissance" :value="__('Date of Birth')" />
                    <x-text-input id="date_de_naissance" class="form-input" type="date" name="date_de_naissance" :value="old('date_de_naissance')" required />
                    <x-input-error :messages="$errors->get('date_de_naissance')" class="error-message" />
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <x-input-label for="tel" :value="__('Phone Number')" />
                    <x-text-input id="tel" class="form-input" type="tel" name="tel" :value="old('tel')" maxlength="15" required />
                    <x-input-error :messages="$errors->get('tel')" class="error-message" />
                </div>

                <button type="submit" class="btn-primary">
                    {{ __('Register') }}
                </button>

                <div class="auth-links">
                    <a href="{{ route('login') }}">
                        {{ __('Already have an account? Sign in') }}
                    </a>
                </div>

                @if ($errors->any())
                    <div class="mt-4 text-red-600">
                        {{ $errors->first() }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</x-guest-layout>

<script>
function togglePassword(fieldId, iconSpan) {
    const input = document.getElementById(fieldId);
    if (input.type === 'password') {
        input.type = 'text';
        iconSpan.querySelector('i').classList.remove('fa-eye');
        iconSpan.querySelector('i').classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        iconSpan.querySelector('i').classList.remove('fa-eye-slash');
        iconSpan.querySelector('i').classList.add('fa-eye');
    }
    // Ensure form field name is preserved
    input.name = fieldId === 'password' ? 'password' : 'password_confirmation';
}
</script>
