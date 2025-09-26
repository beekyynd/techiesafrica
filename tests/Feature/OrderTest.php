<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Product;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_order_with_insufficient_stock()
{
    $user = User::factory()->create();
    $product = Product::factory()->create(['quantity'=>1,'price'=>100]);

    $token = $user->createToken('test')->plainTextToken;

    $response = $this->withHeader('Authorization','Bearer '.$token)
        ->postJson('/api/orders', ['items'=>[['product_id'=>$product->id,'quantity'=>2]]]);

    $response->assertStatus(422);
    // product quantity should remain unchanged
    $this->assertDatabaseHas('products',['id'=>$product->id,'quantity'=>1]);
}

}
