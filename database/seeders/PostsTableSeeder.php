<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // creator id = 2 / 4
        $posts = [
            [
                'id' => 1,
                'name' => 'Tugas Laravel',
                'original_filename' => 'dummy-small.jpg',
                'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at velit in nisl vulputate cursus. Nunc mattis, massa nec lacinia feugiat, velit nisl aliquet nunc, ut viverra nisl massa in enim. Sed sollicitudin, nulla at tincidunt aliquam, nunc nulla pulvinar nunc, sed convallis leo nisl at nunc. Suspendisse potenti. Nulla facilisi.',
            ],
            [
                'id' => 2,
                'name' => 'Tugas React Native',
                'original_filename' => 'dummy-small.jpg',
                'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam nemo placeat error id consequatur nam quia ut eos perferendis consectetur, fugiat laboriosam pariatur. Quia sit rerum cumque autem voluptatibus, quae vel molestias eos minima reiciendis ea voluptatum aperiam molestiae hic cum, quidem debitis dolores quibusdam minus odio quisquam pariatur saepe. Odio aut possimus atque placeat dolorem, reiciendis necessitatibus, maxime corrupti ipsum quis nesciunt impedit error adipisci eum nihil, ducimus molestiae fugit. Eos reprehenderit illo facilis soluta iure, aperiam in deleniti deserunt id voluptatibus fuga quaerat modi molestiae consequatur nihil, quam veniam quo iusto corrupti quas sapiente, nisi suscipit. Nostrum, libero aliquid eligendi quisquam odio ducimus vero culpa, ea tempore magni atque omnis aspernatur. Ut placeat adipisci, molestias inventore sint soluta recusandae nulla quas quisquam alias maxime nostrum voluptates esse excepturi iure qui repellat aspernatur delectus quae suscipit ducimus facere expedita. Dolore debitis eos autem velit neque quis doloribus numquam exercitationem.'
            ],
            [
                'id' => 3,
                'name' => 'Tugas NodeJS',
                'original_filename' => 'dummy-small.jpg',
                'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam nemo placeat error id consequatur nam quia ut eos perferendis consectetur, fugiat laboriosam pariatur. Quia sit rerum cumque autem voluptatibus, quae vel molestias eos minima reiciendis ea voluptatum aperiam molestiae hic cum, quidem debitis dolores quibusdam minus odio quisquam pariatur saepe. Odio aut possimus atque placeat dolorem, reiciendis necessitatibus, maxime corrupti ipsum quis nesciunt impedit error adipisci eum nihil, ducimus molestiae fugit. Eos reprehenderit illo facilis soluta iure, aperiam in deleniti deserunt id voluptatibus fuga quaerat modi molestiae consequatur nihil, quam veniam quo iusto corrupti quas sapiente, nisi suscipit. Nostrum, libero aliquid eligendi quisquam odio ducimus vero culpa, ea tempore magni atque omnis aspernatur. Ut placeat adipisci, molestias inventore sint soluta recusandae nulla quas quisquam alias maxime nostrum voluptates esse excepturi iure qui repellat aspernatur delectus quae suscipit ducimus facere expedita. Dolore debitis eos autem velit neque quis doloribus numquam exercitationem.'
            ],
            [
                'id' => 4,
                'name' => 'Tugas NodeJS 2',
                'original_filename' => 'dummy-small.jpg',
                'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam nemo placeat error id consequatur nam quia ut eos perferendis consectetur, fugiat laboriosam pariatur.'
            ],
            [
                'id' => 5,
                'name' => 'Tugas Laravel 1',
                'original_filename' => 'dummy-small.jpg',
                'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam nemo placeat error id consequatur nam quia ut eos perferendis consectetur, fugiat laboriosam pariatur.'
            ],
            [
                'id' => 6,
                'name' => 'Tugas React JS 1',
                'original_filename' => 'dummy-small.jpg',
                'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam nemo placeat error id consequatur nam quia ut eos perferendis consectetur, fugiat laboriosam pariatur.'
            ],
            [
                'id' => 7,
                'name' => 'Tugas Python 1',
                'original_filename' => 'dummy-small.jpg',
                'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam nemo placeat error id consequatur nam quia ut eos perferendis consectetur, fugiat laboriosam pariatur.'
            ],
            [
                'id' => 8,
                'name' => 'Tugas Ruby on Rails 1',
                'original_filename' => 'dummy-small.jpg',
                'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam nemo placeat error id consequatur nam quia ut eos perferendis consectetur, fugiat laboriosam pariatur.'
            ],
            [
                'id' => 9,
                'name' => 'Tugas Vue JS 1',
                'original_filename' => 'dummy-small.jpg',
                'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam nemo placeat error id consequatur nam quia ut eos perferendis consectetur, fugiat laboriosam pariatur.'
            ],
            [
                'id' => 10,
                'name' => 'Tugas Laravel 2',
                'original_filename' => 'dummy-small.jpg',
                'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam nemo placeat error id consequatur nam quia ut eos perferendis consectetur, fugiat laboriosam pariatur.'
            ]
        ];

        foreach ($posts as $post) {
            // Generate random filename
            $randomFileName = Str::random(40) . '.jpg';

            // Menentukan path sumber dan path tujuan
            $sourcePath = public_path('post-seeder-images/' . $post['original_filename']);
            $destinationPath = public_path('storage/post-images/' . $randomFileName);

            // Cek apakah direktori post-images tersedia
            if (!File::isDirectory(public_path('storage/post-images'))) {
                File::makeDirectory(public_path('storage/post-images'), 0775, true);
            }

            // Cek apakah file ada
            if (File::exists($sourcePath)) {
            // Jika file ditemukan
                File::copy($sourcePath, $destinationPath);
            } else {
            // Jika file tidak ditemukan
                echo 'File not found' . $sourcePath . "\n";
                continue;
            }

            // Simpan data ke database
            Post::create([
                'id' => $post['id'],
                'title' => $post['name'],
                'slug' => Str::slug($post['name']),
                'post_image_path' => 'post-images/' . $randomFileName,
                'body' => $post['body'],
                'creator_id' => [2, 4][rand(0, 1)],
                'category_id' => [1, 2][rand(0, 1)],
                'company_id' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10][array_rand([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
