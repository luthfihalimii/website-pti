<?php

namespace Tests\Feature;

use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CareerDatabaseVacancySourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_careers_page_shows_empty_state_when_vacancy_table_has_no_data(): void
    {
        Vacancy::query()->delete();

        $response = $this->get(route('careers.index'));

        $response->assertOk();
        $response->assertSeeText('Saat ini belum ada lowongan yang tersedia.');
        $response->assertSee('flex justify-center', false);
        $response->assertSee('max-w-4xl', false);
    }

    public function test_careers_page_loads_database_vacancies_when_table_exists(): void
    {
        Vacancy::query()->create([
            'slug' => 'backend-engineer',
            'title' => 'Backend Engineer',
            'employment_type' => 'Full Time',
            'summary' => 'Bangun API dan sistem backend.',
            'headline' => 'We Are Hiring Backend Engineer',
            'description' => 'Membangun layanan backend yang andal.',
            'qualifications' => ['Minimal 2 tahun pengalaman'],
            'skills' => ['Laravel', 'MySQL'],
            'salary_range' => 'Rp8.000.000 - Rp12.000.000',
            'salary_note' => '(negotiable)',
            'salary_context' => 'Disesuaikan pengalaman',
            'benefits' => ['BPJS'],
            'poster_path' => 'assets/images/poster-lowongan.png',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $response = $this->get(route('careers.index'));

        $response->assertOk();
        $response->assertSeeText('Backend Engineer');
    }
}
