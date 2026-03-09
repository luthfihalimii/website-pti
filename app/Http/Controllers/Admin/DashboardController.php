<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\InternshipApplication;
use App\Models\JobApplication;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductInquiry;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'stats' => [
                'categories' => ProductCategory::count(),
                'products' => Product::count(),
                'published_products' => Product::where('status', Product::STATUS_PUBLISHED)->count(),
                'product_inquiries' => ProductInquiry::count(),
                'contact_inquiries' => ContactInquiry::count(),
                'job_applications' => JobApplication::count(),
                'internship_applications' => InternshipApplication::count(),
            ],
            'recentJobApplications' => JobApplication::query()->latest()->take(5)->get(),
            'recentInternshipApplications' => InternshipApplication::query()->latest()->take(5)->get(),
            'recentProductInquiries' => ProductInquiry::query()->with('product')->latest()->take(5)->get(),
            'recentContactInquiries' => ContactInquiry::query()->latest()->take(10)->get(),
        ]);
    }
}
