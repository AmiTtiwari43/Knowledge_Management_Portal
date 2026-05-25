<div class="py-12" wire:poll.10s>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase">Total Users</p>
                            <p class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['total_users'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase">Total Revenue</p>
                            <p class="text-2xl font-black text-gray-900 dark:text-white">₹{{ number_format($stats['total_revenue'], 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase">Total Courses</p>
                            <p class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['total_courses'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase">Pending Review</p>
                            <p class="text-2xl font-black text-gray-900 dark:text-white">{{ $stats['pending_approvals'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Instructor Sales -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="font-bold text-gray-900 dark:text-white">Instructor Performance</h3>
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($instructorSales as $instructor)
                            <div class="p-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center font-bold text-purple-600 uppercase">
                                        {{ substr($instructor->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $instructor->name }}</p>
                                        <p class="text-[10px] text-gray-500">{{ $instructor->total_enrollments }} enrollments</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-black text-gray-900 dark:text-white">₹{{ number_format($instructor->total_earnings, 2) }}</p>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Total Sales</p>
                                </div>
                            </div>
                        @endforeach
                        @if($instructorSales->isEmpty())
                            <div class="p-8 text-center text-gray-500 text-sm italic">
                                No instructor sales yet.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Sales/Enrollments -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="font-bold text-gray-900 dark:text-white">Selling Analytics</h3>
                    </div>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($recentOrders as $order)
                            <div class="p-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center font-bold text-blue-600">
                                        {{ substr($order->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $order->user->name }}</p>
                                        <p class="text-[10px] text-gray-500">purchased {{ $order->course->title }}</p>
                                    </div>
                                </div>
                                <p class="text-sm font-black text-gray-900 dark:text-white">₹{{ number_format($order->amount, 2) }}</p>
                            </div>
                        @endforeach
                        @if($recentOrders->isEmpty())
                            <div class="p-8 text-center text-gray-500 text-sm italic">
                                No sales yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- New Submissions -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="font-bold text-gray-900 dark:text-white">New Submissions</h3>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($recentCourses as $course)
                        <div class="p-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden">
                                    <img src="{{ $course->thumbnail_url }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <a href="{{ route('courses.show', $course->slug) }}" class="text-sm font-bold text-gray-900 dark:text-white hover:text-blue-600 transition-colors">{{ $course->title }}</a>
                                    <p class="text-[10px] text-gray-500">by {{ $course->instructor->name }}</p>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $course->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($course->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
