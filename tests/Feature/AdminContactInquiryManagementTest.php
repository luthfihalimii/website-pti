<?php

namespace Tests\Feature;

use App\Models\ContactInquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminContactInquiryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admins_can_view_and_delete_contact_inquiries(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $inquiry = ContactInquiry::query()->create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'message' => 'Kami ingin diskusi implementasi transformasi digital.',
        ]);

        $indexResponse = $this->actingAs($admin)->get(route('admin.contact-inquiries.index'));
        $deleteResponse = $this->actingAs($admin)->delete(route('admin.contact-inquiries.destroy', $inquiry));

        $indexResponse->assertOk();
        $indexResponse->assertSeeText('Budi Santoso');
        $indexResponse->assertSeeText('budi@example.com');

        $deleteResponse->assertRedirect(route('admin.contact-inquiries.index'));
        $this->assertDatabaseMissing('contact_inquiries', [
            'id' => $inquiry->id,
        ]);
    }

    public function test_contact_inquiry_inbox_is_paginated(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        foreach (range(1, 16) as $index) {
            $label = str_pad((string) $index, 2, '0', STR_PAD_LEFT);

            ContactInquiry::query()->create([
                'name' => 'Kontak '.$label,
                'email' => 'kontak'.$label.'@example.com',
                'message' => 'Pesan kontak ke-'.$label.' untuk tim admin.',
            ]);
        }

        $firstPageResponse = $this->actingAs($admin)->get(route('admin.contact-inquiries.index'));
        $secondPageResponse = $this->actingAs($admin)->get(route('admin.contact-inquiries.index', ['page' => 2]));

        $firstPageResponse->assertOk();
        $firstPageResponse->assertSeeText('Kontak 16');
        $firstPageResponse->assertDontSeeText('Kontak 01');
        $firstPageResponse->assertSee('?page=2', false);

        $secondPageResponse->assertOk();
        $secondPageResponse->assertSeeText('Kontak 01');
    }
}
