<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'niveau_id',
        'sous_domaines_id',
        'user_id',
    ];

    /**
     * Get the niveau associated with the competence.
     */
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    /**
     * Get the sous domaine associated with the competence.
     */
    public function sousDomaine()
    {
        return $this->belongsTo(SousDomaine::class, 'sous_domaines_id');
    }

    /**
     * Get the user who owns the competence.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
