<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChuyenMuc extends Model
{
    protected $table = 'chuyenmuc';
    protected $fillable = ['name', 'slug', 'status', 'idmuc'];

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
    
    public function Muc(){
    	return $this->belongsTo('App\Models\Muc','idmuc','id');
    }
    
    public function BaiViet(){
    	return $this->hasMany('App\Models\BaiViet','idchuyenmuc','id');
    }
    
    public $timestamps = false;
}
