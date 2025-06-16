<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;

class ProductUnitTest extends TestCase
{
    public function test_product_can_be_created_with_name()
    {
        $product = new Product();
        $product->name = 'Test Product';
         $product->price = '100';
       //   $this->assertTrue(true);
       $this->assertEquals('Test Product', $product->name);
        $this->assertEquals('100', $product->price);
    }
}
