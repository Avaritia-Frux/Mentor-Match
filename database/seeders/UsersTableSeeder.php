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
                'name' => 'Joko Hermano',
                'email' => 'jokohermano@gmail.com',
                'username' => 'joko-hermano',
                'role_id' => 1,
                'password' => 'joko-hermano123',
                'original_filename' => 'black-cat.jpeg',
            ],
            [
                'id' => 2,
                'name' => 'Harun',
                'email' => 'harun@gmail.com',
                'role_id' => 2,
                'username' => 'harun',
                'password' => 'harunharun123',
                'original_filename' => 'black-cat.jpeg',
            ],
            [
                'id' => 3,
                'name' => 'Nurdin',
                'email' => 'nurdin@gmail.com',
                'role_id' => 3,
                'username' => 'nurdin',
                'password' => 'nurdin123',
                'original_filename' => 'black-cat.jpeg',
            ],
            [
                'id' => 4,
                'name' => 'Koratan',
                'email' => 'koratan@gmail.com',
                'role_id' => 2,
                'username' => 'koratan',
                'password' => 'koratan123',
                'original_filename' => 'black-cat.jpeg',
            ],
            [
                'id' => 5,
                'name'=> 'Rinson',
                'email' => 'rinson@gmail.com',
                'role_id' => 3,
                'username' => 'rinson',
                'password' => 'rinson123',
                'original_filename' => 'black-cat.jpeg',
            ]
        ];

        foreach ($users as $user) {
            $randomFilename = Str::random(40) . '.jpg';

            // Tentukan path sumber dan tujuan
            $sourcePath = public_path('profile-images/' . $user['original_filename']);
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
                'username' => $user['username'],
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
