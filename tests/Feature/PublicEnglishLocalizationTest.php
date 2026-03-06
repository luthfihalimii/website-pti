<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductCategory;
use Database\Seeders\ProductCatalogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicEnglishLocalizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render_english_copy_when_locale_is_en(): void
    {
        $this->seed(ProductCatalogSeeder::class);

        $homeResponse = $this->withSession(['locale' => 'en'])->get(route('home'));
        $homeResponse->assertOk();
        $homeResponse->assertSeeText('Services');
        $homeResponse->assertSeeText('Our Featured Products');
        $homeResponse->assertSeeText('Our Clients');

        $servicesResponse = $this->withSession(['locale' => 'en'])->get(route('services'));
        $servicesResponse->assertOk();
        $servicesResponse->assertSeeText('Services');
        $servicesResponse->assertSeeText('Related Product Categories');

        $productsResponse = $this->withSession(['locale' => 'en'])->get(route('products.index'));
        $productsResponse->assertOk();
        $productsResponse->assertSeeText('Product Catalog');
        $productsResponse->assertSeeText('Search Products');
        $productsResponse->assertSeeText('All categories');
        $productsResponse->assertSeeText('All Products');

        $contactResponse = $this->withSession(['locale' => 'en'])->get(route('contact'));
        $contactResponse->assertOk();
        $contactResponse->assertSeeText('How Can We Help You?');
        $contactResponse->assertSeeText('Send');

        $publicationResponse = $this->withSession(['locale' => 'en'])->get(route('publications.index'));
        $publicationResponse->assertOk();
        $publicationResponse->assertSeeText('Publications');
        $publicationResponse->assertSeeText('Document');

        $careersResponse = $this->withSession(['locale' => 'en'])->get(route('careers.index'));
        $careersResponse->assertOk();
        $careersResponse->assertSeeText('Job Openings');
        $careersResponse->assertSeeText('JOB OPENINGS');

        $internshipResponse = $this->withSession(['locale' => 'en'])->get(route('internships.index'));
        $internshipResponse->assertOk();
        $internshipResponse->assertSeeText('INTERNSHIP');
        $internshipResponse->assertSeeText('Internship Program Benefits');
    }

    public function test_flash_messages_use_english_copy_when_locale_is_en(): void
    {
        $contactResponse = $this->withSession(['locale' => 'en'])->post(route('contact.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'I want to discuss ERP implementation opportunities.',
        ]);

        $contactResponse->assertRedirect(route('contact'));
        $contactResponse->assertSessionHas('contact_status', 'Your message was sent successfully. Our team will contact you soon.');

        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create([
            'product_category_id' => $category->id,
            'status' => Product::STATUS_PUBLISHED,
            'slug' => 'insight-gov',
        ]);

        $productInquiryResponse = $this->withSession(['locale' => 'en'])->post(route('products.inquiries.store', $product->slug), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '081234567890',
            'company' => 'Example Corp',
            'message' => 'Please schedule a product demo for next week.',
        ]);

        $productInquiryResponse->assertRedirect(route('products.show', $product->slug));
        $productInquiryResponse->assertSessionHas('product_inquiry_status', 'Your demo request was sent successfully. Our team will contact you soon.');

        $internshipResponse = $this->withSession(['locale' => 'en'])->get(route('internships.steps.two'));
        $internshipResponse->assertRedirect(route('internships.steps.one'));
        $internshipResponse->assertSessionHas('internship_error', 'Complete Step 1 before continuing.');
    }
}
