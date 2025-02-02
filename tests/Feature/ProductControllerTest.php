<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_product_list()
    {
        $product = Product::factory()->create();
        
        $response = $this->get(route('product.index'));
        
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    /** @test */
    public function it_shows_create_product_page()
    {
        $response = $this->get(route('product.create'));
        
        $response->assertStatus(200);
    }

    /** @test */
    public function it_creates_a_product()
    {
        $data = [
            'name' => 'Test Product',
            'category' => 'Electronics',
            'price' => 99.99,
            'Descriptions' => 'A test product description',
        ];

        $response = $this->post(route('product.store'), $data);

        $this->assertDatabaseHas('products', $data);
        $response->assertRedirect(route('product.index'));
    }

    /** @test */
    public function it_shows_edit_product_page()
    {
        $product = Product::factory()->create();
        
        $response = $this->get(route('product.edit', $product));
        
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    /** @test */
    public function it_updates_a_product()
    {
        $product = Product::factory()->create();

        $updatedData = [
            'name' => 'Updated Product',
            'category' => 'Updated Category',
            'price' => 150.00,
            'Descriptions' => 'Updated description',
        ];

        $response = $this->put(route('product.update', $product), $updatedData);

        $this->assertDatabaseHas('products', $updatedData);
        $response->assertRedirect(route('product.index'));
    }

    /** @test */
    public function it_deletes_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('product.destroy', $product));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $response->assertRedirect(route('product.index'));
    }
}
