<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'images',
        'stock',
        'status',
        'category_id',
        'vendor_id',
    ];

    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
        'stock'  => 'integer',
    ];

    /* ================= RELATIONS ================= */

    public function category()
    {
        return $this->belongsTo(Category::class)
            ->withDefault([
                'name' => 'No Category'
            ]);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /* ================= IMAGE (SAFE + FAST) ================= */

    public function getFirstImageAttribute()
    {
        $images = $this->images;

        if (is_array($images) && !empty($images)) {
            return Storage::url($images[0]);
        }

        if (is_string($images)) {
            $decoded = json_decode($images, true);

            if (is_array($decoded) && !empty($decoded)) {
                return Storage::url($decoded[0]);
            }
        }

        return asset('images/no-image.png');
    }

    public function getAllImagesAttribute()
    {
        $images = $this->images;

        if (is_string($images)) {
            $images = json_decode($images, true);
        }

        if (!is_array($images)) {
            return [];
        }

        return collect($images)->map(function ($img) {
            return Storage::url($img);
        })->toArray();
    }

    /* ================= SCOPES ================= */

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeVendor($query, $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    public function scopeSearch($query, $term)
    {
        if (!$term) return $query;

        return $query->where(function ($q) use ($term) {
            $q->where('name', 'LIKE', "%{$term}%")
              ->orWhere('description', 'LIKE', "%{$term}%");
        });
    }
}