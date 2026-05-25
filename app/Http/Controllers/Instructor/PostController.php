<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts()->latest()->paginate(10);
        return view('instructor.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('instructor.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'thumbnail_url' => 'nullable|url',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']) . '-' . uniqid();
        
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        } elseif ($request->filled('thumbnail_url')) {
            $validated['thumbnail'] = $request->thumbnail_url;
        }

        auth()->user()->posts()->create($validated);

        return redirect()->route('instructor.posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('instructor.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'thumbnail_url' => 'nullable|url',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        } elseif ($request->filled('thumbnail_url')) {
            $validated['thumbnail'] = $request->thumbnail_url;
        }

        $post->update($validated);

        return redirect()->route('instructor.posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('instructor.posts.index')->with('success', 'Post deleted successfully!');
    }
}
