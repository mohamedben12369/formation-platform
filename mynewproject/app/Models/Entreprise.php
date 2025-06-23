<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'Adresse',
        'tel',
        'fax',
        'CNSS',
        'user_id',
        'IF',
        'RC',
        'ICE',
        'patente',
        'date_creation',
        'image',
        'website'
    ];

    protected $table = 'entreprises';

    protected $casts = [
        'date_creation' => 'date',
    ];    /**
     * Obtenir l'utilisateur associé à cette entreprise
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtenir les formations associées à cette entreprise
     */
    public function formations()
    {
        return $this->hasMany(Formation::class);
    }    /**
     * Obtenir l'URL complète de l'image
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
          // Debug : vérifier le chemin de l'image
        $fullPath = storage_path('app/public/' . $this->image);
        if (!file_exists($fullPath)) {
            Log::warning("Image not found: " . $fullPath);
        }
        
        return asset('storage/' . $this->image);
    }

    /**
     * Vérifier si l'image existe
     */
    public function hasImage()
    {
        return $this->image && file_exists(storage_path('app/public/' . $this->image));
    }

    /**
     * Scope pour rechercher les entreprises
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nom', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('Adresse', 'like', "%{$search}%")
              ->orWhere('CNSS', 'like', "%{$search}%");
        });
    }

    /**
     * Obtenir le nom complet de l'entreprise avec informations supplémentaires
     */
    public function getFullNameAttribute()
    {
        return $this->nom . ' (' . $this->email . ')';
    }
}
