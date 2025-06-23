<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore(Auth::id()),
            ],
            'tel' => ['nullable', 'string', 'max:20'],
            'date_de_naissance' => ['nullable', 'date'],
            'adresse' => ['nullable', 'string', 'max:500'],
            'securite_question_id' => ['required', 'exists:securite_question,id'],
            'reponse' => ['required', 'string', 'max:255'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'background_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:4096'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'profile_image.image' => 'Le fichier de photo de profil doit être une image.',
            'profile_image.mimes' => 'La photo de profil doit être au format: jpeg, png, jpg, gif ou webp.',
            'profile_image.max' => 'La photo de profil ne doit pas dépasser 2MB.',
            'background_image.image' => 'Le fichier de photo de fond doit être une image.',
            'background_image.mimes' => 'La photo de fond doit être au format: jpeg, png, jpg, gif ou webp.',
            'background_image.max' => 'La photo de fond ne doit pas dépasser 4MB.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'securite_question_id.exists' => 'La question de sécurité sélectionnée n\'existe pas.',
        ];
    }
}
