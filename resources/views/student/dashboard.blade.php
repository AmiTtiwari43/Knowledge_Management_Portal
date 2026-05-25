<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Learning') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($enrollments as $enrollment)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col h-full group">
                        <div class="relative aspect-video">
                            <img src="{{ $enrollment->course->thumbnail_url }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <a href="{{ route('student.course.learn', $enrollment->course->slug) }}" class="p-3 bg-white text-gray-900 rounded-full shadow-xl">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-2 line-clamp-1">
                                {{ $enrollment->course->title }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                {{ $enrollment->course->instructor->name }}
                            </p>
                            
                            <div class="mt-auto">
                                <div class="flex justify-between text-xs font-bold text-gray-500 dark:text-gray-400 mb-2">
                                    <span>{{ $enrollment->progress_percent }}% Complete</span>
                                    <span>{{ $enrollment->progress_percent == 100 ? 'Finished' : 'In Progress' }}</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 h-2 rounded-full overflow-hidden">
                                    <div class="bg-blue-600 h-full transition-all duration-500" style="width: {{ $enrollment->progress_percent }}%"></div>
                                </div>
                                
                                @if($enrollment->progress_percent == 100)
                                    <div class="flex gap-2 mt-6">
                                        <a href="{{ route('student.course.learn', $enrollment->course->slug) }}" class="flex-1 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg text-sm font-bold flex items-center justify-center hover:bg-gray-200 transition-all">
                                            Review
                                        </a>
                                        <a href="{{ route('student.certificate.download', $enrollment->course->slug) }}" class="flex-1 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold flex items-center justify-center hover:bg-blue-700 transition-all">
                                            Certificate
                                        </a>
                                    </div>
                                @else
                                    <a href="{{ route('student.course.learn', $enrollment->course->slug) }}" class="mt-6 w-full py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg text-sm font-bold flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                                        Continue Learning
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-dashed border-gray-300 dark:border-gray-700">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">No courses yet</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">Start your journey by enrolling in a course.</p>
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition-colors">
                            Explore Catalog
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
