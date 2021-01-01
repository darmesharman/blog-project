<div id="comments">
    @include('comments.create')

    @foreach ($article->comments->sortByDesc('created_at') as $comment)
        <div class="card mb-1">
            <div class="card-header">
                {{ $comment->user->name }}
            </div>
            <div class="card-body">
                <p class="card-text">
                    {{ $comment->body }}
                </p>
            </div>

            <div class="d-flex justify-content-end">
                @can('update', $comment)
                    <form action="{{ route('comments.edit', ['comment' => $comment]) }}" method="GET">
                        @csrf

                        <button class="btn btn-outline-primary m-1 py-1 px-2">Edit</button>
                    </form>
                @endcan

                @can('delete', $comment)
                    <form action="{{ route('comments.destroy', ['comment' => $comment]) }}" method="POST">
                        @csrf
                        @method('delete')

                        <button class="btn btn-outline-danger m-1 py-1 px-2">Delete</button>
                    </form>
                @endcan

            </div>
        </div>
    @endforeach
</div>
