<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductScopeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Seed the database with some test data
        Product::factory()->create(['name' => 'Product A', 'price' => 100, 'quantity_available' => 10]);
        Product::factory()->create(['name' => 'Product B', 'price' => 200, 'quantity_available' => 20]);
        Product::factory()->create(['name' => 'Product C', 'price' => 300, 'quantity_available' => 30]);
    }

    public function test_scope_filter_with_search()
    {
        $filters = ['search' => 'Product A'];
        $products = Product::filter($filters)->get();

        $this->assertCount(1, $products);
        $this->assertEquals('Product A', $products->first()->name);
    }

    public function test_scope_filter_with_sort_price_asc()
    {
        $filters = ['sort' => 'price_asc'];
        $products = Product::filter($filters)->get();

        $this->assertEquals(100, $products->first()->price);
        $this->assertEquals(300, $products->last()->price);
    }

    public function test_scope_filter_with_sort_price_desc()
    {
        $filters = ['sort' => 'price_desc'];
        $products = Product::filter($filters)->get();

        $this->assertEquals(300, $products->first()->price);
        $this->assertEquals(100, $products->last()->price);
    }

    public function test_scope_filter_with_sort_quantity_asc()
    {
        $filters = ['sort' => 'quantity_asc'];
        $products = Product::filter($filters)->get();

        $this->assertEquals(10, $products->first()->quantity_available);
        $this->assertEquals(30, $products->last()->quantity_available);
    }

    public function test_scope_filter_with_sort_quantity_desc()
    {
        $filters = ['sort' => 'quantity_desc'];
        $products = Product::filter($filters)->get();

        $this->assertEquals(30, $products->first()->quantity_available);
        $this->assertEquals(10, $products->last()->quantity_available);
    }
}
