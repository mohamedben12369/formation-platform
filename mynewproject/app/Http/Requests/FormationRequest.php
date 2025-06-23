<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormationRequest extends FormRequest
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
        return [
            'nom' => 'required|string|max:255',
            'dateDebut' => 'required|date|after_or_equal:today',
            'dateFin' => 'required|date|after:dateDebut',
            'lieu' => 'required|string|max:255',
            'nombre_ouvriers' => 'required|integer|min:0',
            'nombre_encadrants' => 'required|integer|min:0',
            'nombre_cadres' => 'required|integer|min:0',
            'programme' => 'nullable|string',
            'objectifs' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'document_pdf' => 'nullable|mimes:pdf|max:10240',
            'type_formation_id' => 'required|exists:type_formations,id',
            'statut_formation_id' => 'required|exists:statut_formations,id',
            'entreprise_id' => 'required|exists:entreprises,id',
            'domaine_id' => 'nullable|exists:domaines,code',
            'sous_domaine_code' => 'nullable|exists:sous_domaines,code',
            'themes' => 'required|array|min:1',
            'themes.*' => 'exists:theme_formations,idtheme',
            'themes_prix' => 'array',
            'themes_prix.*' => 'numeric|min:0',
            'themes_duree' => 'array',
            'themes_duree.*' => 'integer|min:1',
            'themes_date_debut' => 'array',
            'themes_date_debut.*' => 'nullable|date',
            'themes_date_fin' => 'array',
            'themes_date_fin.*' => 'nullable|date',
            'formateurs' => 'array',
            'formateurs.*' => 'exists:users,id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la formation est obligatoire.',
            'dateDebut.required' => 'La date de début est obligatoire.',
            'dateDebut.after_or_equal' => 'La date de début ne peut pas être dans le passé.',
            'dateFin.required' => 'La date de fin est obligatoire.',
            'dateFin.after' => 'La date de fin doit être après la date de début.',
            'lieu.required' => 'Le lieu de la formation est obligatoire.',
            'nombre_ouvriers.required' => 'Le nombre d\'ouvriers est obligatoire.',
            'nombre_ouvriers.min' => 'Le nombre d\'ouvriers ne peut pas être négatif.',
            'nombre_encadrants.required' => 'Le nombre d\'encadrants est obligatoire.',
            'nombre_encadrants.min' => 'Le nombre d\'encadrants ne peut pas être négatif.',
            'nombre_cadres.required' => 'Le nombre de cadres est obligatoire.',
            'nombre_cadres.min' => 'Le nombre de cadres ne peut pas être négatif.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format jpeg, png, jpg, gif ou svg.',
            'image.max' => 'L\'image ne doit pas dépasser 2MB.',
            'document_pdf.mimes' => 'Le document doit être au format PDF.',
            'document_pdf.max' => 'Le document ne doit pas dépasser 10MB.',
            'type_formation_id.required' => 'Le type de formation est obligatoire.',
            'type_formation_id.exists' => 'Le type de formation sélectionné n\'existe pas.',
            'statut_formation_id.required' => 'Le statut de formation est obligatoire.',
            'statut_formation_id.exists' => 'Le statut de formation sélectionné n\'existe pas.',
            'entreprise_id.required' => 'L\'entreprise est obligatoire.',
            'entreprise_id.exists' => 'L\'entreprise sélectionnée n\'existe pas.',
            'themes.required' => 'Au moins un thème doit être sélectionné.',
            'themes.min' => 'Au moins un thème doit être sélectionné.',
            'themes.*.exists' => 'Un des thèmes sélectionnés n\'existe pas.',
            'formateurs.*.exists' => 'Un des formateurs sélectionnés n\'existe pas.'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Calculer automatiquement la durée totale
        if ($this->has('themes') && $this->has('themes_duree')) {
            $dureeTotale = 0;
            foreach ($this->themes as $index => $themeId) {
                $dureeTotale += $this->themes_duree[$index] ?? 0;
            }
            $this->merge(['duree' => $dureeTotale]);
        }
    }
}
