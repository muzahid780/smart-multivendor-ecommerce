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
        'is_approved',
        'approval_status',
    ];
    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
        'is_approved' => 'boolean',
        'stock' => 'integer',
    ];

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
    public function getFirstImageAttribute()
    {
        $images = $this->images;
        if (is_array($images) && count($images)) {
            return Storage::url($images[0]);
        }
        return asset('images/no-image.png');
    }
    public function getAllImagesAttribute()
    {
        if (!is_array($this->images)) {
            return [];
        }
        return collect($this->images)->map(function ($img) {
            return Storage::url($img);
        })->toArray();
    }

    // active products
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeApproved($query)
    {
        return $query
            ->where('status', 1)
            ->where('is_approved', true)
            ->where('approval_status', 'approved');
    }
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }
    public function scopeVendor($query, $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    // search
    public function scopeSearch($query, $term)
    {
        if (!$term) {
            return $query;
        }
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'LIKE', "%{$term}%")
                ->orWhere('description', 'LIKE', "%{$term}%");
        });
    }
}