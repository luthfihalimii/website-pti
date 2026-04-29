<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service; // Pastikan sudah ada model Service
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function home()
    {
        // Mengambil layanan dari database
        $services = Service::query()
            ->where('status', 'active')  // Menggunakan status sebagai filter
            ->orderBy('sort_order')
            ->get()
            ->map(fn (Service $service) => [
                'title' => $service->name,  // Menggunakan name daripada title jika sesuai
                'description' => $service->description,
                'image' => asset('storage/' . $service->image), // Pastikan kolom image ada di tabel
                'icon' => $service->icon ?? null,  // Jika kolom icon ada, pastikan validasi jika tidak ada
            ]);

        // Mengambil produk unggulan dari database
        $products = Product::query()
            ->with('features')
            ->published() // Pastikan ada scope published() di model Product
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

        // Jika produk unggulan kurang dari 5, ambil fallback dari konfigurasi
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

        // Mengambil logo klien dari konfigurasi
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