<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Axe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
    ];

 

    public function themeformation()
    {
        return $this->hasMany(ThemeFormation::class, 'axes_id', 'id');
    }
}
