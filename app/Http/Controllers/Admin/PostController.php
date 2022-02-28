<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // prendo tutti i posts
        $posts = Post::orderBy('id','desc')->paginate(5);

        // prendo tutte le categorie
        $categories = Category::all();



        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|max:255|min:2',
                'content' => 'required',
                'cover' => 'nullable|image|max:32000'
            ],
            [
                'title.required' => 'Il titolo è un campo obbligatorio',
                'title.max' => 'Il titolo deve essere lungo al massimo :max caratteri',
                'title.min' => 'Il titolo deve avere al minimo :min caratteri',
                'content.required' => 'Il contenuto è un campo obbligatorio',
                'cover.image' => 'Il file deve essere un\'immagine',
                'cover.max' => 'dimensione file troppo grande'
            ]
        );

        $data = $request->all();

        if(array_key_exists('cover', $data)){
            // prendere il nome originale dell'immagine
            $data['cover_original_name'] = $request->file('cover')->getClientOriginalName();
            // salvare l'immagine e prendere il percorso
            $image_path = Storage::put('uploads', $data['cover']);
            $data['cover'] = $image_path;
        };

        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = Post::generateSlug($new_post->title);

        $new_post->save();

        // verifico l'esistenza dell'array tags
        // se esiste esegue l'attach (da fare dopo il ->save())
        if(array_key_exists('tags', $data)){
            $new_post->tags()->attach($data['tags']);
        }


        return redirect()->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post){
            return view('admin.posts.show', compact('post'));
        }
        abort(404, 'Errore nella ricerca del post');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        if($post){
             return  view('admin.posts.edit', compact('post', 'categories', 'tags'));
        }

        abort(404, 'Post non presente del database');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate(
            [
                'title' => 'required|max:255|min:2',
                'content' => 'required',
                'cover' => 'nullable|image|max:32000'
            ],
            [
                'title.required' => 'Il titolo è un campo obbligatorio',
                'title.max' => 'Il titolo deve essere lungo al massimo :max caratteri',
                'title.min' => 'Il titolo deve avere al minimo :min caratteri',
                'content.required' => 'Il contenuto è un campo obbligatorio',
                'cover.image' => 'Il file deve essere un\'immagine',
                'cover.max' => 'dimensione file troppo grande'
            ]
        );

        $form_data = $request->all();

        if(array_key_exists('cover', $form_data)){
            // eliminare la vecchia immagine (se esiste)
            if($post->cover){
                Storage::delete($post->cover);
            }
            // prendere il nome originale della nuova immagine
            $form_data['cover_original_name'] = $request->file('cover')->getClientOriginalName();
            // salvare l'immagine caricata e prendere il percorso da fillare
            $img_path = Storage::put('uploads', $form_data['cover']);
            $form_data['cover'] = $img_path;
        }


        // se è cambiato il titolo genero un nuovo slug
        if($form_data['title'] != $post->title  ){
            $form_data['slug'] = Post::generateSlug($form_data['title']);
        }

        $post->update($form_data);

        if(array_key_exists('tags', $form_data)){
            // sync sostituisce tutte le relazioni con quelle che vengono passate come parametro
            $post->tags()->sync($form_data['tags']);
        }else{
            // se non viene inviato nessun tag devo cancellare tutte le relazioni
            //$post->tags()->sync([]); ha la stessa funzione di detach
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show',$post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // se c'è un'immagine la elimino
        if($post->cover){
            Storage::delete($post->cover);
        }

        // non faccio il detach con tags perché ho settato onDelete('cascade')
        // se non l'avessi fatto, prima di delete devo fare detach

        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', 'Post eliminato correttamente');
    }
}
