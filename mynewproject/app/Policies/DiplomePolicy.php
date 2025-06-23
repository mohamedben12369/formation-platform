<?php

namespace App\Policies;

use App\Models\Diplome;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiplomePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Diplome $diplome)
    {
        return $user->id === $diplome->utilisateur_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Diplome $diplome)
    {
        return $user->id === $diplome->utilisateur_id;
    }

    public function delete(User $user, Diplome $diplome)
    {
        return $user->id === $diplome->utilisateur_id;
    }
} 