<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->where('status', 'published')
            ->latest()
            ->paginate(12);
            
        return view('pages.blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::with(['user', 'likes'])
            ->where('slug', $slug)
            ->firstOrFail();
            
        $this->authorize('view', $post);
            
        return view('pages.blog.show', compact('post'));
    }
}
