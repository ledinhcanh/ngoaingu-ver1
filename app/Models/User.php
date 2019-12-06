<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'taikhoan';

    protected $fillable = [
        'name', 'email', 'display_name', 'password', 'idquyenhan',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function GiangVien()
    {
        return $this->hasOne('App\Models\GiangVien', 'idtaikhoan', 'id');
    }
    public function SinhVien()
    {
        return $this->hasOne('App\Models\SinhVien', 'idtaikhoan', 'id');
    }
    public function QuyenHan()
    {
        return $this->belongsTo('App\Models\QuyenHan', 'idquyenhan', 'id');
    }

    public $timestamps = false;
}
