<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation extends Model
{
    use HasFactory;
    
    protected $table = 'formations';

    protected $fillable = [
        'nom',
        'dateDebut', 
        'dateFin',
        'lieu',
        'nombre_ouvriers',
        'nombre_encadrants', 
        'nombre_cadres',
        'duree',
        'moyennes',
        'prerequis',
        'programme',
        'objectifs',
        'image',
        'document_pdf',
        'DatedeCreation',
        'type_formation_id',
        'statut_formation_id',
        'domaine_id',
        'entreprise_id'
    ];

    protected $casts = [
        'dateDebut' => 'date',
        'dateFin' => 'date', 
        'DatedeCreation' => 'date',
        'nombre_ouvriers' => 'integer',
        'nombre_encadrants' => 'integer',
        'nombre_cadres' => 'integer',
        'duree' => 'integer'
    ];

    protected $appends = ['prix_total', 'duree_totale', 'competences_visees', 'prerequis_calcules'];

    /**
     * Relations
     */
    public function typeFormation()
    {
        return $this->belongsTo(TypeFormation::class, 'type_formation_id');
    }

    public function statutFormation()
    {
        return $this->belongsTo(StatutFormation::class, 'statut_formation_id');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id');
    }

    public function domaine()
    {
        return $this->belongsTo(Domaine::class, 'domaine_id');
    }

    public function sousDomaine()
    {
        return $this->belongsTo(SousDomaine::class, 'sous_domaine_code', 'code');
    }

    /**
     * Relation many-to-many avec ThemeFormation via table pivot avec données supplémentaires
     */
    public function themes()
    {
        return $this->belongsToMany(ThemeFormation::class, 'formation_theme', 'formation_id', 'theme_id')
                    ->withPivot(['prix', 'duree_heures', 'date_debut', 'date_fin'])
                    ->withTimestamps();
    }

    /**
     * Relation many-to-many avec les formateurs (users avec role formateur)
     */
    public function formateurs()
    {
        return $this->belongsToMany(User::class, 'formation_formateur', 'formation_id', 'formateur_id')
                    ->withTimestamps();
    }

    /**
     * Accesseurs calculés
     */
    public function getPrixTotalAttribute()
    {
        if (!$this->relationLoaded('themes')) {
            $this->load('themes');
        }
        return $this->themes->sum(function($theme) {
            return $theme->pivot->prix ?? 0;
        });
    }

    public function getDureeTotaleAttribute()
    {
        if (!$this->relationLoaded('themes')) {
            $this->load('themes');
        }
        return $this->themes->sum(function($theme) {
            return $theme->pivot->duree_heures ?? 0;
        });
    }

    public function getCompetencesViseesAttribute()
    {
        $competences = collect();
        foreach ($this->themes as $theme) {
            if ($theme->competence_visees) {
                $competences = $competences->merge(explode(',', $theme->competence_visees));
            }
        }
        return $competences->map('trim')->filter()->unique()->implode(', ');
    }

    public function getPrerequisCalculesAttribute()
    {
        $prerequis = collect();
        foreach ($this->themes as $theme) {
            if ($theme->prerequis) {
                $prerequis = $prerequis->merge(explode(',', $theme->prerequis));
            }
        }
        return $prerequis->map('trim')->filter()->unique()->implode(', ');
    }

    /**
     * Scopes
     */
    public function scopeByEntreprise($query, $entrepriseId)
    {
        return $query->where('entreprise_id', $entrepriseId);
    }

    public function scopeByStatut($query, $statutId)
    {
        return $query->where('statut_formation_id', $statutId);
    }

    public function scopeByType($query, $typeId)
    {
        return $query->where('type_formation_id', $typeId);
    }

    public function scopeEnCours($query)
    {
        return $query->where('dateDebut', '<=', now())
                    ->where('dateFin', '>=', now());
    }

    public function scopeAVenir($query)
    {
        return $query->where('dateDebut', '>', now());
    }

    public function scopeTerminees($query)
    {
        return $query->where('dateFin', '<', now());
    }

    /**
     * Méthodes utiles
     */
    public function addTheme($themeId, $prix = null, $dureeHeures = null, $dateDebut = null, $dateFin = null)
    {
        $theme = ThemeFormation::find($themeId);
        if (!$theme) {
            return false;
        }

        $this->themes()->attach($themeId, [
            'prix' => $prix ?? $theme->prix,
            'duree_heures' => $dureeHeures ?? $theme->duree,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return true;
    }

    public function removeTheme($themeId)
    {
        return $this->themes()->detach($themeId);
    }

    public function updateTheme($themeId, $data)
    {
        return $this->themes()->updateExistingPivot($themeId, array_merge($data, [
            'updated_at' => now()
        ]));
    }

    public function addFormateur($formateurId)
    {
        return $this->formateurs()->attach($formateurId);
    }

    public function removeFormateur($formateurId)
    {
        return $this->formateurs()->detach($formateurId);
    }

    /**
     * Met à jour la durée totale de la formation basée sur les thèmes
     */
    public function updateDureeFromThemes()
    {
        $dureeTotal = $this->themes->sum(function($theme) {
            return $theme->pivot->duree_heures ?? 0;
        });
        $this->update(['duree' => $dureeTotal]);
    }

    /**
     * Met à jour les prérequis de la formation basés sur les thèmes
     */
    public function updatePrerequisFromThemes()
    {
        $prerequis = collect();
        foreach ($this->themes as $theme) {
            if ($theme->prerequis) {
                $prerequis = $prerequis->merge(explode(',', $theme->prerequis));
            }
        }
        $prerequisString = $prerequis->map('trim')->filter()->unique()->implode(', ');
        $this->update(['prerequis' => $prerequisString]);
    }

    /**
     * Met à jour à la fois la durée et les prérequis
     */
    public function updateFromThemes()
    {
        $this->updateDureeFromThemes();
        $this->updatePrerequisFromThemes();
    }
}
