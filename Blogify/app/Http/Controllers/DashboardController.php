<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $blog = new Blog([
            'title' => 'title of testing blog',
            'content' => 'dummy blog content',
            'tags' => 'add dummy tags',
            'comments' => 'dummy comment content'
        ]);
        $blog->save();
        return view('dashboard',[
            'blogs' => Blog::orderby('created_at', 'DESC')->get()
        ]);
    }
}
