<div>
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 sticky top-24">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="font-bold text-gray-900 dark:text-white">Filters</h3>
                    @if($search || $selectedCategory || $selectedLevel || $priceRange !== 'all')
                        <button wire:click="resetFilters" class="text-xs font-bold text-blue-600 hover:text-blue-700 uppercase tracking-wider">Reset</button>
                    @endif
                </div>
                
                <!-- Search -->
                <div class="mb-8">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Search</label>
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Find a course..." 
                               class="w-full pl-4 pr-10 py-3 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-sm focus:ring-2 focus:ring-blue-500/20 dark:text-white">
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Category -->
                <div class="mb-8">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Category</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $category)
                            <button wire:click="toggleCategory('{{ $category->slug }}')" 
                                    class="px-3 py-1.5 rounded-xl text-xs font-bold transition-all border {{ $selectedCategory === $category->slug ? 'bg-blue-600 border-blue-600 text-white shadow-lg shadow-blue-500/25' : 'bg-transparent border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:border-blue-500' }}">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
                
                <!-- Level -->
                <div class="mb-8">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Level</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['beginner', 'intermediate', 'advanced'] as $level)
                            <button wire:click="toggleLevel('{{ $level }}')" 
                                    class="px-3 py-1.5 rounded-xl text-xs font-bold transition-all border {{ $selectedLevel === $level ? 'bg-blue-600 border-blue-600 text-white shadow-lg shadow-blue-500/25' : 'bg-transparent border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:border-blue-500' }}">
                                {{ ucfirst($level) }}
                            </button>
                        @endforeach
                    </div>
                </div>
                
                <!-- Price -->
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Pricing</label>
                    <div class="space-y-2">
                        @foreach(['all' => 'All Courses', 'free' => 'Free', 'paid' => 'Paid'] as $value => $label)
                            <label class="flex items-center group cursor-pointer">
                                <input type="radio" wire:model.live="priceRange" value="{{ $value }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="ml-3 text-sm font-medium text-gray-600 dark:text-gray-400 group-hover:text-blue-600 transition-colors">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Course List -->
        <div class="flex-grow">
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 dark:text-white">Catalog</h2>
                    <p class="text-sm text-gray-500 mt-1">Showing {{ $courses->firstItem() ?? 0 }}-{{ $courses->lastItem() ?? 0 }} of {{ $courses->total() }} premium courses</p>
                </div>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($courses as $course)
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-all group">
                        <div class="relative aspect-video overflow-hidden">
                            <img src="{{ $course->thumbnail_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 dark:bg-gray-900/90 backdrop-blur text-[10px] font-black uppercase tracking-widest rounded-lg shadow-sm">
                                    {{ $course->category->name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-2 line-clamp-1 group-hover:text-blue-600 transition-colors">
                                {{ $course->title }}
                            </h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 mb-4 leading-relaxed">
                                {{ $course->description }}
                            </p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-50 dark:border-gray-700">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 text-xs font-bold">
                                        {{ substr($course->instructor->name, 0, 1) }}
                                    </div>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">{{ $course->instructor->name }}</span>
                                </div>
                                <div class="text-lg font-black text-gray-900 dark:text-white">
                                    {{ $course->price > 0 ? '₹' . number_format($course->price, 2) : 'FREE' }}
                                </div>
                            </div>
                            <a href="{{ route('courses.show', $course->slug) }}" class="mt-6 block w-full py-3 bg-gray-900 dark:bg-gray-700 text-white rounded-2xl text-center text-xs font-bold uppercase tracking-widest hover:bg-blue-600 transition-all">
                                View Course
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-32 text-center">
                        <div class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">No courses found</h3>
                        <p class="text-gray-500 mt-2">Try adjusting your filters or resetting them.</p>
                        <button wire:click="resetFilters" class="mt-8 px-8 py-3 bg-blue-600 text-white rounded-2xl font-bold shadow-lg shadow-blue-500/25">Clear All Filters</button>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
