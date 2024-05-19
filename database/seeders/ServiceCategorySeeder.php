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
                'image' => '1521969345.jpg'
            ],
            [
                'name' => 'Beauty',
                'slug' => 'beauty',
                'image' => '1521969358.png'
            ],
            [
                'name' => 'Plumbing',
                'slug' => 'plumbing',
                'image' => '1521969409.jpg'
            ],
            [
                'name' => 'Electrical',
                'slug' => 'electrical',
                'image' => '1521969419.jpg'
            ],
            [
                'name' => 'Shower filter',
                'slug' => 'shower-filter',
                'image' => '1521969430.jpg'
            ],
            [
                'name' => 'Home cleaning',
                'slug' => 'home-cleaning',
                'image' => '1521969446.jpg'
            ],
            [
                'name' => 'Carpentry',
                'slug' => 'carpentry',
                'image' => '1521969454.jpg'
            ],
            [
                'name' => 'Pest control',
                'slug' => 'pest-controll',
                'image' => '1521969464.jpg'
            ],
            [
                'name' => 'Chimney Hob',
                'slug' => 'chimney hob',
                'image' => '1521969490.jpg'
            ],
            [
                'name' => 'Water Purifier',
                'slug' => 'water-purifier',
                'image' => '1521969512.jpg'
            ],
            [
                'name' => 'Computer repair',
                'slug' => 'computer repair',
                'image' => '1521969512.jpg'
            ],
            [
                'name' => 'TV',
                'slug' => 'tv',
                'image' => '1521969522.jpg'
            ],
            [
                'name' => 'Refrigerator',
                'slug' => 'refrigerator',
                'image' => '1521972593.jpg'
            ],
            [
                'name' => 'Geyser',
                'slug' => 'Geyser',
                'image' => '1521969558.jpg'
            ],
            [
                'name' => 'Car',
                'slug' => 'car',
                'image' => '1521969576.jpg'
            ],
            [
                'name' => 'Document',
                'slug' => 'document',
                'image' => '1521974355.jpg'
            ],
            [
                'name' => 'Movers & Packers',
                'slug' => 'movers-packers',
                'image' => '1521969599.jpg'
            ],
            [
                'name' => 'Laundry',
                'slug' => 'laundry',
                'image' => '1521972663.jpg'
            ],
            [
                'name' => 'Painting',
                'slug' => 'painting',
                'image' => '1521972643.jpg'
            ],

        ]);
    }
}
