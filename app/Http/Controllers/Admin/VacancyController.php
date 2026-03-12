<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVacancyRequest;
use App\Http\Requests\Admin\UpdateVacancyRequest;
use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class VacancyController extends Controller
{
    public function index(): View
    {
        return view('admin.vacancies.index', [
            'vacancies' => Vacancy::query()
                ->orderBy('sort_order')
                ->orderBy('title')
                ->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.vacancies.create');
    }

    public function store(StoreVacancyRequest $request): RedirectResponse
    {
        Vacancy::create($this->payload($request->validated(), $request->boolean('is_active', true)));

        return redirect()->route('admin.vacancies.index')->with('status', 'Lowongan pekerjaan berhasil dibuat.');
    }

    public function edit(Vacancy $vacancy): View
    {
        return view('admin.vacancies.edit', [
            'vacancy' => $vacancy,
        ]);
    }

    public function update(UpdateVacancyRequest $request, Vacancy $vacancy): RedirectResponse
    {
        $vacancy->update($this->payload($request->validated(), $request->boolean('is_active', true)));

        return redirect()->route('admin.vacancies.index')->with('status', 'Lowongan pekerjaan berhasil diperbarui.');
    }

    public function destroy(Vacancy $vacancy): RedirectResponse
    {
        $vacancy->delete();

        return redirect()->route('admin.vacancies.index')->with('status', 'Lowongan pekerjaan berhasil dihapus.');
    }

    /**
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function payload(array $validated, bool $isActive): array
    {
        return [
            ...collect($validated)->except(['qualifications_raw', 'skills_raw', 'benefits_raw'])->toArray(),
            'qualifications' => $this->normalizeList($validated['qualifications_raw'] ?? null),
            'skills' => $this->normalizeList($validated['skills_raw'] ?? null),
            'benefits' => $this->normalizeList($validated['benefits_raw'] ?? null),
            'is_active' => $isActive,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ];
    }

    /**
     * @return array<int, string>
     */
    private function normalizeList(?string $value): array
    {
        return Collection::wrap(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn ($item): string => trim((string) $item))
            ->filter()
            ->values()
            ->all();
    }
}
