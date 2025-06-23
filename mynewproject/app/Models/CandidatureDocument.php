<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CandidatureDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidature_id',
        'type_document_id',
        'nom_fichier',
        'nom_original',
        'chemin_fichier',
        'extension',
        'taille_ko'
    ];

    public function candidature()
    {
        return $this->belongsTo(Candidature::class);
    }

    public function typeDocument()
    {
        return $this->belongsTo(TypeDocument::class);
    }

    public function getTailleFormateeAttribute()
    {
        if ($this->taille_ko < 1024) {
            return $this->taille_ko . ' Ko';
        } else {
            return round($this->taille_ko / 1024, 2) . ' Mo';
        }
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->chemin_fichier);
    }

    public function exists()
    {
        return Storage::disk('public')->exists($this->chemin_fichier);
    }
}
