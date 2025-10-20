<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'fullname', 'email', 'sdt', 'diachi', 'tongtien', 'payment_method', 'trang_thai', 'vnpay_txn_ref',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    // Nếu bạn có quan hệ với các bảng khác (ví dụ: người dùng), bạn có thể định nghĩa các phương thức quan hệ
    public function login()
    {
        return $this->belongsTo(Login::class, 'user_id'); // Quan hệ với bảng users
    }
}

