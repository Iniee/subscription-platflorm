<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Website::create([
            'name' => 'Website One',
            'url' => 'https://website1.com'
        ]);

        Website::create([
            'name' => 'Test Website',
            'url' => 'https://test-website.com'
        ]);
    }
}