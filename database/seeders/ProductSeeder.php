<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Oraimo Wireless Charger',
            'sku' => 'CHRG-ORAIMO-01',
            'price' => 25.50,
            'quantity' => 20,
            'image_path' => null,
        ]);

        Product::create([
            'name' => 'Blue Jeans',
            'sku' => 'JEANS-BLUE-32',
            'price' => 45.00,
            'quantity' => 15,
            'image_path' => null,
        ]);

        Product::create([
            'name' => 'Oraimo Earbuds',
            'sku' => 'EAR-ORAIMO-02',
            'price' => 20.00,
            'quantity' => 10,
            'image_path' => null,
        ]);

        Product::create([
            'name' => 'Green Hoodie',
            'sku' => 'HOOD-GRN-L',
            'price' => 35.00,
            'quantity' => 8,
            'image_path' => null,
        ]);

        Product::create([
            'name' => 'Redmi Note 10',
            'sku' => 'PHONE-XIAOMI-10',
            'price' => 250.00,
            'quantity' => 25,
            'image_path' => null,
        ]);
    }
}
