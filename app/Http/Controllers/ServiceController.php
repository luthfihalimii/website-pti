<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::with(['services' => function ($query) {
                $query->where('status', 'active')
                    ->orderBy('sort_order')
                    ->orderBy('name');
            }])
            ->whereHas('services', function ($query) {
                $query->where('status', 'active');
            })
            ->orderBy('name')
            ->get();

        return view('pages.layanan', compact('categories'));
    }

    public function show($service)
    {
        abort(404);
    }
}