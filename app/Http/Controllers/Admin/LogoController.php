<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;

class LogoController extends Controller
{
    public function index()
    {
        return view('admin.logos.index', [
            'pti' => Logo::where('type', 'pti')->first(),
            'footer' => Logo::where('type', 'footer')->first(),
            'clients' => Logo::where('type', 'client')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.logos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pti,footer,client',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        // kalau bukan client → replace
        if ($request->type !== 'client') {
            $old = Logo::where('type', $request->type)->first();
            if ($old) {
                \Storage::disk('public')->delete($old->path);
                $old->delete();
            }
        }

        $path = $request->file('logo')->store('logos', 'public');

        Logo::create([
            'type' => $request->type,
            'path' => $path,
        ]);

        return redirect()->route('admin.logos.index')
            ->with('success', 'Logo berhasil ditambahkan');
    }

    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        \Storage::disk('public')->delete($logo->path);

        $path = $request->file('logo')->store('logos', 'public');

        $logo->update([
            'path' => $path,
        ]);

        return back()->with('success', 'Logo berhasil diupdate');
    }

    public function destroy(Logo $logo)
    {
        \Storage::disk('public')->delete($logo->path);
        $logo->delete();

        return back()->with('success', 'Logo berhasil dihapus');
    }
}