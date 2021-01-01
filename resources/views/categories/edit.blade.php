@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('categories.update', ['category' => $category ]) }}" class="form-row">
        @csrf
        @method('PUT')

        <label for="body">Edit category</label>
        <div class="col-11">
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" placeholder="category name" required>
        </div>
        <div class="col-1">
            <button type="submit" class="btn btn-primary">
                Edit
            </button>
        </div>

        @error('body')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </form>
</div>

@endsection

