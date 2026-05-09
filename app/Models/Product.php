<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'category_id',
        'vendor_id',
    ];

    // ================= CATEGORY RELATION =================
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}