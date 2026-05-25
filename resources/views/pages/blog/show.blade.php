<x-app-layout>
    <article class="bg-white dark:bg-gray-900 min-h-screen">
        <!-- Header -->
        <header class="py-16 bg-gray-50 dark:bg-gray-800/50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <span class="px-3 py-1 bg-blue-600 text-white text-[10px] font-black uppercase tracking-widest rounded-lg">Tutorial</span>
                    <span class="text-xs text-gray-500 font-bold uppercase tracking-widest">{{ $post->created_at->format('M d, Y') }}</span>
                </div>
                
                <h1 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white mb-8 leading-tight">
                    {{ $post->title }}
                </h1>
                
                <div class="flex items-center justify-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold text-lg">
                        {{ substr($post->user->name, 0, 1) }}
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-black text-gray-900 dark:text-white uppercase tracking-wider">{{ $post->user->name }}</p>
                        <p class="text-xs text-gray-500 font-medium">Expert Instructor</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12">
            <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white dark:border-gray-800 aspect-[21/9]">
                <img src="{{ $post->thumbnail_url }}" class="w-full h-full object-cover">
            </div>

            <div class="py-12 lg:py-20">
                <div class="prose prose-lg dark:prose-invert max-w-none break-words prose-headings:font-black prose-headings:text-gray-900 dark:prose-headings:text-white prose-p:text-gray-600 dark:prose-p:text-gray-400 prose-a:text-blue-600">
                    {!! nl2br(e($post->content)) !!}
                </div>

                <div class="mt-16 pt-12 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <livewire:blog.post-likes :post="$post" />
                    
                    <div class="flex items-center gap-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Share:</span>
                        <div class="flex gap-2">
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($post->title) }}" target="_blank" class="p-2 rounded-full bg-gray-50 dark:bg-gray-800 text-gray-500 hover:text-blue-600 transition-colors">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}" target="_blank" class="p-2 rounded-full bg-gray-50 dark:bg-gray-800 text-gray-500 hover:text-blue-600 transition-colors">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.761 0 5-2.239 5-5v-14c0-2.761-2.239-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</x-app-layout>
