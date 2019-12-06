<?php

namespace App\Policies;

use App\Models\User;
use App\SinhVien;
use Illuminate\Auth\Access\HandlesAuthorization;

class SinhVienPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the sinh vien.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SinhVien  $sinhVien
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->idquyenhan == 1;
    }

    /**
     * Determine whether the user can create sinh viens.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->idquyenhan == 1;
    }

    /**
     * Determine whether the user can update the sinh vien.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SinhVien  $sinhVien
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->idquyenhan == 1;
    }

    /**
     * Determine whether the user can delete the sinh vien.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SinhVien  $sinhVien
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->idquyenhan == 1;
    }

    /**
     * Determine whether the user can restore the sinh vien.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SinhVien  $sinhVien
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->idquyenhan == 1;
    }

    /**
     * Determine whether the user can permanently delete the sinh vien.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SinhVien  $sinhVien
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->idquyenhan == 1;
    }
}
