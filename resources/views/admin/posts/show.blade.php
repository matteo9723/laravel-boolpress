@extends('layouts.admin')

@section('content')
<div class="container">
    <div >
        <h1>{{ $post->title }}</h1>

        @if ($post->category)
         <h4>Categoria: {{ $post->category->name }}</h4>
        @endif

        {{-- ciclo i tag presenti e se non ci sono stamo il segno meno --}}
        @forelse ($post->tags as $tag)
           <span class="badge bg-info">{{ $tag->name }}</span>
        @empty

        @endforelse

        @if ($post->cover)
            <div class="img">
                <img width="800" src="{{ asset('storage/' . $post->cover ) }}" alt="{{ $post->title }}">
                <p>{{ $post->cover_original_name }}</p>
            </div>
        @endif


        <p>
            {{ $post->content }}
        </p>
    </div>
    <div class="row my-5">
        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-success mr-5">EDIT</a>
        <form onsubmit="return confirm('Confermi eliminazione post: {{$post->title}}')"
            action="{{ route('admin.posts.destroy', $post)}}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
    </div>
</div>
@endsection

@section('title')
    | {{ $post->title }}
@endsection


