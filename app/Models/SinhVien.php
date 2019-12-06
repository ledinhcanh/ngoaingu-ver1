<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    protected $table = 'sinhvien';
    protected $fillable = [
        'masv', 'fullname', 'birthday', 'sex', 'avatar', 'idlop', 'idtaikhoan',
    ];

    public function TaiKhoan(){
        return $this->belongsTo('App\Models\User','idtaikhoan','id');
    }
    public function Lop(){
        return $this->belongsTo('App\Models\Lop','idlop','id');
    }
    public $timestamps = false;
}
