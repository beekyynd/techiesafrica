<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'sku' => strtoupper(Str::random(8)),
            'price' => $this->faker->randomFloat(2, 10, 200),
            'quantity' => $this->faker->numberBetween(1, 50),
            'image_path' => null,
        ];
    }
}
