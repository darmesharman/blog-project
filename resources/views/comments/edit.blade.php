@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('comments.update', ['comment' => $comment ]) }}" class="form-row">
        @csrf
        @method('PUT')

        <label for="body">Edit your comment</label>
        <div class="col-11">
            <input type="text" name="body" class="form-control" value="{{ $comment->body }}" placeholder="Write a comment..." required>
        </div>
        <div class="col-1">
            <button type="submit" class="btn btn-primary">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up-right-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.879 10.828a.5.5 0 1 1-.707-.707l4.096-4.096H6.5a.5.5 0 0 1 0-1h3.975a.5.5 0 0 1 .5.5V9.5a.5.5 0 0 1-1 0V6.732l-4.096 4.096z"/>
                </svg>
            </button>
        </div>

        @error('body')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </form>
</div>

@endsection

