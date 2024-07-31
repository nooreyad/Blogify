<div class="row">
    <form action="{{route('blog.create')}}", method="POST">
        @csrf
    <div class="mb-3">
        <textarea name = 'blog' class="form-control" id="idea" rows="3"></textarea>
    </div>
    <div class="">
        <button class="btn btn-dark"> Share </button>
    </div>
    </form>
</div>
