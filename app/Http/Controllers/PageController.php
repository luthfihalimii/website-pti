<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home()
    {
        $services = collect(config('site.home.services'))
            ->map(fn (array $service) => [
                ...$service,
                'image' => asset($service['image']),
            ])
            ->all();

        $products = Product::query()
            ->with('features')
            ->published()
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->limit(5)
            ->get()
            ->map(fn (Product $product) => [
                'tab' => $product->name,
                'tab_mobile' => $product->name,
                'title' => Str::upper($product->name),
                'image' => $product->cover_image_url ?? asset('assets/images/hero-pages.png'),
                'summary' => $product->features->pluck('description')->filter()->take(3)->values()->all() ?: [
                    $product->excerpt ?: Str::limit(strip_tags($product->description), 180),
                ],
                'link' => route('products.show', $product->slug),
            ])
            ->all();

        if ($products === []) {
            $products = collect(config('site.home.featured_products'))
                ->map(fn (array $product) => [
                    ...$product,
                    'image' => asset($product['image']),
                    'link' => $product['link'] ?? route('products.index'),
                ])
                ->all();
        }

        return view('pages.home', [
            'services' => $services,
            'products' => $products,
            'clients' => config('site.home.clients'),
        ]);
    }

    public function about()
    {
        return view('pages.tentang');
    }

    public function services()
    {
        return view('pages.layanan');
    }

    public function products()
    {
        return redirect()->route('products.index');
    }
}
