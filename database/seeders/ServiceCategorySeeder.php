<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data into service_categories table
        DB::table('service_categories')->insert([
            [
                'name' => 'AC',
                'slug' => 'ac',
                'image' => ''
            ]
        ]);
    }
}
