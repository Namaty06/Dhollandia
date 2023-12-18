<?php

namespace App\Policies;

use App\Models\TypeVehicule;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TypeVehiculePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasRolePermission('navigate_typevehicules')) {
            return true;
        } else{
            return false;
        }
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasRolePermission('add_typevehicules')) {
            return true;
        } else{
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        if ($user->hasRolePermission('update_typevehicules')) {
            return true;
        } else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        if ($user->hasRolePermission('delete_typevehicules')) {
            return true;
        } else{
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        if ($user->hasRolePermission('restore_typevehicules')) {
            return true;
        } else{
            return false;
        }
    }


}
