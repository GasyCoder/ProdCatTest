<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Smartphones',
                'slug' => 'smartphones'
            ],
            [
                'name' => 'Ordinateurs Portables',
                'slug' => 'ordinateurs-portables'
            ],
            [
                'name' => 'Accessoires',
                'slug' => 'accessoires'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}