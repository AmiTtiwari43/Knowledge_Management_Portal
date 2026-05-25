<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('My Certificates') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('View and download certificates for courses you have successfully completed.') }}
        </p>
    </header>

    <div class="mt-6 space-y-4">
        @forelse($completedEnrollments as $enrollment)
            <div class="flex items-center justify-between p-6 bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center border border-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">{{ $enrollment->course->title }}</h4>
                        <p class="text-xs text-gray-500 font-medium mt-0.5 uppercase tracking-wider">Completed on {{ $enrollment->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
                
                <a href="{{ route('student.certificate.download', $enrollment->course->slug) }}" class="inline-flex items-center px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    {{ __('Download') }}
                </a>
            </div>
        @empty
            <p class="text-sm text-gray-500 dark:text-gray-400 italic">
                {{ __('You haven\'t completed any courses yet.') }}
            </p>
        @endforelse
    </div>
</section>
