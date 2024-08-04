<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:1|max:150',
            'content' => 'required|min:1|max:2000'
        ]);

        Blog::create($validated);

        return redirect()->route('dashboard')->with('successful', 'Blog created successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('dashboard')->with('successful', 'Blog deleted successfully');
    }

    public function edit(Blog $blog)
    {
        $editing = true;
        return view('blogs.show', compact('blog', 'editing'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|min:1|max:150',
            'content' => 'required|min:1|max:2000'
        ]);

        $blog->update($validated);

        return redirect()->route('blogs.show', $blog->id)->with('successful', 'Blog updated successfully');
    }
}
