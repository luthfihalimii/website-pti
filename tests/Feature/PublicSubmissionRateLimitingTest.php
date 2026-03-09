<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSubmissionRateLimitingTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_is_rate_limited_after_five_attempts(): void
    {
        foreach (range(1, 5) as $attempt) {
            $response = $this->from(route('contact'))->post(route('contact.store'), [
                'name' => '',
                'email' => 'invalid-email',
                'message' => '',
            ]);

            $response->assertRedirect(route('contact'));
        }

        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => '',
            'email' => 'invalid-email',
            'message' => '',
        ]);

        $response->assertStatus(429);
    }

    public function test_product_inquiry_form_is_rate_limited_after_five_attempts(): void
    {
        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'status' => Product::STATUS_PUBLISHED,
            'slug' => 'smart-procurement-suite',
        ]);

        foreach (range(1, 5) as $attempt) {
            $response = $this->from(route('products.show', $product->slug))->post(route('products.inquiries.store', $product->slug), [
                'name' => '',
                'email' => 'invalid-email',
                'phone' => '',
                'company' => '',
                'message' => '',
            ]);

            $response->assertRedirect(route('products.show', $product->slug));
        }

        $response = $this->from(route('products.show', $product->slug))->post(route('products.inquiries.store', $product->slug), [
            'name' => '',
            'email' => 'invalid-email',
            'phone' => '',
            'company' => '',
            'message' => '',
        ]);

        $response->assertStatus(429);
    }

    public function test_internship_step_one_form_is_rate_limited_after_five_attempts(): void
    {
        foreach (range(1, 5) as $attempt) {
            $response = $this->from(route('internships.steps.one'))->post(route('internships.steps.one.store'), [
                'nama' => '',
                'nisn' => '',
                'tempat_lahir' => '',
                'tanggal_lahir' => '',
                'jk' => '',
                'alamat' => '',
                'telp' => '',
                'kelas' => '',
                'sekolah' => '',
                'alamat_sekolah' => '',
                'telp_sekolah' => '',
            ]);

            $response->assertRedirect(route('internships.steps.one'));
        }

        $response = $this->from(route('internships.steps.one'))->post(route('internships.steps.one.store'), [
            'nama' => '',
            'nisn' => '',
            'tempat_lahir' => '',
            'tanggal_lahir' => '',
            'jk' => '',
            'alamat' => '',
            'telp' => '',
            'kelas' => '',
            'sekolah' => '',
            'alamat_sekolah' => '',
            'telp_sekolah' => '',
        ]);

        $response->assertStatus(429);
    }

    public function test_internship_step_two_form_is_rate_limited_after_five_attempts(): void
    {
        $stepOne = [
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
        ];

        foreach (range(1, 5) as $attempt) {
            $response = $this->withSession([
                'internship_application.step_one' => $stepOne,
            ])->from(route('internships.steps.two'))->post(route('internships.steps.two.store'), [
                'divisi_pilihan' => '',
                'mulai_magang' => '',
                'selesai_magang' => '',
                'motivasi' => '',
                'portofolio' => '',
            ]);

            $response->assertRedirect(route('internships.steps.two'));
        }

        $response = $this->withSession([
            'internship_application.step_one' => $stepOne,
        ])->from(route('internships.steps.two'))->post(route('internships.steps.two.store'), [
            'divisi_pilihan' => '',
            'mulai_magang' => '',
            'selesai_magang' => '',
            'motivasi' => '',
            'portofolio' => '',
        ]);

        $response->assertStatus(429);
    }

    public function test_job_application_form_is_rate_limited_after_five_attempts(): void
    {
        config()->set('site.careers.vacancies', [
            [
                'slug' => 'fullstack-developer',
                'title' => 'Fullstack Developer',
                'summary' => 'Posisi fullstack developer',
                'headline' => 'We Are Hiring Fullstack Developer - Full Time',
                'description' => 'Detail lowongan fullstack developer',
                'qualifications' => ['Pengalaman Laravel'],
                'skills' => ['Laravel'],
                'salary_range' => 'Rp10.000.000 - Rp15.000.000',
                'salary_note' => '(disesuaikan)',
                'salary_context' => 'Sesuai pengalaman',
                'benefits' => ['BPJS'],
                'poster' => 'assets/images/poster-lowongan.png',
            ],
        ]);

        foreach (range(1, 5) as $attempt) {
            $response = $this->from(route('careers.applications.create', 'fullstack-developer'))
                ->post(route('careers.applications.store', 'fullstack-developer'), [
                    'nama_lengkap' => '',
                    'email' => 'invalid-email',
                ]);

            $response->assertRedirect(route('careers.applications.create', 'fullstack-developer'));
        }

        $response = $this->from(route('careers.applications.create', 'fullstack-developer'))
            ->post(route('careers.applications.store', 'fullstack-developer'), [
                'nama_lengkap' => '',
                'email' => 'invalid-email',
            ]);

        $response->assertStatus(429);
    }
}
