<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Achievements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($enrollments as $enrollment)
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700 group transition-all hover:scale-[1.02]">
                        <div class="relative h-48">
                            <img src="{{ $enrollment->course->thumbnail ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-60"></div>
                            
                            @if($enrollment->progress_percent == 100)
                                <div class="absolute top-4 right-4 bg-yellow-400 text-yellow-900 p-2 rounded-full shadow-lg animate-pulse">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold rounded-full uppercase tracking-wider">
                                    {{ $enrollment->course->category->name }}
                                </span>
                                @if($enrollment->progress_percent == 100)
                                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-xs font-bold rounded-full uppercase tracking-wider">
                                        Verified
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 line-clamp-1">
                                {{ $enrollment->course->title }}
                            </h3>

                            @if($enrollment->progress_percent == 100)
                                <div class="grid grid-cols-2 gap-3">
                                    <a href="{{ route('student.certificate.view', $enrollment->course->slug) }}" target="_blank" class="flex items-center justify-center py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl text-sm font-bold hover:bg-gray-200 transition-all">
                                        View
                                    </a>
                                    <a href="{{ route('student.certificate.download', $enrollment->course->slug) }}" class="flex items-center justify-center py-2.5 bg-blue-600 text-white rounded-xl text-sm font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/25">
                                        Download
                                    </a>
                                </div>
                            @else
                                <div class="space-y-3">
                                    <div class="flex justify-between text-xs font-bold text-gray-500 dark:text-gray-400">
                                        <span>Progress</span>
                                        <span>{{ $enrollment->progress_percent }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 h-2 rounded-full overflow-hidden">
                                        <div class="bg-blue-600 h-full transition-all duration-1000" style="width: {{ $enrollment->progress_percent }}%"></div>
                                    </div>
                                    <p class="text-xs text-center text-gray-500 italic mt-2">Finish course to unlock certificate</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-dashed border-gray-300 dark:border-gray-700">
                        <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.143-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No achievements yet</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-8">Complete courses to earn your certificates of achievement.</p>
                        <a href="{{ route('student.dashboard') }}" class="inline-flex items-center px-8 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/30">
                            Back to My Learning
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
