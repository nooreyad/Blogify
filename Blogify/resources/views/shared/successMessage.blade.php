@if (session()->has('successful'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('successful') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

