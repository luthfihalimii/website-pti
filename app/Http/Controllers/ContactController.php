<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactInquiryRequest;
use App\Models\ContactInquiry;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.kontak');
    }

    public function store(StoreContactInquiryRequest $request)
    {
        ContactInquiry::create($request->validated());

        return redirect()
            ->route('contact')
            ->with('contact_status', __('Pesan Anda berhasil dikirim. Tim kami akan segera menghubungi Anda.'));
    }
}
