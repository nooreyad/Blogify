<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <div class="d-flex align-items-center mb-3 mb-md-0">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $blog->user->getImageURL() }}"
                    alt="{{ $blog->user->name }}">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $blog->user->id) }}">
                            {{ $blog->user->name }}
                        </a></h5>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('blogs.show', $blog->id) }} " class="btn-link">View</a>
                @auth
                @if (Auth::id() === $blog->user->id)
                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn-link">Edit</a>
                <form id="delete-blog-form-{{ $blog->id }}" data-blog-id="{{ $blog->id }}" method="POST" action="{{ route('blogs.destroy', $blog->id) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">X</button>
                </form>
                @endif

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
                    <label class="mb-2" for="title">Title</label>
                    <textarea name="title" class="form-control" id="title" rows="1">{{ $blog->title }}</textarea>
                    @error('title')
                        <span class="d-block fs-6 text-danger">{{ $message }}</span>
                    @enderror
                    <label for="content" class="mb-2 mt-3">Content</label>
                    <textarea name="content" class="form-control" id="content" rows="3">{{ $blog->content }}</textarea>
                    @error('content')
                        <span class="d-block fs-6 text-danger">{{ $message }}</span>
                    @enderror
                    <div>
                        <label for="image" class="mb-2 mt-3">Thumbnail</label>
                        <input class="form-control" type="file" name="image">
                        @error('image')
                            <span class="text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <label for="tags" class="mb-2 mt-3">Tags</label>
                    <div class="mb-3">
                        <select name="tags[]" id="tags"
                            class="form-select"
                            multiple>
                            @foreach (App\Models\Tag::all() as $tag)
                                <option value="{{ $tag->id }}" @selected($blog->tags->contains($tag->id))>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-dark mb-2 btn-sm">Update</button>
                </div>
            </form>
        @else
            <div class="row">
                <div class="col-md-4">
                    <img style="width:100%" class="avatar-sm d-flex" src="{{ $blog->getImageURL() }}" alt="Thumbnail">
                </div>
                <div class="col-md-8">
                    <h5>{{ $blog->title }}</h5>
                    <p class="fs-6 fw-light text-muted">{{ $blog->content }}</p>
                    @forelse ($blog->tags as $tag)
                        <span class="badge bg-secondary">#{{ $tag->name }}</span>
                    @empty
                        <span class="text-muted">No tags</span>
                    @endforelse
                </div>
            </div>
        @endif

        <div class="d-flex justify-content-between mt-3">
            <div>
                <a href="#" class="fw-light nav-link fs-6"><span class="fas fa-heart me-1"></span> 100</a>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"><span class="fas fa-clock"></span>
                    {{ $blog->created_at->diffForHumans() }}</span>
            </div>
        </div>
        @include('shared.commentsBox')
    </div>
</div>
