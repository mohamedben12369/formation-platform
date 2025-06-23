<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'experience';

    protected $fillable = [
        'nom',
        'date_debut',
        'date_fin',
        'lieu',
        'titre',
        'entreprise',
        'user_id',
        'type_experience_id',
        'description',
        'attestation',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function typeExperience()
    {
        return $this->belongsTo(TypeExperience::class, 'type_experience_id');
    }
}
