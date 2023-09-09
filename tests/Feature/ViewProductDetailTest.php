<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewProductDetailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A product page loads.
     */
    public function test_a_product_page_loads(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product->id));

        $response->assertStatus(200)->assertSee('product');
    }
}
