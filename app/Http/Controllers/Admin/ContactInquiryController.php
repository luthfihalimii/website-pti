<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;

class ContactInquiryController extends Controller
{
    public function index()
    {
        return view('admin.contact-inquiries.index', [
            'inquiries' => ContactInquiry::query()->latest('id')->paginate(15),
        ]);
    }

    public function destroy(ContactInquiry $contactInquiry)
    {
        $contactInquiry->delete();

        return redirect()
            ->route('admin.contact-inquiries.index')
            ->with('status', 'Pesan kontak berhasil dihapus.');
    }
}
