<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Configuration;
use App\Models\Role;
use App\Models\Societe;
use App\Models\User;
use App\Models\Vehicule;
use App\Policies\ConfigurationPolicy;
use App\Policies\RolePolicy;
use App\Policies\SocietePolicy;
use App\Policies\UserPolicy;
use App\Policies\VehiculePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Vehicule::class => VehiculePolicy::class,
        User::class => UserPolicy::class,
        Configuration::class => ConfigurationPolicy::class,
        Role::class => RolePolicy::class,
        Societe::class=> SocietePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
