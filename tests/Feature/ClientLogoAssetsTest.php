<?php

namespace Tests\Feature;

use Tests\TestCase;

class ClientLogoAssetsTest extends TestCase
{
    public function test_all_configured_client_logo_assets_exist(): void
    {
        $clients = config('site.home.clients', []);

        $this->assertNotEmpty($clients, 'Client list in site.home.clients should not be empty.');

        foreach ($clients as $client) {
            $name = $client['name'] ?? 'unknown-client';
            $logo = $client['logo'] ?? null;

            $this->assertNotEmpty($logo, "Logo path for client [{$name}] should not be empty.");
            $this->assertFileExists(
                public_path($logo),
                "Client logo for [{$name}] is missing at [{$logo}]."
            );
        }
    }
}
