<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        $items = collect(config('site.publications.items'))
            ->map(fn (array $item) => [
                ...$item,
                'img_url' => asset($item['img']),
                'pdf_url' => asset($item['pdf']),
            ])
            ->all();

        return view('pages.publikasi', [
            'items' => $items,
        ]);
    }

    public function flipbook(Request $request)
    {
        $items = config('site.publications.items');
        $allowedFiles = collect($items)->pluck('pdf')->all();

        $file = (string) $request->query('file');
        $title = (string) $request->query('title', 'Flipbook');

        abort_unless(in_array($file, $allowedFiles, true), 404);

        return view('components.flipbook', [
            'title' => $title,
            'pdfUrl' => asset($file),
        ]);
    }
}
