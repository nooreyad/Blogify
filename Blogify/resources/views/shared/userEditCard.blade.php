<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form enctype="multipart/form-data" method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('put')
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center mb-3 mb-md-0">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                        alt="{{ $user->getImageURL() }}">
                    <div>
                        <input name="name" value="{{ old('name', $user->name) }}" type="text"
                            class="form-control">
                        @error('name')
                            <span class="text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @auth
                    @if (Auth::id() === $user->id)
                        <div class="mt-2 mt-md-0">
                            <a href="{{ route('users.show', $user->id) }}" class="btn-link">View</a>
                        </div>
                    @endif
                @endauth
            </div>
            <div class="mt-4">
                <label for="image">Profile Picture</label>
                <input class="form-control" type="file" name="image">
                @error('image')
                    <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5">Bio:</h5>
                <div class="mb-3">
                    <textarea name="bio" class="form-control" id="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark btn-sm mb-3">Save</button>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#" class="fw-light nav-link fs-6"><span class="fas fa-user me-1"></span> 0
                        Followers</a>
                    <a href="#" class="fw-light nav-link fs-6"><span class="fas fa-brain me-1"></span>
                        {{ $user->blogs()->count() }}</a>
                    <a href="#" class="fw-light nav-link fs-6"><span class="fas fa-comment me-1"></span>
                        {{ $user->comments()->count() }}</a>
                </div>
            </div>
        </form>
    </div>
</div>
