<?php

namespace App\Policies;

use App\Models\Rapport;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RapportPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasRolePermission('naviguer_rapports')) {
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
        if ($user->hasRolePermission('ajouter_rapports')) {
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
        if ($user->hasRolePermission('modifier_rapports')) {
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
        if ($user->hasRolePermission('supprimer_rapports')) {
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
        if ($user->hasRolePermission('restaurer_rapports')) {
            return true;
        } else {
            return false;
        }
    }
}
