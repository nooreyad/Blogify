@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.leftSideBox')
        </div>
        <div class="col-6">
            @include('shared.successMessage')
            <div class="mt-3">
                @include('shared.userEditCard')
            </div>
            <hr>
            @forelse ($blogs as $blog)
                <div class="mt-3">
                    @include('shared.blogCard')
                </div>
            @empty
                <p class="text-center mt-4">No Results Found.</p>
            @endforelse
            <div class="mt-3">
                {{ $blogs->withQueryString()->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('shared.followBox')
        </div>
    </div>
@endsection
