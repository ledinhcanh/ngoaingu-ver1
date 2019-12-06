<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaiLieu extends Model
{
    protected $table = 'tailieu';
    protected $fillable = ['name', 'slug', 'content','description', 'image', 'file', 'format', 'namxb', 'author', 'view', 'download', 'idnhaxuatban', 'idtaikhoan', 'idloaitailieu', 'idngonngu'];
    public function TaiKhoan()
    {
        return $this->belongsTo('App\Models\User', 'idtaikhoan', 'id');
    }
    public function NgonNgu()
    {
        return $this->belongsTo('App\Models\NgonNgu', 'idngonngu', 'id');
    }
    public function LoaiTaiLieu()
    {
        return $this->belongsTo('App\Models\LoaiTaiLieu', 'idloaitailieu', 'id');
    }
    public function NhaXuatBan()
    {
        return $this->belongsTo('App\Models\NhaXuatBan', 'idnhaxuatban', 'id');
    }
}
