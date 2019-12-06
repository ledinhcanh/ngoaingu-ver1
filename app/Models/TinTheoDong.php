<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TinTheoDong extends Model
{
    protected $table = 'tintheodong';
    public function BaiViet(){
        return $this->belongsToMany(BaiViet::class,'baiviet_tintheodong');
    }
}
