<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Approval Queue') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th class="py-3 px-4 font-bold uppercase text-sm text-gray-600 dark:text-gray-400">Course</th>
                                    <th class="py-3 px-4 font-bold uppercase text-sm text-gray-600 dark:text-gray-400">Instructor</th>
                                    <th class="py-3 px-4 font-bold uppercase text-sm text-gray-600 dark:text-gray-400">Submitted</th>
                                    <th class="py-3 px-4 font-bold uppercase text-sm text-gray-600 dark:text-gray-400 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($courses as $course)
                                    <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-3">
                                                <img src="{{ $course->thumbnail }}" class="w-12 h-12 rounded-lg object-cover">
                                                <div>
                                                    <div class="font-bold">{{ $course->title }}</div>
                                                    <div class="text-xs text-gray-500">₹{{ $course->price }} | {{ ucfirst($course->level) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $course->instructor->name }}
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $course->created_at->diffForHumans() }}
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('admin.courses.approve', $course->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded text-xs font-bold hover:bg-green-700 transition-colors">
                                                        Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.courses.reject', $course->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded text-xs font-bold hover:bg-red-700 transition-colors">
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-20 text-center text-gray-500 italic">
                                            No courses pending approval.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
