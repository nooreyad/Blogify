@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.leftSideBox')
        </div>
        <div class="col-6">
            @include('shared.successMessage')
            @include('shared.submitBlog')
            <hr>
            @include('shared.allBlogs')
        </div>
        <div class="col-3">
            @include('shared.searchBar')
            @include('shared.followBox')
        </div>
    </div>
@endsection
