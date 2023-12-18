<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasRolePermission('gestion_role_permission')) {
            return true;
        } else{
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    // public function create(User $user): bool
    // {

    // }

    // /**
    //  * Determine whether the user can update the model.
    //  */
    // public function update(User $user): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can delete the model.
    //  */
    // public function delete(User $user): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user): bool
    // {
    //     //
    // }

}
