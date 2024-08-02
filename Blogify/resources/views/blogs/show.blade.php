@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-3">
        @include('shared.leftSideBox')
    </div>
    <div class="col-6">
        @include('shared.successMessage')
        <div class="mt-3">
            @include('shared.blogCard')
        </div>
    </div>
    <div class="col-3">
        @include('shared.followBox')
    </div>
</div>
@endsection


