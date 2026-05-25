<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Course: {{ $course->title }}
            </h2>
            <div class="flex gap-4">
                <a href="{{ route('courses.show', $course->slug) }}" target="_blank" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg font-bold text-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    Preview Course
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Basic Settings -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 sticky top-24">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-6">Course Settings</h3>
                        
                        <form action="{{ route('instructor.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Status</label>
                                <select name="status" class="w-full px-4 py-2 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                    <option value="draft" {{ $course->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $course->status === 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Course Title</label>
                                <input type="text" name="title" value="{{ $course->title }}" class="w-full px-4 py-2 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Description</label>
                                <textarea name="description" rows="4" class="w-full px-4 py-2 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>{{ $course->description }}</textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Difficulty Level</label>
                                <select name="level" class="w-full px-4 py-2 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="beginner" {{ $course->level === 'beginner' ? 'selected' : '' }}>Beginner</option>
                                    <option value="intermediate" {{ $course->level === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="advanced" {{ $course->level === 'advanced' ? 'selected' : '' }}>Advanced</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Category</label>
                                <select name="category_id" class="w-full px-4 py-2 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $course->category_id === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Price (INR)</label>
                                <input type="number" step="0.01" name="price" value="{{ $course->price }}" class="w-full px-4 py-2 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Preview Video (YouTube URL)</label>
                                <input type="text" name="preview_video_url" value="{{ $course->preview_video_url }}" class="w-full px-4 py-2 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" placeholder="https://youtube.com/watch?v=...">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Course Thumbnail</label>
                                @if($course->thumbnail)
                                    <div class="relative group mb-2">
                                        <img src="{{ $course->thumbnail_url }}" class="w-full aspect-video object-cover rounded-xl border border-gray-100 dark:border-gray-700">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-xl">
                                            <span class="text-white text-xs font-bold uppercase tracking-widest">Current Image</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="space-y-2">
                                    <input type="file" name="thumbnail" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                                    <input type="text" name="thumbnail_url" value="{{ str_starts_with($course->thumbnail, 'http') ? $course->thumbnail : '' }}" 
                                           class="w-full px-4 py-2 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 text-xs" 
                                           placeholder="Or paste an Image URL...">
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-colors">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Curriculum & Assessment Editor -->
                <div class="lg:col-span-2" x-data="{ tab: 'curriculum' }">
                    <div class="flex gap-4 mb-6 bg-gray-100 dark:bg-gray-800 p-1.5 rounded-2xl w-fit">
                        <button @click="tab = 'curriculum'" :class="tab === 'curriculum' ? 'bg-white dark:bg-gray-700 shadow-sm text-blue-600' : 'text-gray-500 hover:text-gray-700'" class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all">
                            Curriculum
                        </button>
                        <button @click="tab = 'assessment'" :class="tab === 'assessment' ? 'bg-white dark:bg-gray-700 shadow-sm text-blue-600' : 'text-gray-500 hover:text-gray-700'" class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all">
                            Assessment (Quiz)
                        </button>
                    </div>

                    <div x-show="tab === 'curriculum'">
                        <livewire:instructor.curriculum-editor :course="$course" />
                    </div>
                    <div x-show="tab === 'assessment'" x-cloak>
                        <livewire:instructor.quiz-editor :course="$course" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
