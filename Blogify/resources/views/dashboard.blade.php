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
            @forelse ($blogs as $blog)
                <div class="mt-3">
                    @include('shared.blogCard')
                </div>
            @empty
                <p class="text-center mt-4">No Results Found.</p>
            @endforelse
            <div class="mt-3">
                {{ $blogs->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('shared.searchBar')
            @include('shared.followBox')
        </div>
    </div>
@endsection
