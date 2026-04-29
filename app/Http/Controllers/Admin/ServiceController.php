<?php
namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Mengambil layanan yang aktif dan terurut berdasarkan 'sort_order' dan 'name'
        $services = Service::with('category')
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Pastikan mengirimkan data ke view yang sesuai
        return view('pages.layanan', compact('services'));  // Ganti home dengan layanan
    }

    public function show(Service $service)
    {
        // Memastikan hanya layanan dengan status 'active' yang bisa dilihat
        if ($service->status !== 'active') {
            abort(404);  // Jika status tidak aktif, tampilkan halaman 404
        }

        return view('public.services.show', compact('service'));  // Pastikan view yang benar
    }
}