<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichTuan extends Model
{
    protected $table = 'lichtuan';
    protected $fillable = ['title', 'slug', 'tuan', 'nam', 'file', 'tungay', 'denngay'];
    public $timestamps = false;
}
