<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\SupportTraits\Authenticated;
use Tests\TestCase;

class ProductModuleTest extends TestCase
{

    use RefreshDatabase,Authenticated;

    public function test_product_index_screen_can_be_rendered(): void
    {
        $this->actingAsAdmin();
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    public function test_products_are_listed(): void
    {
        $this->actingAsAdmin();
        $response = $this->get('/products');

        $response->assertSee('Products');
    }
}
