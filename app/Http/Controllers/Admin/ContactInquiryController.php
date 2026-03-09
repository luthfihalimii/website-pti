<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;

class ContactInquiryController extends Controller
{
    public function destroy(ContactInquiry $contactInquiry)
    {
        $contactInquiry->delete();

        return back()->with('status', 'Pesan kontak berhasil dihapus.');
    }
}
