<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Auth\Access\Response;

class VehiculePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasRolePermission('naviguer_vehicules')) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasRolePermission('ajouter_vehicules')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        if ($user->hasRolePermission('modifier_vehicules')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        if ($user->hasRolePermission('supprimer_vehicules')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        if ($user->hasRolePermission('restaurer_vehicules')) {
            return true;
        } else {
            return false;
        }
    }
}
