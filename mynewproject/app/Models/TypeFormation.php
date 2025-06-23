<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeFormation extends Model
{
    use HasFactory;    protected $fillable = [
        'code',
        'nom'
    ];

    // Relation avec les formations
    public function formations()
    {
        return $this->hasMany(Formation::class);
    }
} 