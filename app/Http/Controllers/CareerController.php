<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function internships()
    {
        return view('pages.magang', [
            'divisions' => config('site.internships.divisions'),
            'benefits' => config('site.internships.benefits'),
        ]);
    }

    public function vacancies()
    {
        $vacancies = collect(config('site.careers.vacancies'))
            ->map(fn (array $vacancy) => [
                ...$vacancy,
                'slug' => $vacancy['slug'] ?? Str::slug($vacancy['title']),
                'poster_url' => asset($vacancy['poster']),
            ])
            ->all();

        return view('pages.lowongan', [
            'vacancies' => $vacancies,
        ]);
    }

    public function showVacancy(string $slug)
    {
        return view('pages.detail-lowongan', [
            'vacancy' => $this->resolveVacancy($slug),
        ]);
    }

    public function createApplication(string $slug)
    {
        return view('pages.form-lamaran', [
            'vacancy' => $this->resolveVacancy($slug),
        ]);
    }

    private function resolveVacancy(string $slug): array
    {
        $vacancy = Arr::first(
            config('site.careers.vacancies', []),
            fn (array $vacancy): bool => ($vacancy['slug'] ?? Str::slug($vacancy['title'])) === $slug,
        );

        abort_unless(is_array($vacancy), 404);

        return [
            ...$vacancy,
            'slug' => $vacancy['slug'] ?? Str::slug($vacancy['title']),
            'poster_url' => asset($vacancy['poster']),
        ];
    }
}
