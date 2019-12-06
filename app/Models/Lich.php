<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lich extends Model
{
    protected $table = 'lich';
    protected $fillable = ['title', 'color', 'start_date', 'end_date'];
    public $timestamps = false;
}
