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
            'created_at' => now(),
            'updated_at' => now()
            ],
            ['id' => 2,
            'name' => 'Creator',
            'slug' => 'creator',
            'created_at' => now(),
            'updated_at' => now()
            ],
            ['id' => 3,
            'name' => 'Public',
            'slug' => 'public',
            'created_at' => now(),
            'updated_at' => now()
            ],
        ];

        Role::insert($roles);
    }
}
