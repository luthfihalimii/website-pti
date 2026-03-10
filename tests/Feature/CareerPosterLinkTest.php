<?php

namespace Tests\Feature;

use Tests\TestCase;

class CareerPosterLinkTest extends TestCase
{
    public function test_vacancy_detail_uses_existing_poster_asset_path(): void
    {
        $response = $this->get(route('careers.show', 'fullstack-developer'));

        $response->assertOk();
        $response->assertSee('assets/images/poster-lowongan.png', false);
        $response->assertDontSee('assets/images/poster lowongan.png', false);
    }

    public function test_vacancy_detail_and_application_form_use_requested_slug(): void
    {
        config()->set('site.careers.vacancies', [
            [
                'slug' => 'fullstack-developer',
                'title' => 'Fullstack Developer',
                'summary' => 'Posisi pertama',
                'headline' => 'We Are Hiring Fullstack Developer - Full Time',
                'description' => 'Detail posisi pertama',
                'qualifications' => ['Kualifikasi pertama'],
                'skills' => ['Skill pertama'],
                'salary_range' => 'Rp10.000.000 - Rp15.000.000',
                'salary_note' => '(disesuaikan)',
                'salary_context' => 'Konteks pertama',
                'benefits' => ['Benefit pertama'],
                'poster' => 'assets/images/poster-lowongan.png',
            ],
            [
                'slug' => 'ui-ux-designer',
                'title' => 'UI/UX Designer',
                'summary' => 'Posisi kedua',
                'headline' => 'We Are Hiring UI/UX Designer - Contract',
                'description' => 'Detail posisi kedua',
                'qualifications' => ['Kualifikasi kedua'],
                'skills' => ['Skill kedua'],
                'salary_range' => 'Rp7.000.000 - Rp9.000.000',
                'salary_note' => '(negotiable)',
                'salary_context' => 'Konteks kedua',
                'benefits' => ['Benefit kedua'],
                'poster' => 'assets/images/poster-lowongan.png',
            ],
        ]);

        $detailResponse = $this->get(route('careers.show', 'ui-ux-designer'));
        $formResponse = $this->get(route('careers.applications.create', 'ui-ux-designer'));

        $detailResponse->assertOk();
        $detailResponse->assertSeeText('We Are Hiring UI/UX Designer - Contract');
        $detailResponse->assertDontSeeText('We Are Hiring Fullstack Developer - Full Time');

        $formResponse->assertOk();
        $formResponse->assertSeeText('UI/UX Designer');
        $formResponse->assertDontSeeText('Fullstack Developer');
    }
}
