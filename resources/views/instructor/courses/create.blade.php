<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <form action="{{ route('instructor.courses.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Course Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" 
                               class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" 
                               placeholder="e.g. Master Laravel 11 from Scratch">
                        @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Category</label>
                            <select name="category_id" 
                                    class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Level</label>
                            <select name="level" 
                                    class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                            @error('level') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Price (INR)</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', 0) }}" 
                               class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" 
                               placeholder="0.00 for free">
                        @error('price') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Short Description</label>
                        <textarea name="description" rows="4" 
                                  class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" 
                                  placeholder="What will students learn?">{{ old('description') }}</textarea>
                        @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Preview Video (YouTube URL)</label>
                            <input type="text" name="preview_video_url" value="{{ old('preview_video_url') }}" 
                                   class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="https://youtube.com/watch?v=...">
                            @error('preview_video_url') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-4">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Course Thumbnail</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="file" name="thumbnail" 
                                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                                <input type="text" name="thumbnail_url" value="{{ old('thumbnail_url') }}" 
                                       class="w-full px-4 py-2 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 text-sm" 
                                       placeholder="Or paste an Image URL...">
                            </div>
                            @error('thumbnail') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                            @error('thumbnail_url') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-colors shadow-lg shadow-blue-500/30">
                            Create Course & Continue
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
