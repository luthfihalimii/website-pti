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
        $pti     = Logo::where('type','pti')->latest()->first();
        $clients = Logo::where('type','client')->latest()->get();
        $footers = Logo::where('type','like','footer_%')->get();

        return view('admin.logos.index', compact('pti','clients','footers'));
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

        Logo::create([
            'type' => $request->type,
            'name' => $request->type === 'client' ? $request->name : null,
            'path' => $path, // ✅ JANGAN pakai storage/
        ]);

        return redirect()->route('admin.logos.index')
            ->with('success','Logo berhasil ditambahkan!');
    }

    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'name' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo')) {

            if ($logo->path && Storage::disk('public')->exists($logo->path)) {
                Storage::disk('public')->delete($logo->path);
            }

            $logo->path = $request->file('logo')->store('logos','public');
        }

        if ($logo->type === 'client') {
            $logo->name = $request->name;
        }

        $logo->save();

        return back()->with('success','Logo berhasil diupdate!');
    }

    public function destroy(Logo $logo)
    {
        if ($logo->path && Storage::disk('public')->exists($logo->path)) {
            Storage::disk('public')->delete($logo->path);
        }

        $logo->delete();

        return back()->with('success','Logo berhasil dihapus!');
    }
}