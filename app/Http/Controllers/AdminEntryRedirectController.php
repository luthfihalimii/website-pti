<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminEntryRedirectController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('admin.login');
        }

        return $user->is_admin
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    }
}
