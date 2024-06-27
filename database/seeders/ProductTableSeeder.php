<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        $wines = [
            'Chardonnay', 'Sauvignon Blanc', 'Pinot Grigio', 'Riesling',
            'Cabernet Sauvignon', 'Merlot', 'Pinot Noir', 'Syrah',
            'Zinfandel', 'Malbec', 'Sangiovese', 'Nebbiolo',
            'Tempranillo', 'Grenache', 'Barbera', 'Chenin Blanc',
            'Gewürztraminer', 'Semillon', 'Moscato', 'Prosecco',
            'Champagne', 'Port', 'Sherry', 'Madeira', 'Marsala'
        ];

        foreach ($wines as $wine) {
            $category = Category::inRandomOrder()->first();
            Product::create([
                'name' => $wine,
                'description' => Str::limit('This is a brief description of ' . $wine) . '...',
                'price' => rand(10, 100),
                'category_id' => $category->id
            ]);
        }
    }
}
