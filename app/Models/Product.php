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
    ];
    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
        'stock' => 'integer',
    ];

    // Category Relation
    public function category()
    {
        return $this->belongsTo(Category::class)
            ->withDefault([
                'name' => 'No Category'
            ]);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
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
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }
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