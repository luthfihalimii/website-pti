<?php

namespace Tests\Feature;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class InternshipApplicationFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_candidates_complete_the_two_step_internship_application_flow(): void
    {
        Storage::fake('local');

        $stepOneResponse = $this->post(route('internships.steps.one.store'), [
            'nama' => 'Dina Aulia',
            'nisn' => '20260001',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '2005-07-17',
            'jk' => 'Perempuan',
            'alamat' => 'Jl. Ketintang Baru No. 12 Surabaya',
            'telp' => '08123456789',
            'kelas' => 'S1',
            'sekolah' => 'Universitas Negeri Surabaya',
            'alamat_sekolah' => 'Jl. Lidah Wetan, Surabaya',
            'telp_sekolah' => '0311234567',
        ]);

        $stepOneResponse->assertRedirect(route('internships.steps.two'));
        $stepOneResponse->assertSessionHas('internship_application.step_one.nama', 'Dina Aulia');

        $stepTwoResponse = $this->withSession([
            'internship_application.step_one' => [
                'nama' => 'Dina Aulia',
                'nisn' => '20260001',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2005-07-17',
                'jk' => 'Perempuan',
                'alamat' => 'Jl. Ketintang Baru No. 12 Surabaya',
                'telp' => '08123456789',
                'kelas' => 'S1',
                'sekolah' => 'Universitas Negeri Surabaya',
                'alamat_sekolah' => 'Jl. Lidah Wetan, Surabaya',
                'telp_sekolah' => '0311234567',
            ],
        ])->post(route('internships.steps.two.store'), [
            'divisi_pilihan' => 'Web Development',
            'mulai_magang' => '2026-07-01',
            'selesai_magang' => '2026-09-30',
            'motivasi' => 'Saya ingin terlibat langsung dalam pengembangan aplikasi web production-grade.',
            'portofolio' => 'https://github.com/dinaaulia',
            'cv' => UploadedFile::fake()->create('internship-cv.pdf', 512, 'application/pdf'),
            'pernyataan' => '1',
        ]);

        $stepTwoResponse->assertRedirect(route('magang.selesai'));
        $stepTwoResponse->assertSessionMissing('internship_application.step_one');

        $this->assertDatabaseHas('internship_applications', [
            'nama' => 'Dina Aulia',
            'divisi_pilihan' => 'Web Development',
            'cv_disk' => 'local',
        ]);

        $application = \DB::table('internship_applications')->where('nisn', '20260001')->first();

        Storage::disk('local')->assertExists($application->cv_path);
    }

    public function test_step_two_requires_step_one_session_data(): void
    {
        $response = $this->get(route('internships.steps.two'));

        $response->assertRedirect(route('internships.steps.one'));
        $response->assertSessionHas('internship_error');
    }

    public function test_internship_step_two_rejects_division_outside_config_whitelist(): void
    {
        Storage::fake('local');

        $response = $this->withSession([
            'internship_application.step_one' => [
                'nama' => 'Dina Aulia',
                'nisn' => '20260001',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2005-07-17',
                'jk' => 'Perempuan',
                'alamat' => 'Jl. Ketintang Baru No. 12 Surabaya',
                'telp' => '08123456789',
                'kelas' => 'S1',
                'sekolah' => 'Universitas Negeri Surabaya',
                'alamat_sekolah' => 'Jl. Lidah Wetan, Surabaya',
                'telp_sekolah' => '0311234567',
            ],
        ])->from(route('internships.steps.two'))
            ->post(route('internships.steps.two.store'), [
                'divisi_pilihan' => 'Black Ops',
                'mulai_magang' => '2026-07-01',
                'selesai_magang' => '2026-09-30',
                'motivasi' => 'Saya ingin terlibat langsung dalam pengembangan aplikasi web production-grade.',
                'portofolio' => 'https://github.com/dinaaulia',
                'cv' => UploadedFile::fake()->create('internship-cv.pdf', 512, 'application/pdf'),
                'pernyataan' => '1',
            ]);

        $response->assertRedirect(route('internships.steps.two'));
        $response->assertSessionHasErrors(['divisi_pilihan']);
        $this->assertDatabaseCount('internship_applications', 0);
        $this->assertSame([], Storage::disk('local')->allFiles('internship-applications/cv'));
    }

    public function test_uploaded_cv_is_deleted_when_internship_persistence_fails(): void
    {
        Storage::fake('local');
        Schema::drop('internship_applications');
        $this->withoutExceptionHandling();

        try {
            $this->withSession([
                'internship_application.step_one' => [
                    'nama' => 'Dina Aulia',
                    'nisn' => '20260001',
                    'tempat_lahir' => 'Surabaya',
                    'tanggal_lahir' => '2005-07-17',
                    'jk' => 'Perempuan',
                    'alamat' => 'Jl. Ketintang Baru No. 12 Surabaya',
                    'telp' => '08123456789',
                    'kelas' => 'S1',
                    'sekolah' => 'Universitas Negeri Surabaya',
                    'alamat_sekolah' => 'Jl. Lidah Wetan, Surabaya',
                    'telp_sekolah' => '0311234567',
                ],
            ])->post(route('internships.steps.two.store'), [
                'divisi_pilihan' => 'Web Development',
                'mulai_magang' => '2026-07-01',
                'selesai_magang' => '2026-09-30',
                'motivasi' => 'Saya ingin terlibat langsung dalam pengembangan aplikasi web production-grade.',
                'portofolio' => 'https://github.com/dinaaulia',
                'cv' => UploadedFile::fake()->create('internship-cv.pdf', 512, 'application/pdf'),
                'pernyataan' => '1',
            ]);

            $this->fail('Expected internship application persistence to fail.');
        } catch (QueryException) {
            $this->assertSame([], Storage::disk('local')->allFiles('internship-applications/cv'));
        }
    }
}
