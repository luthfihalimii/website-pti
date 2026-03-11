<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CareerVacancyEmptyStateTest extends TestCase
{
    use RefreshDatabase;

    public function test_career_page_shows_empty_state_when_no_active_vacancies_exist(): void
    {
        $response = $this->get(route('careers.index'));

        $response->assertOk();
        $response->assertSeeText('Saat ini belum ada lowongan pekerjaan');
        $response->assertSeeText('Silakan cek kembali secara berkala untuk melihat posisi terbaru.');
    }
}
