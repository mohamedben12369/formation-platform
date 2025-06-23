<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeFormation extends Model
{
    use HasFactory;
    
    protected $table = 'theme_formations';
    protected $primaryKey = 'idtheme';
    public $incrementing = true;
    public $timestamps = false;    protected $fillable = [
        'titre',
        'prix',
        'prerequis',
        'competence_visees',
        'sous_domaine_code',
        'axes_id',
        'duree',
        'description',
        'objectifs'
    ];    protected $casts = [
        'prix' => 'decimal:2',
        'duree' => 'integer'
    ];

    /**
     * Relations
     */
    public function sousDomaine()
    {
        return $this->belongsTo(SousDomaine::class, 'sous_domaine_code', 'code');
    }

    public function axe()
    {
        return $this->belongsTo(Axe::class, 'axes_id', 'id');
    }    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_theme', 'theme_id', 'formation_id')
                    ->withPivot(['prix', 'duree_heures', 'date_debut', 'date_fin'])
                    ->withTimestamps();
    }

    /**
     * Relation avec les prérequis
     */
    
   

    /**
     * Scopes
     */
    public function scopeByDomaine($query, $domaineId)
    {
        return $query->whereHas('sousDomaine', function($q) use ($domaineId) {
            $q->where('domaine_code', $domaineId);
        });
    }

    public function scopeByAxe($query, $axeId)
    {
        return $query->where('axes_id', $axeId);
    }

    public function scopeBySousDomaine($query, $sousDomaineCode)
    {
        return $query->where('sous_domaine_code', $sousDomaineCode);
    }

    /**
     * Accesseurs
     */
    public function getPrerequisArrayAttribute()
    {
        return $this->prerequis ? explode(',', $this->prerequis) : [];
    }

    public function getCompetenceViseesArrayAttribute()
    {
        return $this->competence_visees ? explode(',', $this->competence_visees) : [];
    }
}
