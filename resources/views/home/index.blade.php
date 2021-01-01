@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5>My articles</h5>
    </div>

    @include('layouts.articles')
</div>
@endsection
