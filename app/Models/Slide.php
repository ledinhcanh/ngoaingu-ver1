<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slide';
    protected $fillable = [
        'name', 'image', 'content','status',
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
    
    public $timestamps = false;
}
