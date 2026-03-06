<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocaleSwitchTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitors_can_switch_locale_to_english(): void
    {
        $response = $this->from(route('home'))->post(route('locale.switch'), [
            'locale' => 'en',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('locale', 'en');

        $homeResponse = $this->withSession([
            'locale' => 'en',
        ])->get(route('home'));

        $homeResponse->assertOk();
        $homeResponse->assertSeeText('Home');
        $homeResponse->assertSeeText('Services');
    }

    public function test_invalid_locale_value_is_rejected(): void
    {
        $response = $this->from(route('home'))->post(route('locale.switch'), [
            'locale' => 'de',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors('locale');
    }
}
