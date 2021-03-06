@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('articles.update', ['article' => $article]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input
                type="text"
                class="form-control"
                name="title"
                value="{{ $article->title }}"
                placeholder="Enter your article's title"
                required
            >

            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="article_image">Image</label>
            <input
                type="file"
                class="form-control"
                name="article_image"
                accept="image/*"
            >

            @error('article_image')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea
                class="form-control"
                name="description"
                placeholder="What about your article?"
                required
            >{{ $article->description }}</textarea>

            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="body">Article</label>
            <textarea
                class="form-control"
                name="body"
                rows="3"
                placeholder="Wrtie your article ..."
                required
            >{{ $article->body }}</textarea>

            @error('body')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="categories[]">Category</label>
            <select multiple class="form-control" name="categories[]" required>
                @foreach ($categories as $category)
                    <option
                        @if ($article->categories->contains($category->id))
                            selected
                        @endif
                        value="{{ $category->id }}"
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Post</button>
        </div>
    </form>
</div>
@endsection
