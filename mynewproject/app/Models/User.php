<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'tel',
        'date_de_naissance',
        'adresse',
        'role_id',
        'reponse',
        'is_active',
        'password',
        'securite_question_id',
        'remember_token',
        'profile_image',
        'background_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'date_de_naissance' => 'date',
    ];

    public function securiteQuestion()
    {
        return $this->belongsTo(SecuriteQuestion::class, 'securite_question_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function hasPermission($permission)
    {
        if ($this->permissions->contains('name', $permission)) {
            return true;
        }
        if ($this->role && $this->role->permissions->contains('name', $permission)) {
            return true;
        }
        return false;
    }

    public function competences()
    {
        return $this->hasMany(Competence::class, 'user_id');
    }

    public function diplomes()
    {
        return $this->hasMany(Diplome::class, 'user_id');
    }    public function experiences()
    {
        return $this->hasMany(Experience::class, 'user_id');
    }    public function entreprise()
    {
        return $this->hasOne(Entreprise::class, 'user_id');
    }

    /**
     * Relation many-to-many avec les formations (pour les formateurs)
     */
    public function formations()
    {
        return $this->belongsToMany(Formation::class, 'formation_formateur', 'formateur_id', 'formation_id')
                    ->withTimestamps();
    }

    /**
     * Get the URL for the user's profile image.
     */
    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image 
            ? Storage::url($this->profile_image)
            : asset('images/default-avatar.png');
    }

    /**
     * Get the URL for the user's background image.
     */
    public function getBackgroundImageUrlAttribute()
    {
        return $this->background_image 
            ? Storage::url($this->background_image)
            : null;
    }

    /**
     * Check if the user's profile is complete.
     */
    public function isProfileComplete()
    {
        return !empty($this->nom) && 
               !empty($this->prenom) && 
               !empty($this->email) && 
               !empty($this->tel) && 
               !empty($this->date_de_naissance);
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
