<?php

namespace App\Policies;

use App\Enums\RoleKey;
use App\Models\User;
use App\Models\vACC;
use Illuminate\Auth\Access\HandlesAuthorization;

class VACCPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return in_array($user->role->key, [
            RoleKey::SYS,
            RoleKey::VDI,
            RoleKey::VACC_STAFF,
        ]);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\vACC  $vACC
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, vACC $vACC)
    {
        return in_array($user->role->key, [
            RoleKey::SYS,
            RoleKey::VDI,
            RoleKey::VACC_STAFF,
        ]);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\vACC  $vACC
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, vACC $vACC)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\vACC  $vACC
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, vACC $vACC)
    {
        return in_array($user->role->key, [RoleKey::SYS]);
    }

    public function deleteAny(User $user)
    {
        return in_array($user->role->key, [RoleKey::SYS]);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\vACC  $vACC
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, vACC $vACC)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\vACC  $vACC
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, vACC $vACC)
    {
        //
    }
}
