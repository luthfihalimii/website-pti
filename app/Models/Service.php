<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'status',
        'sort_order',
        'image',
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}