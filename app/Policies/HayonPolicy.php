<?php

namespace App\Policies;

use App\Models\Hayon;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HayonPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasRolePermission('naviguer_hayons')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {

        if ($user->hasRolePermission('naviguer_hayons')) {
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

        if ($user->hasRolePermission('ajouter_hayons')) {
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

        if ($user->hasRolePermission('modifier_hayons')) {
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

        if ($user->hasRolePermission('supprimer_hayons')) {
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

        if ($user->hasRolePermission('restaurer_hayons')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        if ($user->hasRolePermission('restaurer_hayons')) {
            return true;
        } else {
            return false;
        }
    }
}
