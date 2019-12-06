<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    protected $table = 'binhluan';
    protected $fillable = ['content', 'idbaithaoluan', 'idtaikhoan', 'created_at', 'updated_at'];

    public function TaiKhoan()
    {
        return $this->belongsTo('App\Models\User', 'idtaikhoan', 'id');
    }
}
