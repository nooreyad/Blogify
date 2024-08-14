<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function show(Request $request) {
        $blogsQuery = Blog::orderBy('created_at', 'DESC');

        if ($request->has('search')) {
            $searchTerm = '%' . $request->get('search', '') . '%';
            $blogsQuery->where(function($query) use ($searchTerm) {
                $query->where('content', 'like', $searchTerm)
                      ->orWhere('title', 'like', $searchTerm);
            });
        }

        $blogs = $blogsQuery->get();
        return response()->json($blogs);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|min:1|max:150',
            'content' => 'required|min:1|max:2000',
            'image' => 'required|image',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $validated['user_id'] = auth()->id();

        $blog = Blog::create($validated);
        if ($request->has('tags')) {
            $blog->tags()->attach($request->tags);
        }

        return response()->json($blog);
    }

    public function delete(Blog $blog) {

        $user = User::findorFail(auth()->id());

        if ($user->role_id !== 1 && auth()->id() !== $blog->user_id) {
            return response()->json(['error' => "Unauthorized Access"]);
        }

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->tags()->detach();

        $blog->delete();

        return response()->json(['message' => 'successful deletion']);
    }

    public function edit(Request $request, $id) {

        $blog = Blog::findOrFail($id);

        if (!$blog) {
            return response()->json(['error' => 'Blog not found'], 404);
        }

        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        if ($user->id !== $blog->user_id){
            return response()->json(['error' => 'Unauthorized Access'], 403);
        }


        $validated = $request->validate([
            'title' => 'required|min:1|max:150',
            'content' => 'required|min:1|max:2000',
            'image' => 'image|nullable',
            'tags' => 'array|nullable',
            'tags.*' => 'exists:tags,id'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');

            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
        }

        $blog->update($validated);

        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        }

        return response()->json($blog);
    }

    public function update(Request $request, Blog $blog){
        if (auth()->id() !== $blog->user_id) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|min:1|max:150',
            'content' => 'required|min:1|max:2000',
            'image' => 'image|nullable',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');

            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
        }

        $blog->update($validated);
        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        }

        return redirect()
            ->route('blogs.show', $blog->id)
            ->with('successful', 'Blog updated successfully');
    }
}
