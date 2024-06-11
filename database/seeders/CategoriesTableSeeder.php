<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            ['id' => 1,
            'name' => 'Work From Home',
            'slug' => 'work-from-home',
            'created_at' => now(),
            'updated_at' => now()
            ],
            ['id' => 2,
            'name' => 'Work From Office',
            'slug' => 'work-from-office',
            'created_at' => now(),
            'updated_at' => now()
            ],
        ];

        Category::insert($category);
    }
}
