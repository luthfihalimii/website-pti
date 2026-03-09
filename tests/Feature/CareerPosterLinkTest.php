<?php

namespace Tests\Feature;

use Tests\TestCase;

class CareerPosterLinkTest extends TestCase
{
    public function test_vacancy_detail_uses_existing_poster_asset_path(): void
    {
        $response = $this->get(route('careers.show'));

        $response->assertOk();
        $response->assertSee('assets/images/poster-lowongan.png', false);
        $response->assertDontSee('assets/images/poster lowongan.png', false);
    }
}

