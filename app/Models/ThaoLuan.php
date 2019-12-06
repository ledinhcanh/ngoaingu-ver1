<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThaoLuan extends Model
{
    protected $table = 'baithaoluan';
    protected $fillable = [
        'title', 'content', 'file', 'idtaikhoan', 'created_at', 'updated_at', 'status', 'format'
    ];
    public function Tags(){
    	return $this->belongsToMany(Tags::class,'post_tag');
    }
    public function BinhLuan(){
        return $this->hasMany('App\Models\BinhLuan', 'idbaithaoluan', 'id');
    }
    public function TaiKhoan()
    {
        return $this->belongsTo('App\Models\User', 'idtaikhoan', 'id');
    }
    protected $stt = [
        1 => [
            'name' => 'Đã duyệt',
            'class' => 'btn-info'
        ],
        0 => [
            'name' => 'Duyệt bài',
            'class' => 'btn-secondary'
        ]
    ];
    
    public function getStatus(){
        return array_get($this->stt, $this->status, '[N\A]');
    }
    
}
