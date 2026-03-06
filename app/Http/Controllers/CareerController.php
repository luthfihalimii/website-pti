<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;

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
                'poster_url' => asset($vacancy['poster']),
            ])
            ->all();

        return view('pages.lowongan', [
            'vacancies' => $vacancies,
        ]);
    }

    public function showVacancy()
    {
        $vacancy = Arr::first(config('site.careers.vacancies'));

        return view('pages.detail-lowongan', [
            'vacancy' => [
                ...$vacancy,
                'poster_url' => asset($vacancy['poster']),
            ],
        ]);
    }

    public function createApplication()
    {
        $vacancy = Arr::first(config('site.careers.vacancies'));

        return view('pages.form-lamaran', [
            'vacancy' => [
                ...$vacancy,
                'poster_url' => asset($vacancy['poster']),
            ],
        ]);
    }
}
