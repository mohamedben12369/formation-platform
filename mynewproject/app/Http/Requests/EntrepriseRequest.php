<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntrepriseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $entrepriseId = $this->route('entreprise')?->id;
        $emailRule = 'required|email|max:100|unique:entreprises';
        if ($entrepriseId) {
            $emailRule .= ',email,' . $entrepriseId;
        }

        return [
            'nom' => 'required|string|max:100',
            'email' => $emailRule,
            'Adresse' => 'required|string|max:255',
            'tel' => 'required|string|max:20|regex:/^[\d\s\-\+\(\)]+$/',
            'fax' => 'required|string|max:20|regex:/^[\d\s\-\+\(\)]+$/',
            'CNSS' => 'required|string|max:50|unique:entreprises,CNSS' . ($entrepriseId ? ',' . $entrepriseId : ''),
            'user_id' => 'required|exists:users,id',
            'IF' => 'nullable|string|max:50',
            'RC' => 'nullable|string|max:50',
            'ICE' => 'nullable|string|max:50',
            'patente' => 'nullable|string|max:50',
            'date_creation' => 'nullable|date|before_or_equal:today',
            'website' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de l\'entreprise est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.unique' => 'Cet email est déjà utilisé par une autre entreprise.',
            'Adresse.required' => 'L\'adresse est obligatoire.',
            'tel.required' => 'Le numéro de téléphone est obligatoire.',
            'tel.regex' => 'Le format du numéro de téléphone n\'est pas valide.',
            'fax.required' => 'Le numéro de fax est obligatoire.',
            'fax.regex' => 'Le format du numéro de fax n\'est pas valide.',
            'CNSS.required' => 'Le numéro CNSS est obligatoire.',
            'CNSS.unique' => 'Ce numéro CNSS est déjà utilisé par une autre entreprise.',
            'user_id.required' => 'L\'utilisateur associé est obligatoire.',
            'user_id.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
            'date_creation.date' => 'La date de création doit être une date valide.',
            'date_creation.before_or_equal' => 'La date de création ne peut pas être dans le futur.',
            'website.url' => 'Le site web doit être une URL valide.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpeg, png, jpg, gif ou svg.',
            'image.max' => 'L\'image ne doit pas dépasser 2MB.'
        ];
    }
}
