@auth
    <div class="card">
        <div class="card-body">
            <h4> Share your blogs </h4>
            <div class="row">
                <form action="{{ route('blogs.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <textarea name="title" class="form-control" id="title" rows="1">{{ $blog->title ?? '' }}</textarea>
                        @error('title')
                            <span class="d-block fs-6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" class="form-control" id="content" rows="3">{{ $blog->content ?? '' }}</textarea>
                        @error('content')
                            <span class="d-block fs-6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-2" for="image">Thumbnail</label>
                        <input class="form-control" type="file" name="image">
                        @error('image')
                            <span class="text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-dark" type="submit">Share</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endauth

@guest
    <div class="card">
        <div class="card-body">
            <h4> Login to share your blogs </h4>
        </div>
    </div>
@endguest
