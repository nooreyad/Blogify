<div class="row">
    <form action="{{ route('blogs.create') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <textarea name="title" class="form-control" id="title" rows="1"></textarea>
            @error('title')
                <span class="d-block fs-6 text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" class="form-control" id="content" rows="3"></textarea>
            @error('content')
                <span class="d-block fs-6 text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <button class="btn btn-dark" type="submit">Share</button>
        </div>
    </form>
</div>
