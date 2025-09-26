<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class DiscountTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_discount_applied_for_order_above_500()
{
    $user = User::factory()->create();
    $product = Product::factory()->create(['quantity'=>10,'price'=>100]);

    $token = $user->createToken('test')->plainTextToken;

    $response = $this->withHeader('Authorization','Bearer '.$token)
        ->postJson('/api/orders', ['items'=>[['product_id'=>$product->id,'quantity'=>1]]]);

    $response->assertStatus(201);
    $json = $response->json();
    // total should be 100 - 10% = 90
    $this->assertEquals(90, $json['order']['total_amount']);
}

}
