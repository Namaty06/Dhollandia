<?php

namespace App\Policies;

use App\Models\Examen;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExamenPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasRolePermission('naviguer_examens')) {
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
        if ($user->hasRolePermission('ajouter_examens')) {
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
        if ($user->hasRolePermission('modifier_examens')) {
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
        if ($user->hasRolePermission('supprimer_examens')) {
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
        if ($user->hasRolePermission('restaurer_examens')) {
            return true;
        } else {
            return false;
        }
    }

}
