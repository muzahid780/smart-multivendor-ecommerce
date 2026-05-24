<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Product;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /*
    |--------------------------
    | MASS ASSIGNABLE FIELDS
    |--------------------------
    */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',   // ✅ ADD THIS (IMPORTANT)
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------
    | RELATIONSHIPS
    |--------------------------
    */

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}