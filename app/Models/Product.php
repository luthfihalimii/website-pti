<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';

    public const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'excerpt',
        'description',
        'status',
        'is_featured',
        'cover_image_path',
        'cover_image_disk',
        'seo_title',
        'seo_description',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', self::STATUS_PUBLISHED);
    }

    public function features(): HasMany
    {
        return $this->hasMany(ProductFeature::class)->orderBy('sort_order');
    }

    public function media(): HasMany
    {
        return $this->hasMany(ProductMedia::class)->orderBy('sort_order');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ProductAttachment::class)->orderBy('sort_order');
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(ProductInquiry::class);
    }

    protected function getCoverImageUrlAttribute(): ?string
    {
        if (! $this->cover_image_path || ! $this->cover_image_disk) {
            return null;
        }

        if ($this->cover_image_disk === 'public') {
            return '/storage/'.ltrim($this->cover_image_path, '/');
        }

        return Storage::disk($this->cover_image_disk)->url($this->cover_image_path);
    }
}
