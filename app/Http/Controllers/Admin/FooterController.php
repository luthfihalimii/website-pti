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
        // Ambil semua logo footer
        $footers = Logo::where('type', 'like', 'footer_%')->get();

        return view('admin.footer.index', compact('footers'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $file = $request->file('logo');

        // Ambil logo lama (jika ada)
        $logo = Logo::where('type', $request->type)->first();

        // Hapus file lama
        if ($logo && $logo->path && Storage::disk('public')->exists($logo->path)) {
            Storage::disk('public')->delete($logo->path);
        }

        // Simpan file baru di folder footer
        $path = $file->store('footer', 'public');

        Logo::updateOrCreate(
            ['type' => $request->type],
            [
                'path' => $path,
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