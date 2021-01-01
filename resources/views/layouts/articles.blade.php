@foreach ($articles as $article)
    <div class="card mb-0">
        @if ($article->user->id === Auth::id())
            <h6 class="card-header text-white bg-gradient-primary text-right">Your article</h6>
        @else
            <h6 class="card-header text-muted text-right">Author: {{ $article->user->name }}</h6>
        @endif
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset($article->image) }}" class="card-img" alt="...">
                <div class="d-none d-md-block">
                </div>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <a href="{{ route('articles.show', ['article' => $article]) }}" class="card-title h5">{{ $article->title }}</a>
                    <p class="card-text">{{ $article->description }}</p>
                <div class="text-right p-0 mb-1 mr-1">
                    @foreach ($article->categories as $category)
                        <a href="{{ route('articles.index', ['category' => $category->id]) }}" class="bg-primary px-2 rounded text-white text-lowercase">{{ $category->name }}</a>
                    @endforeach
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gradient-light border text-right mt-0 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex">
                @can('update', $article)
                    <form action="{{ route('articles.edit', ['article' => $article]) }}" method="GET">
                        @csrf

                        <button class="btn btn-primary m-1">Edit</button>
                    </form>
                @endcan

                @can('delete', $article)
                    <form action="{{ route('articles.destroy', ['article' => $article]) }}" method="POST">
                        @csrf
                        @method('delete')

                        <button class="btn btn-danger m-1">Delete</button>
                    </form>
                @endcan
            </div>
            <div class="mx-3 my-2">
                <a href="{{ route('articles.show', ['article' => $article ]) }}" class="hover-text-decoration-none">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat-left-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path fill-rule="evenodd" d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    {{ $article->num_of_comments }}
                </a>
            </div>
        </div>
    </div>
@endforeach
