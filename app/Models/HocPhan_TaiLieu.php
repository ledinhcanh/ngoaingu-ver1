<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HocPhan_TaiLieu extends Model
{
    protected $table = 'hocphan_tailieu';
    protected $fillable = [
        'hoc_phan_id','tai_lieu_id',
    ];
    public $timestamps = false;
}
