<div data-container="blog-list">
    @forelse ($blogs as $blog)
        <div class="mt-3">
            @include('shared.blogCard', ['blog' => $blog])
        </div>
    @empty
        <p class="text-center mt-4">No Results Found.</p>
    @endforelse
    <div class="mt-3">
        {{ $blogs->withQueryString()->links() }}
    </div>
</div>
