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
            'logo' => 'required|image|max:2048',
        ]);

        $file = $request->file('logo');
        $path = $file->store('public/footer');

        Logo::updateOrCreate(
            ['type' => $request->type],
            [
                'path' => Storage::url($path),
                'name' => $file->getClientOriginalName()
            ]
        );

        return redirect()->back()->with('success', 'Logo berhasil diupdate!');
    }

    public function destroy($id)
    {
        $logo = Logo::findOrFail($id);
        if ($logo->path) {
            $filePath = str_replace('/storage/', 'public/', $logo->path);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }
        $logo->delete();

        return redirect()->back()->with('success', 'Logo berhasil dihapus!');
    }
}