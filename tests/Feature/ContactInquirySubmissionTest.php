<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactInquirySubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitors_can_submit_a_contact_inquiry(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'message' => 'Saya ingin berdiskusi mengenai implementasi e-procurement.',
        ]);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('contact_status');

        $this->assertDatabaseHas('contact_inquiries', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
        ]);
    }

    public function test_contact_inquiry_submission_requires_valid_data(): void
    {
        $response = $this->from(route('contact'))
            ->post(route('contact.store'), [
                'name' => '',
                'email' => 'invalid-email',
                'message' => '',
            ]);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHasErrors([
            'name',
            'email',
            'message',
        ]);

        $this->assertDatabaseCount('contact_inquiries', 0);
    }
}
