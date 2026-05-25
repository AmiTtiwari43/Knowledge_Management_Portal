<x-app-layout>
    <div class="bg-white dark:bg-gray-900 min-h-screen">
        <!-- Hero Section -->
        <div class="relative py-20 bg-gray-50 dark:bg-gray-800/50 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <h1 class="text-4xl md:text-6xl font-black text-gray-900 dark:text-white mb-6">
                    Our <span class="text-blue-600">Blog</span>
                </h1>
                <p class="text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">
                    Insights, tutorials, and stories from our expert instructors. Learn something new every day.
                </p>
            </div>
            
            <!-- Abstract background elements -->
            <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($posts as $post)
                    <article class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-all group">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block relative aspect-[16/9] overflow-hidden">
                            <img src="{{ $post->thumbnail_url }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                                <span class="text-white font-bold text-sm">Read Article &rarr;</span>
                            </div>
                        </a>
                        
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="px-2 py-0.5 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-[10px] font-black uppercase tracking-widest rounded">Tutorial</span>
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>
                            
                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-3 mb-6 leading-relaxed">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            
                            <div class="flex items-center justify-between pt-6 border-t border-gray-50 dark:border-gray-700">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center font-bold text-gray-500 text-xs uppercase">
                                        {{ substr($post->user->name, 0, 1) }}
                                    </div>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">{{ $post->user->name }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-400">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/></svg>
                                        <span class="text-[10px] font-bold">{{ $post->likes_count }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-16">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
