<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    public function index()
    {
        return view('admin.logos.index', [
            'pti' => Logo::where('type', 'pti')->first(),
            'clients' => Logo::where('type', 'client')->latest()->get(),
            'footers' => Logo::where('type', 'footer')->latest()->get(),
        ]);
    }

    // Simpan logo baru
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pti,client,footer',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'name' => 'nullable|string|max:255',
        ]);

        // Hapus logo lama jika tipe PTI
        if ($request->type === 'pti') {
            $old = Logo::where('type', 'pti')->first();
            if ($old) {
                Storage::disk('public')->delete($old->path);
                $old->delete();
            }
        }

        $path = $request->file('logo')->store('logos', 'public');

        Logo::create([
            'type' => $request->type,
            'path' => $path,
            'name' => $request->name,
        ]);

        return redirect()->route('admin.logos.index')
            ->with('success', 'Logo/Icon berhasil ditambahkan');
    }

    // Update logo atau nama
    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'name' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($logo->path);
            $logo->path = $request->file('logo')->store('logos', 'public');
        }

        if ($request->name) {
            $logo->name = $request->name;
        }

        $logo->save();

        return redirect()->route('admin.logos.index')
            ->with('success', 'Logo/Icon berhasil diperbarui');
    }

    // Hapus logo/icon
    public function destroy(Logo $logo)
    {
        Storage::disk('public')->delete($logo->path);
        $logo->delete();

        return redirect()->route('admin.logos.index')
            ->with('success', 'Logo/Icon berhasil dihapus');
    }
}