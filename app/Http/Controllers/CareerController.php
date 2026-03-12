<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
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
        return view('pages.lowongan', [
            'vacancies' => $this->vacancyCollection(false)->all(),
        ]);
    }

    public function showVacancy(?string $slug = null)
    {
        $vacancy = $slug
            ? $this->vacancyCollection()->firstWhere('slug', $slug)
            : $this->vacancyCollection()->first();

        abort_if(! $vacancy, 404);

        return view('pages.detail-lowongan', [
            'vacancy' => $vacancy,
        ]);
    }

    public function createApplication(?string $slug = null)
    {
        $vacancy = $slug
            ? $this->vacancyCollection()->firstWhere('slug', $slug)
            : $this->vacancyCollection()->first();

        abort_if(! $vacancy, 404);

        return view('pages.form-lamaran', [
            'vacancy' => $vacancy,
        ]);
    }

    private function vacancyCollection(bool $fallbackWhenEmpty = true): Collection
    {
        if (! Schema::hasTable('vacancies')) {
            return $this->fallbackConfigVacancies();
        }

        $databaseVacancies = Vacancy::query()
            ->active()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (Vacancy $vacancy) => [
                'slug' => $vacancy->slug,
                'title' => $vacancy->title,
                'employment_type' => $vacancy->employment_type,
                'summary' => $vacancy->summary,
                'headline' => $vacancy->headline,
                'description' => $vacancy->description,
                'qualifications' => $vacancy->qualifications ?? [],
                'skills' => $vacancy->skills ?? [],
                'salary_range' => $vacancy->salary_range,
                'salary_note' => $vacancy->salary_note ?? '',
                'salary_context' => $vacancy->salary_context ?? '',
                'benefits' => $vacancy->benefits ?? [],
                'poster' => $vacancy->poster_path,
                'poster_url' => asset($vacancy->poster_path),
            ]);

        if ($databaseVacancies->isNotEmpty()) {
            return $databaseVacancies->values();
        }

        if (! $fallbackWhenEmpty) {
            return collect();
        }

        return $this->fallbackConfigVacancies();
    }

    private function fallbackConfigVacancies(): Collection
    {
        return collect(config('site.careers.vacancies'))
            ->map(fn (array $vacancy) => [
                ...$vacancy,
                'slug' => $vacancy['slug'] ?? Str::slug((string) ($vacancy['title'] ?? 'vacancy')),
                'poster_url' => asset($vacancy['poster']),
            ])
            ->values();
    }
}
