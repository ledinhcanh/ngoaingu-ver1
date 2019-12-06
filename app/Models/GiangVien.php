<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiangVien extends Model
{
    protected $table = 'giangvien';
    protected $fillable = [
        'magv', 'fullname', 'birthday', 'sex', 'avatar', 'idbomon', 'idtaikhoan', 'idtthn', 'address', 'ngaycongtac', 'tdchuyenmon', 'tdngoaingu',
    ];

    public function TaiKhoan()
    {
        return $this->belongsTo('App\Models\User', 'idtaikhoan', 'id');
    }
    public function BoMon()
    {
        return $this->belongsTo('App\Models\BoMon', 'idbomon', 'id');
    }
    public function TTHN()
    {
        return $this->belongsTo('App\Models\TinhTrangHonNhan', 'idtthn', 'id');
    }
    public function MonHoc()
    {
        return $this->belongsToMany(MonHoc::class, 'giangvien_monhoc');
    }
    // public function GiangVienMonHoc(){
    //     return $this->hasMany('App\Models\GiangVien_MonHoc','idgiangvien', 'id');
    // }
    public $timestamps = false;
}
