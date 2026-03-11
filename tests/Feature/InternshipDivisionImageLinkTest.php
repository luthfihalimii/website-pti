<?php

namespace Tests\Feature;

use Tests\TestCase;

class InternshipDivisionImageLinkTest extends TestCase
{
    public function test_internship_page_uses_existing_division_image_asset_paths(): void
    {
        $response = $this->get(route('internships.index'));

        $response->assertOk();
        $response->assertSee('assets/images/web-development.png', false);
        $response->assertSee('assets/images/mobile-development.png', false);
        $response->assertSee('assets/images/ui-ux-designer.png', false);
        $response->assertSee('assets/images/it-support.png', false);
        $response->assertDontSee('assets/images/Web%20Development.png', false);
        $response->assertDontSee('assets/images/Mobile%20Development.png', false);
        $response->assertDontSee('assets/images/UI_UX%20Designer.png', false);
        $response->assertDontSee('assets/images/IT%20Support.png', false);
    }
}
