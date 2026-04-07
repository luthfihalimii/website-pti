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
        $footers = Logo::whereIn('type', [
            'footer_logo_pti',
            'footer_map_icon',
            'footer_email_icon',
            'footer_phone_icon',
            'footer_whatsapp_icon',
            'footer_linkedin_icon',
            'footer_clock_icon',
        ])->get()->keyBy('type');

        return view('admin.footer.index', compact('footers'));
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


    public function reset()
    {
        $types = [
            'footer_logo_pti',
            'footer_map_icon',
            'footer_email_icon',
            'footer_phone_icon',
            'footer_whatsapp_icon',
            'footer_linkedin_icon',
            'footer_clock_icon',
        ];

        $footers = Logo::whereIn('type', $types)->get();

        foreach ($footers as $footer) {

            if ($footer->path && Storage::disk('public')->exists($footer->path)) {
                Storage::disk('public')->delete($footer->path);
            }

            $footer->delete();
        }

        return back()->with('success','Semua footer berhasil direset!');
    }
}