<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ProductCategory::all();  // Ambil kategori produk
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:product_categories,id',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image',  // Pastikan file yang diupload adalah gambar
        ]);

        // Membuat service baru
        $service = Service::create($validated);

        // Menyimpan file gambar jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $service->image = $path;
        }

        return redirect()->route('admin.services.index')->with('status', 'Layanan berhasil ditambahkan!');
    }

    public function edit(Service $service)
    {
        $categories = ProductCategory::all();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:product_categories,id',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image',
        ]);

        // Update service dengan data validasi
        $service->update($validated);

        // Menyimpan file gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            // Simpan gambar baru
            $path = $request->file('image')->store('services', 'public');
            $service->image = $path;
        }

        return redirect()->route('admin.services.index')->with('status', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        // Hapus file gambar jika ada
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        // Hapus layanan
        $service->delete();

        return redirect()->route('admin.services.index')->with('status', 'Layanan berhasil dihapus!');
    }
}