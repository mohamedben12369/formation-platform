<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeExperience extends Model
{
    use HasFactory;


    protected $fillable = ['nom'




];
    public $timestamps = false;
    protected $table = 'type_experiences';
}
