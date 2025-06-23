<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'icone',
        'couleur',
        'obligatoire',
        'formats_autorises',
        'taille_max_mb',
        'actif'
    ];

    protected $casts = [
        'obligatoire' => 'boolean',
        'actif' => 'boolean',
    ];

    public function candidatureDocuments()
    {
        return $this->hasMany(CandidatureDocument::class);
    }

    public function getFormatsAutorisesArrayAttribute()
    {
        return explode(',', $this->formats_autorises);
    }

    public function getAcceptAttribute()
    {
        return '.' . str_replace(',', ',.', $this->formats_autorises);
    }

    public function getTailleMaxOctetsAttribute()
    {
        return $this->taille_max_mb * 1024 * 1024;
    }
}
