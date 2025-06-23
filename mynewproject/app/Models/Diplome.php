<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    use HasFactory;    protected $fillable = [
        'nom',
        'type_diplome_id',
        'etablissement_id',
        'date_obtention',
        'domaine_id',
        'niveau_id',
        'description',
        'user_id',
        'certificat'
    ];

    protected $casts = [
        'date_obtention' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function typeDiplome()
    {
        return $this->belongsTo(TypeDiplome::class);
    }

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
}
