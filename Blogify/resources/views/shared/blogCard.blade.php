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
            <div>
                <form method="POST" action="{{route('blogs.destroy', $blog->id)}}">
                    @csrf
                    <a class="mx-2" href="{{route('blogs.edit', $blog->id)}}">Edit</a>
                    <a href="{{route('blogs.show', $blog->id)}}">View</a>
                    @method('delete')
                    <button class="btn btn-danger btn-sm ms-2">Delete</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <h5> {{$blog->title}} </h5>
        @if ($editing ?? false)
            <form action="{{route('blogs.update', $blog->id)}}", method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
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
        <div>
            <div class="mb-3">
                <textarea class="fs-6 form-control" rows="1"></textarea>
            </div>
            <div>
                <button class="btn btn-primary btn-sm"> Post Comment </button>
            </div>

            <hr>
            <div class="d-flex align-items-start">
                <img style="width:35px" class="me-2 avatar-sm rounded-circle"
                    src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Luigi"
                    alt="Luigi Avatar">
                <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <h6 class="">Luigi
                        </h6>
                        <small class="fs-6 fw-light text-muted"> {{$blog->created_at}}</small>
                    </div>
                    <p class="fs-6 mt-3 fw-light">
                        {{$blog->comments}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
