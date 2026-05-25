<x-app-layout>
    <div class="bg-white dark:bg-gray-900">
        <!-- Hero Section -->
        <div class="bg-gray-900 text-white py-12 lg:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <nav class="flex mb-4 text-sm text-gray-400">
                            <a href="{{ route('courses.index') }}" class="hover:text-white">Courses</a>
                            <span class="mx-2">/</span>
                            <a href="{{ route('courses.index', ['category' => $course->category->slug]) }}" class="hover:text-white">{{ $course->category->name }}</a>
                        </nav>
                        <h1 class="text-3xl lg:text-5xl font-black mb-6">{{ $course->title }}</h1>
                        <p class="text-lg text-gray-300 mb-8">{{ $course->description }}</p>
                        
                        <div class="flex flex-wrap gap-6 text-sm">
                            <div class="text-gray-300">{{ $course->students_count }} students</div>
                            <div class="text-gray-300 text-capitalize">Level: {{ $course->level }}</div>
                            <div class="text-gray-300">Language: {{ $course->language }}</div>
                        </div>
                        
                        <div class="mt-8 flex items-center">
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center font-bold mr-3">
                                {{ substr($course->instructor->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-widest font-bold">Created by</p>
                                <p class="font-medium">{{ $course->instructor->name }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative group">
                        <div class="aspect-video rounded-2xl overflow-hidden shadow-2xl border-4 border-gray-800">
                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="w-20 h-20 bg-white text-gray-900 rounded-full flex items-center justify-center pl-1 shadow-xl hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Curriculum -->
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Course Curriculum</h2>
                        <div class="space-y-4">
                            @foreach($course->sections as $section)
                                <div x-data="{ open: true }" class="border border-gray-100 dark:border-gray-800 rounded-2xl overflow-hidden bg-gray-50/50 dark:bg-gray-800/50">
                                    <button @click="open = !open" class="w-full flex items-center justify-between p-5 text-left font-bold text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                        <span>{{ $section->title }}</span>
                                        <svg class="w-5 h-5 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <div x-show="open" x-collapse>
                                        <div class="p-2 space-y-1">
                                            @foreach($section->lectures as $lecture)
                                                <div class="flex items-center justify-between p-3 rounded-xl hover:bg-white dark:hover:bg-gray-800 transition-colors text-sm">
                                                    <div class="flex items-center gap-3">
                                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        <span class="text-gray-700 dark:text-gray-300">{{ $lecture->title }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-4">
                                                        @if($lecture->is_preview)
                                                            <span class="text-blue-600 font-bold text-xs uppercase">Preview</span>
                                                        @endif
                                                        <span class="text-gray-500">{{ gmdate("i:s", $lecture->duration_seconds) }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Enrollment Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-8 sticky top-24">
                        <div class="text-3xl font-black text-gray-900 dark:text-white mb-6">
                            {{ $course->price > 0 ? '₹' . number_format($course->price, 2) : 'Free' }}
                        </div>
                        
                        @auth
                            @if(Auth::user()->role === 'student')
                                @if(auth()->user()->enrollments()->where('course_id', $course->id)->exists())
                                    <a href="{{ route('student.course.learn', $course->slug) }}" class="w-full py-4 bg-blue-600 text-white rounded-xl font-bold flex items-center justify-center hover:bg-blue-700 transition-colors mb-4 shadow-lg shadow-blue-500/30">
                                        Go to Course
                                    </a>
                                @else
                                    <form action="{{ route('checkout.process', $course->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-colors mb-4 shadow-lg shadow-blue-500/30">
                                            Enroll Now
                                        </button>
                                    </form>
                                @endif
                            @elseif(Auth::user()->id === $course->instructor_id || Auth::user()->role === 'admin')
                                <a href="{{ route('instructor.courses.edit', $course->id) }}" class="w-full py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-xl font-bold flex items-center justify-center hover:bg-black dark:hover:bg-gray-100 transition-colors mb-4 shadow-xl">
                                    Manage Course
                                </a>
                                
                                @if(Auth::user()->role === 'admin' && $course->status === 'pending')
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <form action="{{ route('admin.courses.approve', $course->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full py-2 bg-green-600 text-white rounded-lg font-bold text-xs hover:bg-green-700">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.courses.reject', $course->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full py-2 bg-red-600 text-white rounded-lg font-bold text-xs hover:bg-red-700">Reject</button>
                                        </form>
                                    </div>
                                @endif

                                @if(Auth::user()->id === $course->instructor_id)
                                    <a href="{{ route('student.course.learn', $course->slug) }}" class="w-full py-2 text-center text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors">
                                        Preview in Player
                                    </a>
                                @endif
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="w-full py-4 bg-blue-600 text-white rounded-xl font-bold flex items-center justify-center hover:bg-blue-700 transition-colors mb-4 shadow-lg shadow-blue-500/30">
                                Log in to Enroll
                            </a>
                        @endauth
                        
                        <p class="text-center text-sm text-gray-500 dark:text-gray-400 mb-6">30-Day Money-Back Guarantee</p>
                        
                        <div class="space-y-4">
                            <h4 class="font-bold text-gray-900 dark:text-white text-sm uppercase tracking-widest">This course includes:</h4>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                12 hours on-demand video
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                5 articles
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Access on mobile and TV
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Certificate of completion
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
