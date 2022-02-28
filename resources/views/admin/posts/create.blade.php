@extends('layouts.admin')

@section('content')
<div class="container">
    <div>
        <h1>Nuovo post</h1>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input value="{{ old('title') }}" type="text"
                class="form-control @error('title') is-invalid @enderror" id="title"
                name="title" placeholder="titolo">
                @error('title')
                    <p>{{ $message }}</p>
                @enderror
              </div>

              <div class="mb-3">
                <label for="content" class="form-label">Contenuto post</label>
                <textarea
                class="form-control @error('content') is-invalid @enderror"
                id="content" name="content" rows="3">{{ old('content') }}</textarea>
                @error('content')
                    <p>{{ $message }}</p>
                @enderror
              </div>

              <div class="mb-3">
                <label for="category_id" class="form-label">Inserisci una categoria</label>
                <select
                    name="category_id" id="category_id"
                    class="form-control">
                    <option value="">Selezionare una categoria</option>

                    @foreach ($categories as $category)
                     <option
                        @if($category->id == old('category_id')) selected  @endif
                      value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach

                  </select>
              </div>

              <div class="mb-3">
                  <h5>Tag</h5>

                  @foreach ($tags as $tag)
                    <span class="d-inline-block mr-3">
                        <input type="checkbox"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            id="tag{{ $loop->iteration }}"
                            @if (in_array($tag->id, old('tags', [])))  checked   @endif
                            >
                        <label for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
                    </span>
                  @endforeach
              </div>

              <div class="mb-3">
                  <label for="cover">Immagine</label>
                  <input
                  class="form-control @error('cover') is-invalid @enderror"
                  type="file" name="cover" id="cover">
                  @error('cover')
                    <p>{{ $message }}</p>
                  @enderror
              </div>



              <button type="submit" class="btn btn-success">Invia</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
        </form>


    </div>

</div>
@endsection

@section('title')
    | Nuovo post
@endsection


