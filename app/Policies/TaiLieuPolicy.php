<?php

namespace App\Policies;

use App\Models\User;
use App\TaiLieu;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaiLieuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the tai lieu.
     *
     * @param  \App\Models\User  $user
     * @param  \App\TaiLieu  $taiLieu
     * @return mixed
     */
    public function before(User $user){
        if($user->idquyenhan == 1 || $user->idquyenhan == 2){
            return true;
        }
    }
    public function view(User $user)
    {
        return $user->idquyenhan == 3;
    }

    /**
     * Determine whether the user can create tai lieus.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->idquyenhan == 3;
    }

    /**
     * Determine whether the user can update the tai lieu.
     *
     * @param  \App\Models\User  $user
     * @param  \App\TaiLieu  $taiLieu
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->idquyenhan == 3;
    }

    /**
     * Determine whether the user can delete the tai lieu.
     *
     * @param  \App\Models\User  $user
     * @param  \App\TaiLieu  $taiLieu
     * @return mixed
     */
    public function delete(User $user, TaiLieu $taiLieu)
    {
        return $user->idquyenhan == 3;
    }

    /**
     * Determine whether the user can restore the tai lieu.
     *
     * @param  \App\Models\User  $user
     * @param  \App\TaiLieu  $taiLieu
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->idquyenhan == 3;
    }

    /**
     * Determine whether the user can permanently delete the tai lieu.
     *
     * @param  \App\Models\User  $user
     * @param  \App\TaiLieu  $taiLieu
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->idquyenhan == 3;
    }
}
