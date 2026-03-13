<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServicesImageAssetPathTest extends TestCase
{
    public function test_services_page_uses_existing_image_asset_paths(): void
    {
        $response = $this->get(route('services'));

        $response->assertOk();
        $response->assertSee('assets/images/it-consultant.png', false);
        $response->assertSee('assets/images/erp-business-system.png', false);
        $response->assertSee('assets/images/e-government.png', false);
        $response->assertDontSee('assets/images/IT Consultant.png', false);
        $response->assertDontSee('assets/images/ERP _ Bussines System.png', false);
        $response->assertDontSee('assets/images/E-Government .png', false);
    }
}
