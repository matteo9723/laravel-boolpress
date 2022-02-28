<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;

class UpdatePostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1 estraggo tutti i posts

        $posts = Post::all();

        // 2 estraggo random gli id della tabella in relazione
        foreach ($posts as $post) {
            $data = [
                'category_id' => Category::inRandomOrder()->first()->id
            ];

            // 3 eseguo l'update di ogni singolo post
            $post->update($data);
        }
    }
}
