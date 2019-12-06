<?php

namespace App\Policies;

use App\Models\User;
use App\GiangVien;
use Illuminate\Auth\Access\HandlesAuthorization;

class GiangVienPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the giang vien.
     *
     * @param  \App\Models\User  $user
     * @param  \App\GiangVien  $giangVien
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->idquyenhan == 1;
    }

    /**
     * Determine whether the user can create giang viens.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->idquyenhan == 1;
    }

    /**
     * Determine whether the user can update the giang vien.
     *
     * @param  \App\Models\User  $user
     * @param  \App\GiangVien  $giangVien
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->idquyenhan == 1;
    }

    /**
     * Determine whether the user can delete the giang vien.
     *
     * @param  \App\Models\User  $user
     * @param  \App\GiangVien  $giangVien
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->idquyenhan == 1;
    }

    /**
     * Determine whether the user can restore the giang vien.
     *
     * @param  \App\Models\User  $user
     * @param  \App\GiangVien  $giangVien
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->idquyenhan == 1;
    }

    /**
     * Determine whether the user can permanently delete the giang vien.
     *
     * @param  \App\Models\User  $user
     * @param  \App\GiangVien  $giangVien
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->idquyenhan == 1;
    }
}
