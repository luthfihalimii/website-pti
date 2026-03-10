<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductInquiryRequest;
use App\Models\Product;
use App\Models\ProductInquiry;

class ProductInquiryController extends Controller
{
    public function store(StoreProductInquiryRequest $request, string $slug)
    {
        $product = Product::query()
            ->where('status', Product::STATUS_PUBLISHED)
            ->where('slug', $slug)
            ->firstOrFail();

        ProductInquiry::create([
            ...$request->validated(),
            'product_id' => $product->id,
        ]);

        return redirect()
            ->route('products.show', $product->slug)
            ->with('product_inquiry_status', __('Permintaan demo berhasil dikirim. Tim kami akan menghubungi Anda.'));
    }
}
