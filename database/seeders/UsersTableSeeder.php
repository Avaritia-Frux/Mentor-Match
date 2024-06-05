<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Role id list :
        1 = admin
        2 = creator
        3 = public
        */
        $users = [
            [
                'id' => 1,
                'name' => '',
                'email' => '@gmail.com',
                'slug' => '',
                'role_id' => 1,
                'password' => '',
                'original_filename' => 'aka.jpg',
            ],
            [
                'id' => 2,
                'name' => '',
                'email' => '@gmail.com',
                'role_id' => 2,
                'slug' => '',
                'password' => '',
                'original_filename' => '.jpg',
            ],
            [
                'id' => 3,
                'name' => '',
                'email' => '@gmail.com',
                'role_id' => 3,
                'slug' => '',
                'password' => '',
                'original_filename' => '.jpg',
            ],
            [
                'id' => 4,
                'name' => '',
                'email' => '@gmail.com',
                'role_id' => 2,
                'slug' => '',
                'password' => '',
                'original_filename' => '.jpg',
            ],
            [
                'id' => 5,
                'name'=> '',
                'email' => '@gmail.com',
                'role_id' => 3,
                'slug' => '',
                'password' => '',
                'original_filename' => '.jpg',
            ]
        ];

        foreach ($users as $user) {
            $randomFilename = Str::random(40) . '.jpg';

            // Tentukan path sumber dan tujuan
            $sourcePath = public_path('images/' . $user['original_filename']);
            $destinationPath = public_path('storage/profile-photos/' . $randomFilename);

            // Pastikan direktori tujuan ada
            if (!File::isDirectory(public_path('storage/profile-photos'))) {
                File::makeDirectory(public_path('storage/profile-photos'), 0755, true);
            }

            // Pindahkan file ke lokasi baru dengan nama acak
            if (File::exists($sourcePath)) {
                File::copy($sourcePath, $destinationPath);
            } else {
                // Handle the case when the source file doesn't exist
                echo "Source file does not exist: " . $sourcePath . "\n";
                continue;
            }

            // Buat user dengan data yang ditentukan dan password yang di-hash
            User::create([
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role_id' => $user['role_id'],
                'slug' => $user['slug'],
                'profile_photo_path' => 'profile-photos/' . $randomFilename,
                'email_verified_at' => now(),
                'password' => Hash::make($user['password']),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
