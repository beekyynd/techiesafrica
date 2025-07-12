<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\NGUSASeeder; 
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(NGUSASeeder::class);
    }
}
