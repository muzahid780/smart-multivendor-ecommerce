<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'user_id',

        'phone',

        'shipping_address',

        'total_price',

        'admin_commission',

        'payment_method',

        'payment_status',

        'order_status',
    ];

    /*
    |--------------------------------------------------------------------------
    | TYPE CASTING
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'total_price' => 'decimal:2',

        'admin_commission' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // customer
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    // total quantity
    public function getTotalItemsAttribute()
    {
        return $this->items->sum('quantity');
    }

    // vendor earnings
    public function getVendorEarningsAttribute()
    {
        return $this->total_price - $this->admin_commission;
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    // completed orders
    public function scopeCompleted($query)
    {
        return $query->where('order_status', 'completed');
    }

    // pending orders
    public function scopePending($query)
    {
        return $query->where('order_status', 'pending');
    }

    // processing orders
    public function scopeProcessing($query)
    {
        return $query->where('order_status', 'processing');
    }

    // paid orders
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }
}