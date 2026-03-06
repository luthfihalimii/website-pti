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
}
