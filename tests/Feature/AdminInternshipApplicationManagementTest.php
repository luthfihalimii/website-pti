<?php

namespace Tests\Feature;

use App\Models\InternshipApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminInternshipApplicationManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admins_can_view_internship_application_inbox_and_detail_pages(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $application = InternshipApplication::query()->create($this->internshipApplicationData([
            'nama' => 'Citra Lestari',
            'nisn' => '2026123',
            'status' => 'baru',
        ]));

        $indexResponse = $this->actingAs($admin)->get(route('admin.internship-applications.index'));
        $detailResponse = $this->actingAs($admin)->get(route('admin.internship-applications.show', $application));

        $indexResponse->assertOk();
        $indexResponse->assertSeeText('Citra Lestari');
        $indexResponse->assertSeeText('Data Analyst');

        $detailResponse->assertOk();
        $detailResponse->assertSeeText('SMK Telkom Surabaya');
        $detailResponse->assertSeeText('Saya ingin belajar kerja tim dan data workflow.');
    }

    public function test_admins_can_download_internship_cv_and_update_status(): void
    {
        Storage::fake('local');

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        Storage::disk('local')->put('internship-applications/cv/citra.pdf', 'pdf-content');

        $application = InternshipApplication::query()->create($this->internshipApplicationData([
            'cv_path' => 'internship-applications/cv/citra.pdf',
            'status' => 'baru',
        ]));

        $downloadResponse = $this->actingAs($admin)->get(route('admin.internship-applications.download', $application));
        $statusResponse = $this->actingAs($admin)->patch(route('admin.internship-applications.status.update', $application), [
            'status' => 'diproses',
        ]);

        $downloadResponse->assertDownload('citra.pdf');
        $statusResponse->assertRedirect(route('admin.internship-applications.show', $application));
        $this->assertDatabaseHas('internship_applications', [
            'id' => $application->id,
            'status' => 'diproses',
        ]);
    }

    public function test_internship_application_download_returns_not_found_when_cv_file_is_missing(): void
    {
        Storage::fake('local');

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $application = InternshipApplication::query()->create($this->internshipApplicationData([
            'cv_path' => 'internship-applications/cv/missing.pdf',
            'status' => 'baru',
        ]));

        $response = $this->actingAs($admin)->get(route('admin.internship-applications.download', $application));

        $response->assertNotFound();
    }

    public function test_internship_application_inbox_is_paginated(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        foreach (range(1, 16) as $index) {
            $label = str_pad((string) $index, 2, '0', STR_PAD_LEFT);

            InternshipApplication::query()->create($this->internshipApplicationData([
                'nama' => 'Intern '.$label,
                'nisn' => str_pad((string) $index, 10, '0', STR_PAD_LEFT),
            ]));
        }

        $firstPageResponse = $this->actingAs($admin)->get(route('admin.internship-applications.index'));
        $secondPageResponse = $this->actingAs($admin)->get(route('admin.internship-applications.index', ['page' => 2]));

        $firstPageResponse->assertOk();
        $firstPageResponse->assertSeeText('Intern 16');
        $firstPageResponse->assertDontSeeText('Intern 01');
        $firstPageResponse->assertSee('?page=2', false);

        $secondPageResponse->assertOk();
        $secondPageResponse->assertSeeText('Intern 01');
    }

    private function internshipApplicationData(array $overrides = []): array
    {
        return array_merge([
            'nama' => 'Default Intern',
            'nisn' => '1234567890',
            'tempat_lahir' => 'Malang',
            'tanggal_lahir' => '2006-05-01',
            'jk' => 'Perempuan',
            'alamat' => 'Jl. Kenanga No. 2',
            'telp' => '081233344455',
            'kelas' => 'XII',
            'sekolah' => 'SMK Telkom Surabaya',
            'alamat_sekolah' => 'Jl. Telekomunikasi No. 1',
            'telp_sekolah' => '0311234567',
            'divisi_pilihan' => 'Data Analyst',
            'mulai_magang' => '2026-07-01',
            'selesai_magang' => '2026-09-01',
            'motivasi' => 'Saya ingin belajar kerja tim dan data workflow.',
            'portofolio' => 'https://example.com/intern',
            'cv_path' => 'internship-applications/cv/default.pdf',
            'cv_disk' => 'local',
            'pernyataan' => true,
        ], $overrides);
    }
}
