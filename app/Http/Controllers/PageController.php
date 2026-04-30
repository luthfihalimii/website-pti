<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home()
    {
        // 🔥 AMBIL DATA LAYANAN DARI DATABASE (FIX)
        $services = Service::query()
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->take(4)
            ->get()
            ->map(fn (Service $service) => [
                'title' => $service->name,
                'description' => $service->description,
                'image' => $service->image, // ⬅️ PENTING (JANGAN pakai asset di sini)
                'icon' => '▣',
            ]);

        // Produk (tidak diubah)
        $products = Product::query()
            ->with('features')
            ->published()
            ->where('is_featured', true)
            ->orderBy('sort_order')
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
            ]);

        if ($products->count() < 5) {
            $fallbackProducts = collect(config('site.home.featured_products'))
                ->map(fn (array $product) => [
                    ...$product,
                    'image' => asset($product['image']),
                    'link' => $product['link'] ?? route('products.index'),
                ])
                ->reject(fn (array $fallbackProduct) => $products->contains(
                    fn (array $product): bool => Str::lower($product['tab']) === Str::lower($fallbackProduct['tab'])
                ));

            $products = $products->concat($fallbackProducts)->take(5);
        }

        $clients = collect(config('site.home.clients'))
            ->map(fn (array $client) => [
                ...$client,
                'logo' => isset($client['logo']) ? asset($client['logo']) : null,
            ])
            ->all();

        return view('pages.home', [
            'services' => $services,
            'products' => $products,
            'clients' => $clients,
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