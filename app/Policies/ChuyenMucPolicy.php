<?php

namespace App\Policies;

use App\Models\User;
use App\ChuyenMuc;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChuyenMucPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the chuyen muc.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ChuyenMuc  $chuyenMuc
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
     * Determine whether the user can create chuyen mucs.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can update the chuyen muc.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ChuyenMuc  $chuyenMuc
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can delete the chuyen muc.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ChuyenMuc  $chuyenMuc
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can restore the chuyen muc.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ChuyenMuc  $chuyenMuc
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can permanently delete the chuyen muc.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ChuyenMuc  $chuyenMuc
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->idquyenhan == 2;
    }
}
