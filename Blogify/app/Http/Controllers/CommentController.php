<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Blog $blog, Request $request) {
        $comment = new Comment();
        $comment->blog_id = $blog->id;
        $comment->user_id = Auth::auth()->id();
        $comment->content = $request->get('content');
        $comment->save();

        return response()->json(
            [
                'message' => 'successful posting',
                'comment' => response()->json($comment)
         ]);
    }

    public function destroy(Blog $blog, Comment $comment){
        $user = User::findorFail(auth()->id());

        if ($user->role_id !== 1) {
            return response()->json(['error' => 'Unauthorized Access'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'successful deletion']);
    }
}
