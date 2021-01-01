@extends('layouts.app')

@section('content')
<div class="container">
    @include('categories.index')

    <hr>

    @include('layouts.filters')

    @include('layouts.articles')
</div>
@endsection
