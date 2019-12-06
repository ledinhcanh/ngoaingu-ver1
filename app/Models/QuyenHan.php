<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuyenHan extends Model
{
    protected $table = 'quyenhan';

    protected $fillable = [
        'id', 'name',
    ];
}
