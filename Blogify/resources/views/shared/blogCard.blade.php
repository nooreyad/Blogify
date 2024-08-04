<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario" alt="Mario Avatar">
                <div>
                    <h5 class="card-title mb-0"><a href="#"> Mario
                        </a></h5>
                </div>
            </div>
            <div class="d-flex">
                <a href="{{ route('blogs.show', $blog->id) }}"> View </a>
                <a class="mx-2" href="{{ route('blogs.edit', $blog->id) }}"> Edit </a>
                <form method="POST" action="{{ route('blogs.destroy', $blog->id) }}">
                    @csrf
                    @method('delete')
                    <button class="ms-1 btn btn-danger btn-sm"> X </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{route('blogs.update', $blog->id)}}", method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="title" class="form-control" id="title" rows="1">{{$blog->title}}</textarea>
                    @error('title')
                        <span class="d-block fs-6 text-danger">{{ $message }}</span>
                    @enderror
                    <br>
                    <textarea name = 'content' class="form-control" id="content" rows="3"> {{ $blog->content }} </textarea>
                    @error('content')
                        <span class="d-block fs-6 text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark mb-2 btn-sm">Update</button>
                </div>
            </form>
        @else
            <h5> {{$blog->title}} </h5>
            <p class="fs-6 fw-light text-muted">
                {{$blog->content}}
            </p>
        @endif

        <div class="d-flex justify-content-between">
            <div>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span> 100 </a>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                {{$blog->created_at->diffForHumans()}} </span>
            </div>
        </div>
        @include('shared.commentsBox')
    </div>
</div>
