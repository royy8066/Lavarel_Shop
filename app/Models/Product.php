<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    
    protected $fillable = [
        'ten_sanpham', 'giasp', 'img', 'mota', 'danhmuc_id', 'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'danhmuc_id');
    }
}
