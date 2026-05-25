<footer class="bg-gray-900 text-gray-400 py-20 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <!-- Brand Column -->
            <div class="space-y-6">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-900/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <span class="text-xl font-black text-white tracking-tighter italic">KNOWLEDGE<span class="text-blue-500">PORTAL</span></span>
                </a>
                <p class="text-sm leading-relaxed">
                    The world's most advanced learning platform for modern developers. Master the skills that matter with industry experts.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.761 0 5-2.239 5-5v-14c0-2.761-2.239-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Categories Column -->
            <div>
                <h4 class="text-sm font-black text-white uppercase tracking-widest mb-8">Popular Tracks</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="{{ route('courses.index', ['selectedCategory' => 'web-development']) }}" class="hover:text-blue-500 transition-colors">Web Development</a></li>
                    <li><a href="{{ route('courses.index', ['selectedCategory' => 'design']) }}" class="hover:text-blue-500 transition-colors">UI/UX Design</a></li>
                    <li><a href="{{ route('courses.index', ['selectedCategory' => 'data-science']) }}" class="hover:text-blue-500 transition-colors">AI & Machine Learning</a></li>
                    <li><a href="{{ route('courses.index', ['selectedCategory' => 'it-software']) }}" class="hover:text-blue-500 transition-colors">Cloud Architecture</a></li>
                </ul>
            </div>

            <!-- Company Column -->
            <div>
                <h4 class="text-sm font-black text-white uppercase tracking-widest mb-8">Academy</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-blue-500 transition-colors">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-500 transition-colors">Contact Us</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-blue-500 transition-colors">Instructor Blog</a></li>
                    <li><a href="{{ route('courses.index') }}" class="hover:text-blue-500 transition-colors">Course Catalog</a></li>
                </ul>
            </div>

            <!-- Newsletter Column -->
            <div class="space-y-8">
                <div>
                    <h4 class="text-sm font-black text-white uppercase tracking-widest mb-4">Stay Ahead</h4>
                    <p class="text-xs leading-relaxed mb-6">Get weekly insights and new course updates delivered to your inbox.</p>
                    <form class="relative group">
                        <input type="email" placeholder="email@example.com" class="w-full bg-gray-800 border-none rounded-xl py-4 pl-6 pr-12 text-sm text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-600/50 transition-all">
                        <button type="button" class="absolute right-2 top-2 bottom-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-xs uppercase tracking-widest font-bold">
                &copy; {{ date('Y') }} Knowledge Portal Academy. All rights reserved.
            </p>
            <div class="flex gap-8 text-[10px] font-black uppercase tracking-widest">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-white transition-colors">Cookie Settings</a>
            </div>
        </div>
    </div>
</footer>
