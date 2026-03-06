<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($product)],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'status' => ['required', Rule::in([Product::STATUS_DRAFT, Product::STATUS_PUBLISHED])],
            'is_featured' => ['nullable', 'boolean'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'feature_titles' => ['nullable', 'array'],
            'feature_titles.*' => ['nullable', 'string', 'max:255'],
            'feature_descriptions' => ['nullable', 'array'],
            'feature_descriptions.*' => ['nullable', 'string'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'max:2048'],
            'attachment_titles' => ['nullable', 'array'],
            'attachment_titles.*' => ['nullable', 'string', 'max:255'],
            'attachment_files' => ['nullable', 'array'],
            'attachment_files.*' => ['file', 'mimetypes:application/pdf', 'max:5120'],
        ];
    }
}
