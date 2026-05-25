<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('instructor.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'level' => 'required|in:beginner,intermediate,advanced',
            'preview_video_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|max:2048',
            'thumbnail_url' => 'nullable|url',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        } elseif ($request->filled('thumbnail_url')) {
            $validated['thumbnail'] = $request->thumbnail_url;
        }

        $course = auth()->user()->courses()->create($validated);

        return redirect()->route('instructor.courses.edit', $course->id)
            ->with('success', 'Course created! Now add some sections and lectures.');
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        $categories = Category::all();
        $course->load('sections.lectures');
        return view('instructor.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'level' => 'required|in:beginner,intermediate,advanced',
            'status' => 'required|in:draft,published',
            'preview_video_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|max:2048',
            'thumbnail_url' => 'nullable|url',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('courses', 'public');
        } elseif ($request->filled('thumbnail_url')) {
            $validated['thumbnail'] = $request->thumbnail_url;
        }

        $course->update($validated);

        return back()->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
        $course->delete();
        return redirect()->route('instructor.dashboard')->with('success', 'Course deleted.');
    }
}
