<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicRouteAvailabilityTest extends TestCase
{
    use RefreshDatabase;

    public static function publicPageProvider(): array
    {
        return [
            'home' => ['home'],
            'about' => ['about'],
            'services' => ['services'],
            'products' => ['products.index'],
            'internships' => ['internships.index'],
            'careers' => ['careers.index'],
            'career-detail' => ['careers.show'],
            'career-form' => ['careers.applications.create'],
            'contact' => ['contact'],
            'publications' => ['publications.index'],
        ];
    }

    #[DataProvider('publicPageProvider')]
    public function test_named_public_pages_are_available(string $routeName): void
    {
        $response = $this->get(route($routeName));

        $response->assertOk();
    }
}
