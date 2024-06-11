<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = [
            ['id' => 1,
            'name' => 'Dinoco',
            'slug' => 'dinoco',
            'created_at' => now(),
            'updated_at' => now()
            ],
            ['id' => 2,
            'name' => 'Uniliver',
            'slug' => 'uniliver',
            'created_at' => now(),
            'updated_at' => now()
            ],
            ['id' => 3,
            'name' => 'Motorola',
            'slug' => 'motorola',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Apple',
                'slug' => 'apple',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Google',
                'slug' => 'google',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'name' => 'Samsung',
                'slug' => 'samsung',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'name' => 'Nokia',
                'slug' => 'nokia',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'name' => 'Xiaomi',
                'slug' => 'xiaomi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'name' => 'OnePlus',
                'slug' => 'oneplus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'name' => 'Sony',
                'slug' => 'sony',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Company::insert($company);
    }
}
