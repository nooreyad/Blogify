<div class="row">
    <form action="{{route('blogs.create')}}", method="POST">
        @csrf
    <div class="mb-3">
        <textarea name = 'content' class="form-control" id="content" rows="3"></textarea>
        @error('blog')
            <span class="d-block fs-6 text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="">
        <button class="btn btn-dark " type="submit"> Share </button>
    </div>
    </form>
</div>
