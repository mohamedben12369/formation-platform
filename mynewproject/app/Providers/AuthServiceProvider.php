<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Diplome;
use App\Policies\DiplomePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Diplome::class => DiplomePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
} 