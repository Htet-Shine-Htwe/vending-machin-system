<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Services\Product\ProductService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Builder;
use Mockery\MockInterface;

use Tests\SupportTraits\Authenticated;
use Tests\SupportTraits\MocksPaginatedBuilder;
use Tests\TestCase;

class ProductModuleTest extends TestCase
{
    use RefreshDatabase,Authenticated,MocksPaginatedBuilder;

    public function setUp(): void
    {
        parent::setUp();
        $this->seedClasses(RolePermissionSeeder::class);
        $this->actingAsAdmin();
    }

    public function test_see_products_index_page_rendered_correctly()
    {
        $productsCollection = Product::factory()->count(5)->make();

        $mockBuilder = \Mockery::mock(Builder::class);
        $mockBuilder->shouldReceive('filter')->andReturnSelf();
        $mockBuilder->shouldReceive('latest')->andReturnSelf();

        $this->mockPaginate($mockBuilder, $productsCollection);

        $this->mock(ProductService::class, function (MockInterface $mock) use ($mockBuilder) {
            $mock->shouldReceive('getAll')
                ->once()
                ->andReturn($mockBuilder);
        });

        $response = $this->actingAsAdmin()->get(route('products.index'));

        $response->assertStatus(200);

        $response->assertViewHas('products', function ($viewProducts) use ($productsCollection) {
            return $viewProducts->getCollection()->toArray() == $productsCollection->toArray();
        });

    }

    public function test_can_render_view_page()
    {
        $response = $this->get(route('products.create'));

        $response->assertStatus(200);

        $response->assertViewHas('editPage', false);
    }


    public function test_can_create_product()
    {
        $productData = Product::factory()->make()->toArray();

        $this->mock(ProductService::class, function (MockInterface $mock) use ($productData) {
            $mock->shouldReceive('create')
                ->once()
                ->andReturn(Product::make($productData));
        });

        $response = $this->post(route('products.store'), $productData);

        $response->assertRedirect(route('products.index'));

        $response->assertSessionHas('success', 'Product created successfully');
    }


    public function test_can_view_edit_page_with_product_data()
    {
        $product = Product::factory()->make(['slug' => 'test-slug']);

        $this->mock(ProductService::class, function (MockInterface $mock) use ($product) {
            $mock->shouldReceive('getBySlug')
                ->once()
                ->with('test-slug')
                ->andReturn($product);
        });

        $response = $this->get(route('products.edit', ['slug' => 'test-slug']));

        $response->assertStatus(200);

        $response->assertViewHas('product', $product);
        $response->assertViewHas('editPage', true);
    }


    public function test_can_update_product()
    {
        $product = Product::factory()->make(['slug' => 'test-slug']);
        $productData = $product->toArray();

        $this->mock(ProductService::class, function (MockInterface $mock) use ($productData) {
            $mock->shouldReceive('update')
                ->once()
                ->andReturn(true);
        });

        $response = $this->post(route('products.update', ['slug' => 'test-slug']), $productData);

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('success', 'Product updated successfully');
    }

    public function test_can_delete_product()
    {
        $this->mock(ProductService::class, function (MockInterface $mock) {
            $mock->shouldReceive('delete')
                ->once()
                ->andReturn(true);
        });

        $response = $this->delete(route('products.delete', ['slug' => 'test-slug']));

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('success', 'Product Removed successfully');
    }
}
