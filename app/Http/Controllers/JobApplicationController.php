<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Models\JobApplication;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class JobApplicationController extends Controller
{
    public function store(StoreJobApplicationRequest $request, string $slug)
    {
        $vacancy = $this->resolveVacancy($slug);

        $validated = $request->validated();
        $cvPath = $request->file('cv')->store('job-applications/cv', 'local');

        try {
            JobApplication::create([
                ...collect($validated)->except('cv')->toArray(),
                'posisi' => $vacancy['title'],
                'vacancy_slug' => $vacancy['slug'],
                'cv_path' => $cvPath,
                'cv_disk' => 'local',
                'pernyataan_1' => $request->boolean('pernyataan_1'),
                'pernyataan_2' => $request->boolean('pernyataan_2'),
                'pernyataan_3' => $request->boolean('pernyataan_3'),
            ]);
        } catch (Throwable $exception) {
            Storage::disk('local')->delete($cvPath);

            throw $exception;
        }

        return redirect()
            ->route('careers.applications.create', $slug)
            ->with('status', __('Lamaran berhasil dikirim. Tim kami akan meninjau data Anda.'));
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
        ];
    }
}
