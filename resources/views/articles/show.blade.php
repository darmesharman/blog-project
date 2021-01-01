@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
        <h5 class="h3 text-center font-weight-bold">{{ $article->title }}</h5>
        <img src="{{ asset($article->image) }}" class="card-img-top _resize" alt="...">
        <div class="card-body">
            <p class="card-text">{{ $article->body }}</p>
            <p class="card-text text-right"><small class="text-muted">Author: {{ $article->user->name }}</small></p>
            @if ($article->created_at != $article->updated_at)
                <p class="card-text text-right"><small class="text-muted">Last updated: {{ $article->updated_at }}</small></p>
            @endif
            <p class="card-text text-right"><small class="text-muted">Posted: {{ $article->created_at }}</small></p>
        </div>
        <div class="card-footer text-center">
            @foreach ($article->categories as $category)
                <a href="{{ route('articles.index', ['category' => $category->id]) }}" class="bg-primary px-2 rounded text-white text-lowercase">{{ $category->name }}</a>
            @endforeach
        </div>
        <div class="text-right">
            <a href="{{ route('articles.show', ['article' => $article ]) }}" class="btn btn-outline-primary border-0">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-left-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    <path fill-rule="evenodd" d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                </svg>
                {{ $article->num_of_comments }}
            </a>
        </div>
    </div>

    @include('comments.index')
</div>
@endsection
