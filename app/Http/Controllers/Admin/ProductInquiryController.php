<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductInquiry;

class ProductInquiryController extends Controller
{
    public function index()
    {
        return view('admin.product-inquiries.index', [
            'inquiries' => ProductInquiry::query()->with('product')->latest()->get(),
        ]);
    }

    public function destroy(ProductInquiry $productInquiry)
    {
        $productInquiry->delete();

        return redirect()
            ->route('admin.product-inquiries.index')
            ->with('status', 'Inquiry produk berhasil dihapus.');
    }
}
