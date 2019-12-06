<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Muc extends Model
{
    protected $table = 'muc';
    protected $fillable = [
        'name', 'slug', 'status',
    ];
    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    protected $stt = [
        1 => [
            'name' => 'Public',
            'class' => 'btn-info'
        ],
        0 => [
            'name' => 'Private',
            'class' => 'btn-secondary'
        ]
    ];
    
    public function getStatus(){
        return array_get($this->stt, $this->status, '[N\A]');
    }

    public function ChuyenMuc(){
    	return $this->hasMany('App\Models\ChuyenMuc','idmuc','id');
    }

    public function BaiViet(){
    	return $this->hasManyThrough('App\Models\BaiViet','App\Models\ChuyenMuc','idmuc','idchuyenmuc', 'id');
    }

    public $timestamps = false;
}
