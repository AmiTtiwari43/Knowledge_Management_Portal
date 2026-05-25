<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('instructor.posts.index') }}" class="text-xs font-black text-gray-400 uppercase tracking-widest hover:text-blue-600 flex items-center gap-2 mb-4">
                    &larr; Back to Posts
                </a>
                <h2 class="text-3xl font-black text-gray-900 dark:text-white">Edit Post</h2>
            </div>

            <form action="{{ route('instructor.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf @method('PUT')
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 p-8 space-y-6">
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Post Title</label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}" placeholder="Enter a catchy title..." required
                               class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-sm focus:ring-2 focus:ring-blue-500/20 dark:text-white">
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Thumbnail Image</label>
                        @if($post->thumbnail)
                            <div class="mb-4">
                                <img src="{{ $post->thumbnail_url }}" class="w-full max-w-sm rounded-2xl shadow-lg border-2 border-gray-100 dark:border-gray-700">
                            </div>
                        @endif
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="file" name="thumbnail" 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                            <input type="text" name="thumbnail_url" value="{{ str_starts_with($post->thumbnail, 'http') ? $post->thumbnail : '' }}" 
                                   class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-sm focus:ring-2 focus:ring-blue-500/20 dark:text-white" 
                                   placeholder="Or paste an Image URL...">
                        </div>
                        @error('thumbnail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        @error('thumbnail_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Post Content</label>
                        <textarea name="content" rows="15" placeholder="Start writing your thoughts here..." required
                                  class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-sm focus:ring-2 focus:ring-blue-500/20 dark:text-white">{{ old('content', $post->content) }}</textarea>
                        @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Status</label>
                        <select name="status" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-sm focus:ring-2 focus:ring-blue-500/20 dark:text-white">
                            <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <button type="submit" class="px-12 py-4 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/25">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
