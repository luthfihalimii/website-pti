<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InternshipFormMarkupTest extends TestCase
{
    use RefreshDatabase;

    public function test_step_one_form_posts_to_step_one_store_with_expected_fields(): void
    {
        $response = $this->get(route('internships.steps.one'));

        $response->assertOk();
        $response->assertSee('action="'.route('internships.steps.one.store').'"', false);
        $response->assertSee('name="nama"', false);
        $response->assertSee('name="nisn"', false);
        $response->assertSee('name="tanggal_lahir"', false);
        $response->assertSee('type="date"', false);
        $response->assertDontSee("onfocus=\"this.type='date'\"", false);
    }

    public function test_step_two_form_posts_to_step_two_store_with_multipart_and_date_inputs(): void
    {
        $response = $this->withSession([
            'internship_application.step_one' => [
                'nama' => 'Demo User',
                'nisn' => '123456',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2005-01-01',
                'jk' => 'Laki-laki',
                'alamat' => 'Jl. Demo',
                'telp' => '08123456789',
                'kelas' => 'XI',
                'sekolah' => 'SMK Demo',
                'alamat_sekolah' => 'Jl. Sekolah Demo',
                'telp_sekolah' => '0311234567',
            ],
        ])->get(route('internships.steps.two'));

        $response->assertOk();
        $response->assertSee('action="'.route('internships.steps.two.store').'"', false);
        $response->assertSee('enctype="multipart/form-data"', false);
        $response->assertSee('name="mulai_magang"', false);
        $response->assertSee('name="selesai_magang"', false);
        $response->assertSee('type="date"', false);
        $response->assertDontSee('hh/bb/tttt');
        $response->assertDontSee("onfocus=\"this.type='date'\"", false);
    }
}
