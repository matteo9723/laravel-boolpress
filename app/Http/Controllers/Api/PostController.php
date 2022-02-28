<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        $posts = Post::with([ 'category', 'tags'])->paginate(3);

        // trasformazione di tutti i percorsi immagine in percorsi assoluti
        // e generazione di un link a una immagine placeholder se non presente
        $posts->each(function($post){
            $post->cover = $this->makeImagePath($post->cover);
        });


        $tags = Tag::all();
        $categories = Category::all();

        return response()->json(compact('posts', 'tags', 'categories'));

    }


    // generazione json del singolo post in base allo slug
    public function show($slug){

        $post = Post::where('slug', $slug)->with(['category','tags'])->first();

        $post->cover = $this->makeImagePath($post->cover);

        if(!$post){
            $post = ['title' => 'Post non trovato', 'content' => ''];
        }

        return response()->json($post);

    }


    public function getPostsByCategory($slug_category){

        $category = Category::where('slug', $slug_category)->with('posts.tags')->first();

        $category->posts->each(function($post){
            $post->cover = $this->makeImagePath($post->cover);
        });

        $success = true;
        $error = '';
        if(!$category){
            $success = false;
            $error = 'Categoria inesistente';
        }elseif($category && count($category['posts']) === 0)
        {
            $success = false;
            $error = 'Non esistono post per questa categoria';
        }

        return response()->json(compact('success','category','error'));

    }

    public function getPostsByTag($slug_tag){

        $tag = Tag::where('slug', $slug_tag)->with('posts.category')->first();
        $tag->posts->each(function($post){
            $post->cover = $this->makeImagePath($post->cover);
        });
        $success = true;
        $error = '';

        if(!$tag){
            $success = false;
            $error = 'Tag insistente';
        }elseif($tag && count($tag['posts']) === 0){
            $success = false;
            $error = 'Non ci sono  post con questo tag';
        }

        return response()->json(compact('success', 'tag', 'error'));

    }


    private function makeImagePath($cover){
        if($cover){
            $cover = url('storage/' . $cover);
        }else{
            $cover = url('img/default-fallback-image.png');
        }
        return $cover;
    }

}
