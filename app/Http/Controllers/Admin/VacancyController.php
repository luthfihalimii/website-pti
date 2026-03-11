<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVacancyRequest;
use App\Http\Requests\Admin\UpdateVacancyRequest;
use App\Models\Vacancy;

class VacancyController extends Controller
{
    public function index()
    {
        return view('admin.vacancies-index', [
            'vacancies' => Vacancy::query()
                ->orderBy('sort_order')
                ->orderByDesc('created_at')
                ->get(),
        ]);
    }

    public function create()
    {
        return view('admin.vacancies-create');
    }

    public function store(StoreVacancyRequest $request)
    {
        Vacancy::query()->create($this->normalizedPayload($request->validated(), $request->boolean('is_active')));

        return redirect()
            ->route('admin.vacancies.index')
            ->with('status', 'Lowongan pekerjaan berhasil ditambahkan.');
    }

    public function edit(Vacancy $vacancy)
    {
        return view('admin.vacancies-edit', [
            'vacancy' => $vacancy,
        ]);
    }

    public function update(UpdateVacancyRequest $request, Vacancy $vacancy)
    {
        $vacancy->update($this->normalizedPayload($request->validated(), $request->boolean('is_active')));

        return redirect()
            ->route('admin.vacancies.index')
            ->with('status', 'Lowongan pekerjaan berhasil diperbarui.');
    }

    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();

        return redirect()
            ->route('admin.vacancies.index')
            ->with('status', 'Lowongan pekerjaan berhasil dihapus.');
    }

    /**
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function normalizedPayload(array $validated, bool $isActive): array
    {
        return [
            ...collect($validated)->except(['qualifications', 'skills', 'benefits'])->toArray(),
            'qualifications' => $this->splitLines((string) $validated['qualifications']),
            'skills' => $this->splitLines((string) $validated['skills']),
            'benefits' => $this->splitLines((string) $validated['benefits']),
            'is_active' => $isActive,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ];
    }

    /**
     * @return array<int, string>
     */
    private function splitLines(string $value): array
    {
        return array_values(array_filter(array_map(
            static fn (string $line): string => trim($line),
            preg_split('/\r\n|\r|\n/', $value) ?: []
        )));
    }
}
