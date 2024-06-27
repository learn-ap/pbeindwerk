<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Red',
            'White',
            'Rosé',
            'Sparkling',
            'Dessert',
            'Fortified'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
