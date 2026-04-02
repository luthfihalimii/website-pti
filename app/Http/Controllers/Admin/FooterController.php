<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    public function index()
    {
        $logos = Logo::where('type', 'like', 'footer_%')->get();

        return view('admin.footer.index', compact('logos'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $file = $request->file('logo');

        $logo = Logo::where('type', $request->type)->first();

        // hapus lama
        if ($logo && $logo->path && Storage::disk('public')->exists($logo->path)) {
            Storage::disk('public')->delete($logo->path);
        }

        // simpan baru
        $path = $file->store('footer', 'public');

        Logo::updateOrCreate(
            ['type' => $request->type],
            [
                'path' => $path, // ✅ FIX
                'name' => $file->getClientOriginalName(),
            ]
        );

        return back()->with('success', 'Footer berhasil diupdate!');
    }

    public function destroy($id)
    {
        $logo = Logo::findOrFail($id);

        if ($logo->path && Storage::disk('public')->exists($logo->path)) {
            Storage::disk('public')->delete($logo->path);
        }

        $logo->delete();

        return back()->with('success', 'Footer berhasil dihapus!');
    }
}