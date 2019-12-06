<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    protected $table = 'lop';

    protected $fillable = [
        'id', 'name', 'idchuyennganh',
    ];
    public function ChuyenNganh(){
    	return $this->belongsTo('App\Models\ChuyenNganh','idchuyennganh','id');
    }
    public $timestamps = false;
}
