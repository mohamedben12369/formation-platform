<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatutFormation extends Model
{
    protected $table = 'statut_formations';
    
    protected $fillable = [
        'code',
        'nom',
        'dateCreation'
    ];

    protected $dates = [
        'dateCreation',
        'created_at',
        'updated_at'
    ];

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
} 