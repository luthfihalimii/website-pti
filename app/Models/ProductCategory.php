<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'sort_order',
        'is_active',
    ];

    // Properti untuk casting atribut
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi ke produk
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Relasi ke layanan
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}