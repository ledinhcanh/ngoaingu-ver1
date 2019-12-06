<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChuyenNganh extends Model
{
    protected $table = 'chuyennganh';
    protected $fillable = [
        'id', 'name',
    ];

    public function Lop(){
    	return $this->hasMany('App\Models\Lop','idchuyennganh','id');
    }
}
