<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    // Tampilkan semua logo footer
    public function index()
    {
        $logos = Logo::where('type', 'like', 'footer_%')->get();

        return view('admin.footer.index', compact('logos'));
    }

    // Upload / update logo footer
    public function upload(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $file = $request->file('logo');

        // Cari data lama berdasarkan type
        $logo = Logo::where('type', $request->type)->first();

        // Jika ada file lama, hapus dulu
        if ($logo && $logo->path) {
            $oldPath = str_replace('storage/', '', $logo->path);

            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Simpan file baru ke storage/app/public/footer
        $path = $file->store('footer', 'public');

        // Simpan ke database TANPA prefix storage/
        Logo::updateOrCreate(
            ['type' => $request->type],
            [
                'path' => $path,
                'name' => $file->getClientOriginalName(),
            ]
        );

        return redirect()
            ->back()
            ->with('success', 'Logo berhasil diupdate!');
    }

    // Hapus logo footer
    public function destroy($id)
    {
        $logo = Logo::findOrFail($id);

        // Hapus file fisik jika ada
        if ($logo->path && Storage::disk('public')->exists($logo->path)) {
            Storage::disk('public')->delete($logo->path);
        }

        // Hapus data database
        $logo->delete();

        return redirect()
            ->back()
            ->with('success', 'Logo berhasil dihapus!');
    }
}