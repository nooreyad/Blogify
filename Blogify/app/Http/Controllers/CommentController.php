<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Blog $blog, Request $request){
        $comment = new Comment();
        $comment->blog_id = $blog->id;
        $comment->content = $request->get('content');
        $comment->save();

        return redirect()->route('blogs.show', $blog->id)->with('successful', 'Comment posted successfully');
    }
}
