<?php

namespace Tests\Feature;

use Tests\TestCase;

class TabletResponsiveLayoutTest extends TestCase
{
    public function test_career_page_hero_uses_tablet_friendly_breakpoint(): void
    {
        $response = $this->get(route('careers.index'));

        $response->assertOk();
        $response->assertSee('text-4xl sm:text-5xl lg:text-[68px]', false);
        $response->assertDontSee('text-[54px] md:text-[68px]', false);
    }
}
