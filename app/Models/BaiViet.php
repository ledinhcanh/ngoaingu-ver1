<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $table = 'baiviet';
    protected $fillable = [
        'title', 'slug', 'description', 'content', 'highlight', 'image', 'view', 'status', 'idchuyenmuc'
    ];

    public function ChuyenMuc(){
        return $this->belongsTo('App\Models\ChuyenMuc','idchuyenmuc','id');
    }

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

    const HIGHLIGHT_PUBLIC = 1;
    const HIGHLIGHT_PRIVATE = 0;

    protected $hot = [
        1 => [
            'name' => 'Nổi bật',
            'class' => 'btn-success'
        ],
        0 => [
            'name' => 'Không',
            'class' => 'btn-secondary'
        ]
    ];
    
    public function getHL(){
        return array_get($this->hot, $this->highlight, '[N\A]');
    }
    public function TinTheoDong()
    {
        return $this->belongsToMany(TinTheoDong::class, 'baiviet_tintheodong');
    }
}
