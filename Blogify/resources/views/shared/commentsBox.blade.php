<div>
    <form action="{{ route('blogs.comments.store', $blog->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="content" class="fs-6 form-control" rows="1" placeholder="Write a comment..."></textarea>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>
        </div>
    </form>
    @foreach ($blog->comments as $comment)
        <div class="d-flex align-items-start mb-2 mt-2">
            <img style="width:35px" class="me-2 avatar-sm rounded-circle" src="{{ $comment->user->getImageURL() }}"
                alt="{{ $comment->user->name }}">
            <div class="w-100 text-truncate">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-1">{{ $comment->user->name }}</h6>
                    <small class="fs-6 fw-light text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <div>
                    <p class="fs-6 mt-1 fw-light mb-0 text-truncate">{{ $comment->content }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
