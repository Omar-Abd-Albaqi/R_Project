<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductFeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */

      public function test_products_index_requires_authentication()
    {
        $response = $this->getJson('/api/products');

      
        $response->assertStatus(401);
    }

    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
}
