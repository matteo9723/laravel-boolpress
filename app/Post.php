<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    protected $fillable = ['title', 'content', 'slug', 'category_id', 'cover', 'cover_original_name'];


    // pe sapere a che categoria appartiene il post lo ottengo con questa sintassi:
    // $post->category ricavata dalla funzione:

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function tags(){

        return $this->belongsToMany('App\Tag');

    }

    public static function generateSlug($title){

        // genero lo slug
        $slug = Str::slug($title);
        $slug_base = $slug;

        // verifico se è presente nel db
        // SELECT * FROM posts WHERE slug = $slug ->first restituise solo il primo risultato in un oggetto
        $post_presente = Post::where('slug',$slug)->first();

        // se è presente concateno allo slug un contatore
        $c = 1;
        while($post_presente){
            $slug = $slug_base . '-' . $c;
            $c++;
            $post_presente = Post::where('slug',$slug)->first();
        }

        return $slug;

    }

}
