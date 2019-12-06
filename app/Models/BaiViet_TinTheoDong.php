<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiViet_TinTheoDong extends Model
{
    protected $table = 'baiviet_tintheodong';
    protected $fillable = [
        'bai_viet_id','tin_theo_dong_id',
    ];
}
