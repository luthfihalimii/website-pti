<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminVacancyManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_open_vacancy_index_page(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.vacancies.index'));

        $response->assertOk();
        $response->assertSeeText('Lowongan Pekerjaan');
    }

    public function test_admin_can_create_and_delete_vacancy(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->post(route('admin.vacancies.store'), [
            'title' => 'Backend Engineer',
            'slug' => 'backend-engineer',
            'employment_type' => 'Full Time',
            'summary' => 'Bangun API dan backend service.',
            'headline' => 'We Are Hiring Backend Engineer - Full Time',
            'description' => 'Membangun layanan backend yang andal.',
            'qualifications_raw' => "Minimal 2 tahun pengalaman\nMenguasai Laravel",
            'skills_raw' => "Laravel\nMySQL",
            'salary_range' => 'Rp8.000.000 - Rp12.000.000',
            'salary_note' => '(negotiable)',
            'salary_context' => 'Disesuaikan pengalaman',
            'benefits_raw' => "BPJS\nLaptop kerja",
            'poster_path' => 'assets/images/poster-lowongan.png',
            'sort_order' => 1,
            'is_active' => '1',
        ]);

        $response->assertRedirect(route('admin.vacancies.index'));
        $this->assertDatabaseHas('vacancies', [
            'title' => 'Backend Engineer',
            'slug' => 'backend-engineer',
        ]);

        $vacancy = Vacancy::query()->where('slug', 'backend-engineer')->firstOrFail();

        $deleteResponse = $this->actingAs($admin)->delete(route('admin.vacancies.destroy', $vacancy));

        $deleteResponse->assertRedirect(route('admin.vacancies.index'));
        $this->assertDatabaseMissing('vacancies', [
            'id' => $vacancy->id,
        ]);
    }
}
