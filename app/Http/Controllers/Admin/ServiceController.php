<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

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
        $categories = ProductCategory::all(); // Ambil kategori untuk layanan
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:product_categories,id',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image',
        ]);

        $service = Service::create($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $service->image = $path;
            $service->save();
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:product_categories,id',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image',
        ]);

        $service->update($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('services', 'public');
            $service->image = $path;
            $service->save();
        }

        return redirect()->route('admin.services.index')->with('status', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('status', 'Layanan berhasil dihapus!');
    }
}