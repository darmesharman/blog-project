@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input
                type="text"
                class="form-control"
                name="title"
                value="{{ old('title') }}"
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
                required
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
            >{{ old('description') }}</textarea>

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
            >{{ old('body') }}</textarea>

            @error('body')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="categories[]">Categories</label>
            <select multiple class="form-control" name="categories[]" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            @error('categories[]')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Post</button>
        </div>
    </form>
</div>

@endsection
