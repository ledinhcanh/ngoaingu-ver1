<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiangVien_MonHoc extends Model
{
    protected $table = 'giangvien_monhoc';
    protected $fillable = [
        'giang_vien_id','mon_hoc_id',
    ];

    // public function MonHoc(){
    //     return $this->belongsTo('App\Models\MonHoc','id','mh_id');
    // }
    // public function GiangVien(){
    //     return $this->belongsTo('App\Models\GiangVien','id','gv_id');
    // }
}
