<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class JobApplicationSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_applicants_can_submit_a_job_application_with_a_pdf_cv(): void
    {
        Storage::fake('local');

        $response = $this->post(route('careers.applications.store'), [
            'nama_lengkap' => 'Aletha Leatomu',
            'panggilan' => 'Aletha',
            'email' => 'aletha@example.com',
            'nomor_telepon' => '08123456789',
            'alamat' => 'Jl. Kebon Jeruk No. 5 Kota Semarang',
            'tempat_lahir' => 'Semarang',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'Perempuan',
            'agama' => 'Kristen',
            'status_pernikahan' => 'Belum Menikah',
            'golongan_darah' => 'O',
            'pendidikan_terakhir' => 'S1',
            'jurusan' => 'Sistem Informasi',
            'ipk' => '3.50',
            'posisi' => 'Fullstack Developer',
            'pengalaman_kerja' => 'Pernah mengerjakan aplikasi internal perusahaan.',
            'keahlian_khusus' => 'Laravel, Vue, PostgreSQL',
            'cv' => UploadedFile::fake()->create('cv.pdf', 512, 'application/pdf'),
            'portofolio' => 'https://github.com/aletha',
            'sumber_informasi' => 'Website Perusahaan',
            'gaji_diharapkan' => 'Rp 10.000.000',
            'mulai_bekerja' => '2026-04-01',
            'pernyataan_1' => '1',
            'pernyataan_2' => '1',
            'pernyataan_3' => '1',
        ]);

        $response->assertRedirect(route('careers.applications.create'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('job_applications', [
            'email' => 'aletha@example.com',
            'posisi' => 'Fullstack Developer',
            'cv_disk' => 'local',
        ]);

        $application = \DB::table('job_applications')->where('email', 'aletha@example.com')->first();

        Storage::disk('local')->assertExists($application->cv_path);
    }

    public function test_application_submission_requires_valid_data(): void
    {
        Storage::fake('local');

        $response = $this->from(route('careers.applications.create'))
            ->post(route('careers.applications.store'), [
                'nama_lengkap' => '',
                'email' => 'not-an-email',
                'cv' => UploadedFile::fake()->create('cv.txt', 10, 'text/plain'),
            ]);

        $response->assertRedirect(route('careers.applications.create'));
        $response->assertSessionHasErrors([
            'nama_lengkap',
            'panggilan',
            'email',
            'cv',
            'pernyataan_1',
            'pernyataan_2',
            'pernyataan_3',
        ]);

        $this->assertDatabaseCount('job_applications', 0);
    }
}
