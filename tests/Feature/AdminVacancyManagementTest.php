<?php

namespace Tests\Feature;

use App\Models\Vacancy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminVacancyManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admins_can_create_job_vacancies_from_admin_area(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $indexResponse = $this->actingAs($admin)->get(route('admin.vacancies.index'));

        $indexResponse->assertOk();
        $indexResponse->assertSeeText('Lowongan Pekerjaan');

        $storeResponse = $this->actingAs($admin)->post(
            route('admin.vacancies.store'),
            $this->vacancyFormData([
                'title' => 'Frontend Engineer',
                'slug' => 'frontend-engineer',
            ])
        );

        $storeResponse->assertRedirect(route('admin.vacancies.index'));

        $this->assertDatabaseHas('vacancies', [
            'title' => 'Frontend Engineer',
            'slug' => 'frontend-engineer',
        ]);

        $publicResponse = $this->get(route('careers.index'));
        $publicResponse->assertOk();
        $publicResponse->assertSeeText('Frontend Engineer');

        $detailResponse = $this->get(route('careers.show.slug', 'frontend-engineer'));
        $detailResponse->assertOk();
        $detailResponse->assertSeeText('We Are Hiring Frontend Engineer - Full Time');

        $applicationResponse = $this->get(route('careers.applications.create.slug', 'frontend-engineer'));
        $applicationResponse->assertOk();
        $applicationResponse->assertSeeText('Frontend Engineer');
    }

    public function test_admins_can_edit_and_update_existing_vacancies(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $vacancy = Vacancy::query()->create($this->vacancyData([
            'title' => 'Backend Engineer',
            'slug' => 'backend-engineer',
        ]));

        $editResponse = $this->actingAs($admin)->get(route('admin.vacancies.edit', $vacancy));
        $editResponse->assertOk();
        $editResponse->assertSeeText('Edit Lowongan Pekerjaan');

        $updateResponse = $this->actingAs($admin)->put(route('admin.vacancies.update', $vacancy), [
            ...$this->vacancyFormData(),
            'title' => 'Senior Backend Engineer',
            'slug' => 'senior-backend-engineer',
            'is_active' => '1',
        ]);

        $updateResponse->assertRedirect(route('admin.vacancies.index'));

        $this->assertDatabaseHas('vacancies', [
            'id' => $vacancy->id,
            'title' => 'Senior Backend Engineer',
            'slug' => 'senior-backend-engineer',
        ]);
    }

    public function test_admins_can_delete_vacancies(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $vacancy = Vacancy::query()->create($this->vacancyData([
            'title' => 'UI Engineer',
            'slug' => 'ui-engineer',
        ]));

        $response = $this->actingAs($admin)->delete(route('admin.vacancies.destroy', $vacancy));

        $response->assertRedirect(route('admin.vacancies.index'));

        $this->assertDatabaseMissing('vacancies', [
            'id' => $vacancy->id,
        ]);
    }

    private function vacancyData(array $overrides = []): array
    {
        return array_merge([
            'title' => 'Frontend Engineer',
            'slug' => 'frontend-engineer',
            'employment_type' => 'Full Time',
            'headline' => 'We Are Hiring Frontend Engineer - Full Time',
            'summary' => 'Membangun UI web responsif untuk produk internal dan klien.',
            'description' => 'Kami mencari Frontend Engineer yang memahami UI engineering modern.',
            'qualifications' => ['Minimal D3/S1 Teknik Informatika', 'Memiliki portofolio frontend'],
            'skills' => ['Vue atau React', 'Tailwind CSS'],
            'salary_range' => 'Rp8.000.000 - Rp12.000.000',
            'salary_note' => '(disesuaikan pengalaman)',
            'salary_context' => 'Range dapat berubah sesuai evaluasi teknis.',
            'benefits' => ['Lingkungan kerja suportif', 'Bonus performa'],
            'poster_path' => 'assets/images/poster-lowongan.png',
            'sort_order' => 1,
            'is_active' => true,
        ], $overrides);
    }

    private function vacancyFormData(array $overrides = []): array
    {
        return array_merge([
            'title' => 'Frontend Engineer',
            'slug' => 'frontend-engineer',
            'employment_type' => 'Full Time',
            'headline' => 'We Are Hiring Frontend Engineer - Full Time',
            'summary' => 'Membangun UI web responsif untuk produk internal dan klien.',
            'description' => 'Kami mencari Frontend Engineer yang memahami UI engineering modern.',
            'qualifications' => "Minimal D3/S1 Teknik Informatika\nMemiliki portofolio frontend",
            'skills' => "Vue atau React\nTailwind CSS",
            'salary_range' => 'Rp8.000.000 - Rp12.000.000',
            'salary_note' => '(disesuaikan pengalaman)',
            'salary_context' => 'Range dapat berubah sesuai evaluasi teknis.',
            'benefits' => "Lingkungan kerja suportif\nBonus performa",
            'poster_path' => 'assets/images/poster-lowongan.png',
            'sort_order' => 1,
            'is_active' => '1',
        ], $overrides);
    }
}
