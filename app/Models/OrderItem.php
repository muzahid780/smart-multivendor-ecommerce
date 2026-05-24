<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'vendor_id',
        'quantity',
        'price',
    ];

    // ================= ORDER =================
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // ================= PRODUCT =================
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // ================= VENDOR =================
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}