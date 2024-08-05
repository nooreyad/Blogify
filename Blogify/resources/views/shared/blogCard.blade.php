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
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500
                        focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                         dark:text-white dark:focus:ring-gray-500 dark:focus:border-gary-500"
                            multiple>
                            @foreach (App\Models\Tag::all() as $tag)
                                <option value="{{ $tag->id }} @selected($blog->tags->contains($tag->id))">{{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark mb-2 btn-sm">Update</button>
                </div>
            </form>
        @else
            <div class="d-flex">
                <img style="width:300px" class="me-3 avatar-sm d-flex" src="{{ $blog->getImageURL() }}"
                    alt="Thumbnail">
                <div>
                    <h5>{{ $blog->title }}</h5>
                    <p class="fs-6 fw-light text-muted">
                        {{ $blog->content }}
                    </p>
                    @forelse ($blog->tags as $tag)
                        #{{ $tag->name }}
                    @empty
                    @endforelse
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
