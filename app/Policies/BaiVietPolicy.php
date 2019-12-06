<?php

namespace App\Policies;

use App\Models\User;
use App\BaiViet;
use Illuminate\Auth\Access\HandlesAuthorization;

class BaiVietPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the bai viet.
     *
     * @param  \App\Models\User  $user
     * @param  \App\BaiViet  $baiViet
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
     * Determine whether the user can create bai viets.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can update the bai viet.
     *
     * @param  \App\Models\User  $user
     * @param  \App\BaiViet  $baiViet
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can delete the bai viet.
     *
     * @param  \App\Models\User  $user
     * @param  \App\BaiViet  $baiViet
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can restore the bai viet.
     *
     * @param  \App\Models\User  $user
     * @param  \App\BaiViet  $baiViet
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->idquyenhan == 2;
    }

    /**
     * Determine whether the user can permanently delete the bai viet.
     *
     * @param  \App\Models\User  $user
     * @param  \App\BaiViet  $baiViet
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->idquyenhan == 2;
    }
}
