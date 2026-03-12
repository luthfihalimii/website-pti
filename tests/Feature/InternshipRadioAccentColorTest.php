<?php

namespace Tests\Feature;

use Tests\TestCase;

class InternshipRadioAccentColorTest extends TestCase
{
    public function test_step_one_radios_use_blue_accent_color(): void
    {
        $response = $this->get(route('internships.steps.one'));

        $response->assertOk();
        $response->assertSee('accent-color:#2563EB', false);
    }

    public function test_step_two_radios_use_blue_accent_color(): void
    {
        $response = $this->withSession([
            'internship_application.step_one' => ['nama' => 'Dummy'],
        ])->get(route('internships.steps.two'));

        $response->assertOk();
        $response->assertSee('accent-color:#2563EB', false);
    }
}
