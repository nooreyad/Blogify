<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        $blogs = Blog::orderby('created_at', 'DESC');
        if ($request->has('search')){
            $blogs = $blogs->where('content', 'like', '%' . $request->get('search', '') . '%')
            ->orwhere('title', 'like', '%' . $request->get('search', '') . '%');
        }
        return view('dashboard',[
            'blogs' => $blogs->paginate('5')
        ]);
    }
}
