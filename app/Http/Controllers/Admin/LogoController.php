<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;

class LogoController extends Controller
{
    public function index()
    {
        $logos = Logo::latest()->get(); // biar urut terbaru
        return view('admin.logos.index', compact('logos'));
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
    
    if ($request->type !== 'client') {
        Logo::where('type', $request->type)->delete();
    }

    $path = $request->file('logo')->store('logos', 'public');

    Logo::create([
        'type' => $request->type,
        'path' => $path,
    ]);

    return redirect()->route('admin.logos.index')
                     ->with('success', 'Logo berhasil ditambahkan');
}
    
}