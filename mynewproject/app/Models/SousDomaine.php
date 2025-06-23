<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SousDomaine extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'description',
        'domaine_code'
    ];

    /**
     * Indique si les horodatages du modèle doivent être utilisés.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * La clé primaire du modèle.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * La table associée au modèle.
     *
     * @var string
     */
    protected $table = 'sous_domaines';

    /**
     * Initialisation du modèle avec des hooks.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Vérifier que le code n'est pas vide
            if (empty($model->code)) {
                throw new \Exception('Le code du sous-domaine est requis');
            }
            
            // Vérifier que le domaine est spécifié
            if (!$model->domaine_code) {
                throw new \Exception('Le domaine est requis');
            }
        });
    }

    /**
     * Relation avec le domaine parent.
     *
     * @return BelongsTo
     */
    public function domaine(): BelongsTo
    {
        return $this->belongsTo(Domaine::class, 'domaine_code', 'id');
    }

    /**
     * Relation avec les thèmes de formation.
     *
     * @return HasMany
     */
    public function themeFormations(): HasMany
    {
        return $this->hasMany(ThemeFormation::class, 'sous_domaine_code', 'code');
    }

    /**
     * Alias pour la relation themeFormations.
     *
     * @return HasMany
     */
    public function themes(): HasMany
    {
        return $this->themeFormations();
    }
    
    /**
     * Obtenir tous les formateurs pour ce sous-domaine.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function formateurs()
    {
        return $this->belongsToMany(
            'App\Models\formateur',
            'formateur_sous_domaine',
            'sous_domaine_id',
            'formateur_id'
        )->withTimestamps();
    }
}
