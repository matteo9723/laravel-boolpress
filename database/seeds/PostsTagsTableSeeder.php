<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) {
            // estraggo random un post
            $post = Post::inRandomOrder()->first();
            // estraggo random un ID di un tag
            $tag_id = Tag::inRandomOrder()->first()->id;
            // inserisco in dato nella tabella ponte
            $post->tags()->attach($tag_id);
        }
    }
}
