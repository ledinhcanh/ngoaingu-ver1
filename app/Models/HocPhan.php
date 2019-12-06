<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HocPhan extends Model
{
    protected $table = 'hocphan';
    protected $fillable = [
        'name', 'code', 'number', 'idhocki', 'idchuyennganh',
    ];
    public function TaiLieu()
    {
        return $this->belongsToMany(TaiLieu::class, 'hocphan_tailieu');
    }
    public function HocKi()
    {
        return $this->belongsTo('App\Models\HocKi', 'idhocki', 'id');
    }
    public function ChuyenNganh()
    {
        return $this->belongsTo('App\Models\ChuyenNganh', 'idchuyennganh', 'id');
    }
    public $timestamps = false;
}
