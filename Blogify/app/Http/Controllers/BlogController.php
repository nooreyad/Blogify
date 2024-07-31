<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function store(){
        $blog = Blog::create([
            'title' => 'title of testing blog',
            'content' => request()->get('blog', ''),
            'tags' => 'add dummy tags',
            'comments' => 'dummy comment content'
        ]);
        $blog->save();
        return redirect()->route('dashboard');
    }
}
