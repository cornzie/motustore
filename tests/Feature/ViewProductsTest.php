<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test products listing page loads.
     */
    public function test_product_listing_page_loads(): void
    {
        Product::factory()->count(10)->create();

        $response = $this->get(route('products.index'));

        $response->assertStatus(200)->assertSee('products');
    }
}
