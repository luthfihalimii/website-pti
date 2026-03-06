<?php

namespace Tests\Feature;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminJobApplicationManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admins_can_view_job_application_inbox_and_detail_pages(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $application = JobApplication::query()->create($this->jobApplicationData([
            'nama_lengkap' => 'Bayu Saputra',
            'email' => 'bayu@example.com',
            'status' => 'baru',
        ]));

        $indexResponse = $this->actingAs($admin)->get(route('admin.job-applications.index'));
        $detailResponse = $this->actingAs($admin)->get(route('admin.job-applications.show', $application));

        $indexResponse->assertOk();
        $indexResponse->assertSeeText('Bayu Saputra');
        $indexResponse->assertSeeText('Backend Engineer');

        $detailResponse->assertOk();
        $detailResponse->assertSeeText('bayu@example.com');
        $detailResponse->assertSeeText('Portfolio & Sistem Internal');
    }

    public function test_admins_can_download_job_application_cv_and_update_status(): void
    {
        Storage::fake('local');

        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        Storage::disk('local')->put('job-applications/cv/bayu.pdf', 'pdf-content');

        $application = JobApplication::query()->create($this->jobApplicationData([
            'cv_path' => 'job-applications/cv/bayu.pdf',
            'status' => 'baru',
        ]));

        $downloadResponse = $this->actingAs($admin)->get(route('admin.job-applications.download', $application));
        $statusResponse = $this->actingAs($admin)->patch(route('admin.job-applications.status.update', $application), [
            'status' => 'direview',
        ]);

        $downloadResponse->assertDownload('bayu.pdf');
        $statusResponse->assertRedirect(route('admin.job-applications.show', $application));
        $this->assertDatabaseHas('job_applications', [
            'id' => $application->id,
            'status' => 'direview',
        ]);
    }

    private function jobApplicationData(array $overrides = []): array
    {
        return array_merge([
            'nama_lengkap' => 'Default Applicant',
            'panggilan' => 'Bayu',
            'email' => 'default@example.com',
            'nomor_telepon' => '08123456789',
            'alamat' => 'Jl. Mawar No. 1',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'Laki-Laki',
            'agama' => 'Islam',
            'status_pernikahan' => 'Belum Menikah',
            'golongan_darah' => 'O',
            'pendidikan_terakhir' => 'S1',
            'jurusan' => 'Teknik Informatika',
            'ipk' => '3.60',
            'posisi' => 'Backend Engineer',
            'pengalaman_kerja' => 'Membangun API internal dan aplikasi monitoring.',
            'keahlian_khusus' => 'Laravel, Redis, PostgreSQL',
            'cv_path' => 'job-applications/cv/default.pdf',
            'cv_disk' => 'local',
            'portofolio' => 'Portfolio & Sistem Internal',
            'sumber_informasi' => 'LinkedIn',
            'gaji_diharapkan' => 'Rp 12.000.000',
            'mulai_bekerja' => '2026-05-01',
            'pernyataan_1' => true,
            'pernyataan_2' => true,
            'pernyataan_3' => true,
        ], $overrides);
    }
}
