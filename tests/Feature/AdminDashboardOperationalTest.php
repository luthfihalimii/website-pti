<?php

namespace Tests\Feature;

use App\Models\InternshipApplication;
use App\Models\JobApplication;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductInquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardOperationalTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_shows_operational_summary_and_recent_activity(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
        ]);

        ProductInquiry::query()->create([
            'product_id' => $product->id,
            'name' => 'Rani Hartono',
            'email' => 'rani@example.com',
            'phone' => '0811223344',
            'company' => 'Pemkot Maju',
            'message' => 'Kami butuh demo produk.',
        ]);

        JobApplication::query()->create($this->jobApplicationData([
            'nama_lengkap' => 'Aditya Pratama',
            'email' => 'aditya@example.com',
        ]));

        InternshipApplication::query()->create($this->internshipApplicationData([
            'nama' => 'Nabila Putri',
            'nisn' => 'INT-001',
        ]));

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSeeText('Lamaran Kerja');
        $response->assertSeeText('Pendaftaran Magang');
        $response->assertSeeText('Inquiry Produk');
        $response->assertSeeText('Aditya Pratama');
        $response->assertSeeText('Nabila Putri');
        $response->assertSeeText('Rani Hartono');
    }

    private function jobApplicationData(array $overrides = []): array
    {
        return array_merge([
            'nama_lengkap' => 'Default Applicant',
            'panggilan' => 'Default',
            'email' => 'default@example.com',
            'nomor_telepon' => '08123456789',
            'alamat' => 'Jl. Mawar No. 1',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'Perempuan',
            'agama' => 'Islam',
            'status_pernikahan' => 'Belum Menikah',
            'golongan_darah' => 'O',
            'pendidikan_terakhir' => 'S1',
            'jurusan' => 'Sistem Informasi',
            'ipk' => '3.75',
            'posisi' => 'Backend Developer',
            'pengalaman_kerja' => '2 tahun pengalaman.',
            'keahlian_khusus' => 'Laravel, PostgreSQL',
            'cv_path' => 'job-applications/cv/default.pdf',
            'cv_disk' => 'local',
            'portofolio' => 'https://example.com/portfolio',
            'sumber_informasi' => 'Website',
            'gaji_diharapkan' => 'Rp 8.000.000',
            'mulai_bekerja' => '2026-04-01',
            'pernyataan_1' => true,
            'pernyataan_2' => true,
            'pernyataan_3' => true,
        ], $overrides);
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
            'sekolah' => 'SMK Negeri 1',
            'alamat_sekolah' => 'Jl. Pendidikan No. 10',
            'telp_sekolah' => '0311234567',
            'divisi_pilihan' => 'Web Development',
            'mulai_magang' => '2026-07-01',
            'selesai_magang' => '2026-09-01',
            'motivasi' => 'Ingin belajar production workflow.',
            'portofolio' => 'https://example.com/intern',
            'cv_path' => 'internship-applications/cv/default.pdf',
            'cv_disk' => 'local',
            'pernyataan' => true,
        ], $overrides);
    }
}
