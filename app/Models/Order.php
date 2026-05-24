<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'shipping_address',
        'total_price',
        'payment_method',
        'payment_status',
        'order_status',
    ];

    // USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ITEMS
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}