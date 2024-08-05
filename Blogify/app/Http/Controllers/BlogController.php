<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function show(Blog $blog)
    {
        $tags = Tag::all();
        return view('blogs.show', compact('blog'));
    }

    public function store(Request $request)
    {
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

        return redirect()->route('dashboard')->with('successful', 'Blog created successfully');
    }

    public function destroy(Blog $blog)
    {
        if (auth()->id() !== $blog->user_id) {
            abort(404);
        }

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->tags()->detach();

        $blog->delete();

        return redirect()->route('dashboard')->with('successful', 'Blog deleted successfully');
    }

    public function edit(Blog $blog)
    {
        if (auth()->id() !== $blog->user_id) {
            abort(404);
        }
        $tags = Tag::all();

        $editing = true;
        return view('blogs.show', compact('blog', 'editing', 'tags'));
    }

    public function update(Request $request, Blog $blog)
    {
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
