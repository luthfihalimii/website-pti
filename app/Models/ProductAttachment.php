<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProductAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'title',
        'path',
        'disk',
        'mime_type',
        'sort_order',
    ];

    // Relasi ke model Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Menambahkan URL untuk lampiran
    protected function getUrlAttribute(): string
    {
        // Jika disk adalah 'public', kita dapat langsung menggunakan URL /storage
        if ($this->disk === 'public') {
            return '/storage/' . ltrim($this->path, '/');
        }

        // Untuk disk selain 'public', menggunakan Storage::disk($this->disk)->url() untuk mendapatkan URL file
        return Storage::disk($this->disk)->url($this->path);
    }
}