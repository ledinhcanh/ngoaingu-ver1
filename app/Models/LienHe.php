<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LienHe extends Model
{
    protected $table = 'lienhe';
    protected $fillable = [
        'fullname', 'email', 'content', 'phone', 'address',
    ];
    public $timestamps = false;
}
