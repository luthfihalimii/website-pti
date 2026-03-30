<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    // Tampilkan semua logo
    public function index()
    {
        $pti     = Logo::where('type','pti')->latest()->first(); // navbar 1
        $clients = Logo::where('type','client')->latest()->get();
        $footers = Logo::where('type','footer')->latest()->get(); // bisa banyak

        return view('admin.logos.index', compact('pti','clients','footers'));
    }

    // Halaman tambah logo
    public function create()
    {
        return view('admin.logos.create');
    }

    // Simpan logo baru
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pti,client,footer',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'name' => 'nullable|string|max:255',
        ]);

        $path = $request->file('logo')->store('logos','public');

        Logo::create([
            'type' => $request->type,
            'name' => $request->name,
            'path' => $path,
        ]);

        return redirect()->route('admin.logos.index')->with('success','Logo berhasil diupload!');
    }

    // Update logo
    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'name' => 'nullable|string|max:255',
        ]);

        // Hapus file lama jika ada
        if ($request->hasFile('logo')) {
            if ($logo->path && Storage::disk('public')->exists($logo->path)) {
                Storage::disk('public')->delete($logo->path);
            }
            $path = $request->file('logo')->store('logos','public');
            $logo->path = $path;
        }

        $logo->name = $request->name ?? $logo->name;
        $logo->save();

        return redirect()->route('admin.logos.index')->with('success','Logo berhasil diperbarui!');
    }

    // Hapus logo
    public function destroy(Logo $logo)
    {
        if ($logo->path && Storage::disk('public')->exists($logo->path)) {
            Storage::disk('public')->delete($logo->path);
        }

        $logo->delete();

        return redirect()->back()->with('success','Logo berhasil dihapus!');
    }
}