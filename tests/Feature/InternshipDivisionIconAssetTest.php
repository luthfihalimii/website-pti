<?php

namespace Tests\Feature;

use Tests\TestCase;

class InternshipDivisionIconAssetTest extends TestCase
{
    public function test_internship_division_icons_exist_and_are_referenced_on_page(): void
    {
        $response = $this->get(route('internships.index'));

        $response->assertOk();

        $divisions = config('site.internships.divisions', []);

        $this->assertNotEmpty($divisions, 'Internship divisions should not be empty.');

        foreach ($divisions as $division) {
            $title = $division['title'] ?? 'unknown-division';
            $img = $division['img'] ?? null;

            $this->assertNotEmpty($img, "Division [{$title}] must have an img value.");
            $this->assertFileExists(
                public_path('assets/images/'.$img),
                "Division [{$title}] icon is missing at [assets/images/{$img}]."
            );
            $response->assertSee('assets/images/'.$img, false);
        }
    }
}
