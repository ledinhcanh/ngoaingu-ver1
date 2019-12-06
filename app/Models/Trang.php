<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trang extends Model
{
    protected $table = 'trang';
    protected $fillable = [
        'title',  'slug', 'content', 'image', 'status', 'description'
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
}
