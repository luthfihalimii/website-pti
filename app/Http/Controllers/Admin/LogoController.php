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
        $pti = Logo::where('type', 'pti')->latest()->first(); // navbar 1
        $clients = Logo::where('type', 'client')->latest()->get();
        $footers = Logo::where('type', 'like', 'footer_%')->latest()->get();

        return view('admin.logos.index', compact('pti', 'clients', 'footers'));
    }

    public function create()
    {
        return view('admin.logos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'logo' => 'required|mimes:png,jpg,jpeg,svg|max:2048',
            'name' => 'nullable|string|max:255',
        ]);

        $path = $request->file('logo')->store('logos', 'public');

        if ($request->type === 'pti') {
            $logo = Logo::where('type', 'pti')->first();

            if ($logo) {
                if ($logo->path) {
                    $oldPath = str_replace('storage/', '', $logo->path);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                $logo->update([
                    'name' => $request->name,
                    'path' => 'storage/' . $path,
                ]);

                return redirect()->route('admin.logos.index')->with('success', 'Logo navbar berhasil diganti!');
            }
        }

        Logo::create([
            'type' => $request->type,
            'name' => $request->name,
            'path' => 'storage/' . $path,
        ]);

        return redirect()->route('admin.logos.index')->with('success', 'Logo berhasil diupload!');
    }

    public function update(Request $request, Logo $logo)
    {
        $request->validate([
            'logo' => 'nullable|mimes:png,jpg,jpeg,svg|max:2048',
            'name' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            if ($logo->path) {
                $filePath = str_replace('storage/', '', $logo->path);
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }

            $path = $request->file('logo')->store('logos', 'public');
            $logo->path = 'storage/' . $path;
        }

        $logo->name = $request->name ?? $logo->name;
        $logo->save();

        return redirect()->route('admin.logos.index')->with('success', 'Logo berhasil diperbarui!');
    }

    public function destroy(Logo $logo)
    {
        if ($logo->path) {
            $filePath = str_replace('storage/', '', $logo->path);
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        $logo->delete();

        return redirect()->back()->with('success', 'Logo berhasil dihapus!');
    }
}