<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1,
            'name' => 'Admin',
            'slug' => 'admin',
            ],
            ['id' => 2,
            'name' => 'Creator',
            'slug' => 'creator'
            ],
            ['id' => 3,
            'name' => 'Public',
            'slug' => 'public'
            ],
        ];

        Role::insert($roles);
    }
}
