<?php

namespace App\Policies;

use App\Models\User;
use App\Muc;
use Illuminate\Auth\Access\HandlesAuthorization;

class MucPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the muc.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Muc  $muc
     * @return mixed
     */
    public function before(User $user){
        if($user->idquyenhan == 1){
            return true;
        }
    }
    public function view(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can create mucs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can update the muc.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Muc  $muc
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can delete the muc.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Muc  $muc
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can restore the muc.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Muc  $muc
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can permanently delete the muc.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Muc  $muc
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->idquyenhan == 2;
    }
}
