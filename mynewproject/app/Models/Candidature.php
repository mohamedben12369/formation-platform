<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',
        'user_id',
        'nom',
        'prenom',
        'email',
        'telephone',
        'motivation',
        'statut'
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(CandidatureDocument::class);
    }

    public function getStatutBadgeAttribute()
    {
        $badges = [
            'en_attente' => 'bg-warning',
            'accepte' => 'bg-success',
            'refuse' => 'bg-danger'
        ];

        return $badges[$this->statut] ?? 'bg-secondary';
    }

    public function getStatutTextAttribute()
    {
        $texts = [
            'en_attente' => 'En attente',
            'accepte' => 'Accepté',
            'refuse' => 'Refusé'
        ];

        return $texts[$this->statut] ?? 'Inconnu';
    }

    public function hasDocumentType($typeDocumentId)
    {
        return $this->documents()->where('type_document_id', $typeDocumentId)->exists();
    }

    public function getDocumentByType($typeDocumentId)
    {
        return $this->documents()->where('type_document_id', $typeDocumentId)->first();
    }

    public function getNomsCompletsAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
