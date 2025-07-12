<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NGUSASeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ng')->insert([
            ['id' => 1, 'webID' => 9389, 'website' => 'Zoho', 'price' => 2],
            ['id' => 2, 'webID' => 6350, 'website' => 'Gmail', 'price' => 2],
            ['id' => 3, 'webID' => 6346, 'website' => 'Whatsapp', 'price' => 2],
            ['id' => 4, 'webID' => 8613, 'website' => 'Others', 'price' => 2.5],
            ['id' => 5, 'webID' => 9358, 'website' => 'Discord', 'price' => 2],
            ['id' => 6, 'webID' => 8840, 'website' => 'Telegram', 'price' => 2.5],
            ['id' => 7, 'webID' => 6354, 'website' => 'Netflix', 'price' => 2.5],
            ['id' => 8, 'webID' => 7855, 'website' => 'Bolt', 'price' => 2],
        ]);

        DB::table('usa')->insert([
            ['id' => 1, 'webID' => 1554, 'website' => 'Facebook', 'price' => 1.9],
            ['id' => 2, 'webID' => 1623, 'website' => 'Whatsapp', 'price' => 2.5],
            ['id' => 3, 'webID' => 1533, 'website' => 'Amazon', 'price' => 1.7],
            ['id' => 4, 'webID' => 1607, 'website' => 'Telegram', 'price' => 2.5],
            ['id' => 5, 'webID' => 1590, 'website' => 'Plenty of Fish', 'price' => 1],
            ['id' => 6, 'webID' => 1611, 'website' => 'Tinder', 'price' => 2],
            ['id' => 7, 'webID' => 1591, 'website' => 'Paypal', 'price' => 2],
            ['id' => 8, 'webID' => 1616, 'website' => 'Uber', 'price' => 1.7],
            ['id' => 9, 'webID' => 7162, 'website' => 'Apple', 'price' => 1.7],
            ['id' => 10, 'webID' => 5751, 'website' => 'Bumble', 'price' => 1.7],
            ['id' => 11, 'webID' => 1624, 'website' => 'Yahoo', 'price' => 1],
            ['id' => 12, 'webID' => 1567, 'website' => 'Instagram', 'price' => 1],
            ['id' => 13, 'webID' => 1574, 'website' => 'Linkedin', 'price' => 1.3],
            ['id' => 14, 'webID' => 1614, 'website' => 'Twitter', 'price' => 1.4],
            ['id' => 15, 'webID' => 1610, 'website' => 'Tiktok', 'price' => 1.3],
            ['id' => 16, 'webID' => 1599, 'website' => 'Snapchat', 'price' => 1.9],
            ['id' => 17, 'webID' => 7621, 'website' => 'Paxful', 'price' => 1.7],
            ['id' => 18, 'webID' => 4591, 'website' => 'Coinbase', 'price' => 1.7],
            ['id' => 19, 'webID' => 1585, 'website' => 'Netflix', 'price' => 1.7],
            ['id' => 20, 'webID' => 9573, 'website' => 'Revolut', 'price' => 2],
            ['id' => 21, 'webID' => 1601, 'website' => 'Steam', 'price' => 1.3],
            ['id' => 22, 'webID' => 4497, 'website' => 'Skrill', 'price' => 2],
            ['id' => 23, 'webID' => 1621, 'website' => 'Webmoney', 'price' => 1.3],
            ['id' => 24, 'webID' => 1556, 'website' => 'Fiverr', 'price' => 1],
            ['id' => 25, 'webID' => 1588, 'website' => 'Others', 'price' => 2],
        ]);
    }
}
