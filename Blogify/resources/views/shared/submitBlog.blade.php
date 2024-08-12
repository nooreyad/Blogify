@auth
    <div class="card">
        <div class="card-body">
            <h4> Share your blogs </h4>
            <div class="row">
                <form enctype="multipart/form-data" method="POST" id="blogForm">
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
                    <label for="tags" class="mb-2">Tags</label>
                    <div class="mb-3">
                        <select id="tags" name="tags[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500
                                focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                dark:text-white dark:focus:ring-gray-500 dark:focus:border-gary-500"
                            multiple>
                            @foreach (App\Models\Tag::all() as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button onclick="submitBlog()" class="btn btn-dark" type="button">Share</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endauth

@guest
    <div class="card">
        <div class="card-body">
            <h4> Register and Login to share your blogs </h4>
        </div>
    </div>
@endguest


<script>
function submitBlog() {
    event.preventDefault();
    let formData = new FormData(document.getElementById('blogForm'));
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        if (this.status === 200) {
            // Append the new blog to the blog list
            document.querySelector("[data-container='blog-list']").insertAdjacentHTML('afterbegin', this.responseText);
            document.getElementById('blogForm').reset();
        } else {
            console.log('Error:', this.statusText);
        }
    }
    xhttp.open("POST", "{{ route('blogs.create') }}", true);
    xhttp.send(formData);
}
</script>

