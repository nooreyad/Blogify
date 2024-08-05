<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $blog->user->getImageURL() }}"
                    alt="{{ $blog->user->name }}">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $blog->user->id) }}">
                            {{ $blog->user->name }}
                        </a></h5>
                </div>
            </div>
            <div class="d-flex">
                <a href="{{ route('blogs.show', $blog->id) }}"> View </a>
                @auth()
                    <a class="mx-2" href="{{ route('blogs.edit', $blog->id) }}"> Edit </a>
                    <form method="POST" action="{{ route('blogs.destroy', $blog->id) }}">
                        @csrf
                        @method('delete')
                        <button class="ms-1 btn btn-danger btn-sm"> X </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form enctype="multipart/form-data" action="{{ route('blogs.update', $blog->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name="title" class="form-control" id="title" rows="1">{{ $blog->title }}</textarea>
                    @error('title')
                        <span class="d-block fs-6 text-danger">{{ $message }}</span>
                    @enderror
                    <br>
                    <textarea name="content" class="form-control" id="content" rows="3">{{ $blog->content }}</textarea>
                    @error('content')
                        <span class="d-block fs-6 text-danger">{{ $message }}</span>
                    @enderror
                    <div class="mt-4">
                        <input class="form-control" type="file" name="image">
                        @error('image')
                            <span class="text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark mb-2 btn-sm">Update</button>
                </div>
            </form>
        @else
            <div class="d-flex">
                <img style="width:300px" class="me-3 avatar-sm" src="{{ $blog->getImageURL() }}" alt="Thumbnail">
                <div>
                    <h5>{{ $blog->title }}</h5>
                    <p class="fs-6 fw-light text-muted">
                        {{ $blog->content }}
                    </p>
                </div>
            </div>
        @endif

        <div class="d-flex justify-content-between">
            <div>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1"></span> 100 </a>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $blog->created_at->diffForHumans() }} </span>
            </div>
        </div>
        @include('shared.commentsBox')
    </div>
</div>
