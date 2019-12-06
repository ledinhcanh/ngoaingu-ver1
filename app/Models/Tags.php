<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
    public function ThaoLuan(){
        return $this->belongsToMany(ThaoLuan::class,'post_tag');
    }
}
