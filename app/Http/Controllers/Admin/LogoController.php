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
        $pti = Logo::where('type', 'pti')->orderByDesc('id')->first();
        $clients = Logo::where('type', 'client')->latest()->get();
        $footers = Logo::where('type', 'like', 'footer_%')->get()->keyBy('type');

        return view('admin.logos.index', compact('pti', 'clients', 'footers'));
    }

    public function create()
    {
        return view('admin.logos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pti,client',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'name' => 'nullable|string|max:255',
        ]);

        $path = $request->file('logo')->store('logos', 'public');

        // kalau navbar → hapus dulu yang lama
        if ($request->type == 'pti') {
            $old = Logo::where('type', 'pti')->first();

            if ($old) {
                if ($old->path) {
                    Storage::disk('public')->delete($old->path);
                }
                $old->delete();
            }
        }

        Logo::create([
            'type' => $request->type,
            'name' => $request->type === 'client' ? $request->name : null,
            'path' => $path,
        ]);

        return redirect()->route('admin.logos.index')
            ->with('success', 'Logo berhasil diupload!');
    }

    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'name' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            if ($logo->path) {
                Storage::disk('public')->delete($logo->path);
            }
            $logo->path = $request->file('logo')->store('logos', 'public');
        }

        if ($logo->type === 'client') {
            $logo->name = $request->name;
        }

        $logo->save();

        return redirect()->route('admin.logos.index')
            ->with('success', 'Logo berhasil diperbarui!');
    }

    public function destroy(Logo $logo)
    {
        if ($logo->path) {
            Storage::disk('public')->delete($logo->path);
        }

        $logo->delete();

        return redirect()->back()
            ->with('success', 'Logo berhasil dihapus!');
    }
}