<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-3xl font-black text-gray-900 dark:text-white">Moderate Blogs</h2>
                <p class="text-sm text-gray-500 mt-1">Review and manage all instructor publications across the platform.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                            <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Author</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Post Title</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($posts as $post)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-900/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold text-[10px]">
                                            {{ substr($post->user->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $post->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-blue-600 transition-colors">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-widest {{ $post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $post->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Delete this post permanently?')">
                                        @csrf @method('DELETE')
                                        <button class="px-4 py-2 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-6">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
