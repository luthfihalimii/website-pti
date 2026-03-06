<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicationFlipbookTest extends TestCase
{
    public function test_publication_flipbook_accepts_a_whitelisted_pdf(): void
    {
        $response = $this->get(route('publications.flipbook', [
            'file' => 'assets/pdf/company-profile.pdf',
            'title' => 'Company Profile',
        ]));

        $response->assertOk();
        $response->assertSeeText('Company Profile');
    }

    public function test_publication_flipbook_rejects_unknown_files(): void
    {
        $response = $this->get(route('publications.flipbook', [
            'file' => 'assets/pdf/not-allowed.pdf',
        ]));

        $response->assertNotFound();
    }
}
