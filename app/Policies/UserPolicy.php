<?php

namespace App\Policies;

use App\Enums\RoleKey;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function view(User $user, User $model)
  {
    return in_array($user->role->key, [
      RoleKey::SYS,
      RoleKey::VDI,
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
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function update(User $user, User $model)
  {
    switch ($user->role->key) {
      case RoleKey::SYS:
        return true;
      case RoleKey::VDI:
        if ($user->id === $model->id) {
          return false;
        }
        return $model->role->key !== RoleKey::SYS;
    }

    return false;
  }

  /**
   * Determine whether the user can delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function delete(User $user, User $model)
  {
    return false;
  }

  /**
   * Determine whether the user can restore the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function restore(User $user, User $model)
  {
    return false;
  }

  /**
   * Determine whether the user can permanently delete the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function forceDelete(User $user, User $model)
  {
    return false;
  }

  /**
   * Determine whether the user can detach any model.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function detachAny(User $user)
  {
    return in_array($user->role->key, [RoleKey::SYS]);
  }

  /**
   * Determine whether the user can detach the model.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\User  $model
   * @return \Illuminate\Auth\Access\Response|bool
   */
  public function detach(User $user, User $model)
  {
    return in_array($user->role->key, [RoleKey::SYS]);
  }
}
