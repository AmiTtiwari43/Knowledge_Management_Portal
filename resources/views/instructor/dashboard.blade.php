<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Instructor Dashboard') }}
            </h2>
            <a href="{{ route('instructor.courses.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-bold text-sm hover:bg-blue-700 transition-colors">
                Create New Course
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Total Students</p>
                    <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $totalStudents }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Published Courses</p>
                    <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $publishedCount }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Total Courses</p>
                    <p class="text-3xl font-black text-gray-900 dark:text-white">{{ $courses->count() }}</p>
                </div>
            </div>

            <!-- Courses List -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold text-gray-900 dark:text-white">Your Courses</h3>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($courses as $course)
                        <div class="p-6 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                            <div class="flex items-center gap-4">
                                <img src="{{ $course->thumbnail_url }}" 
                                     class="w-16 h-10 object-cover rounded-lg">
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-white">{{ $course->title }}</h4>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="text-xs font-bold px-2 py-0.5 rounded {{ $course->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                            {{ ucfirst($course->status) }}
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $course->enrollments_count }} Students</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('instructor.courses.edit', $course->id) }}" class="p-2 text-gray-400 hover:text-blue-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('instructor.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <p class="text-gray-500 dark:text-gray-400">You haven't created any courses yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
