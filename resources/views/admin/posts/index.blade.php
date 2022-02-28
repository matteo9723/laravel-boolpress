@extends('layouts.admin')

@section('content')
<div class="container">
    <div >
        <h1>Elenco posts</h1>
        @if (session('deleted'))
            <div class="alert alert-success" role="alert">
                 {{ session('deleted') }}
            </div>
        @endif
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col" >Titolo</th>
                <th scope="col" >Tag</th>
                <th scope="col" colspan="4">Categoria</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post )
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>

                            {{-- ciclo i tag presenti e se non ci sono stamo il segno meno --}}
                            @forelse ($post->tags as $tag)
                              <span class="badge bg-info">{{ $tag->name }}</span>
                            @empty
                                -
                            @endforelse

                        </td>
                        <td>
                            {{-- devo controllare l'esistenza della relazione altrimenti genera un errore --}}
                            @if ($post->category)
                                {{ $post->category->name }}
                            @else
                                -
                            @endif

                        </td>
                        <td><a href="{{ route('admin.posts.show', $post) }}" class="btn btn-info">SHOW</a></td>
                        <td><a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-success">EDIT</a></td>
                        <td>
                            <form onsubmit="return confirm('Confermi eliminazione post: {{$post->title}}')"
                            action="{{ route('admin.posts.destroy', $post)}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach


            </tbody>
          </table>
          {{ $posts->links() }}
    </div>
    <div>
        @foreach ($categories as $category )

            <h2>{{ $category->name }}</h2>
                <ul>

                    @forelse ($category->posts as $post_category)
                        <li>
                            <a href="{{ route('admin.posts.show', $post_category ) }}">{{ $post_category->title }}</a>
                        </li>
                    @empty
                        <li>Nessun post presente</li>
                    @endforelse

                </ul>
        @endforeach

    </div>
</div>
@endsection

@section('title')
    | Elenco post
@endsection


