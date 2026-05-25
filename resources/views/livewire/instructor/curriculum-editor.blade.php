<div class="space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Course Curriculum</h3>
                <p class="text-sm text-gray-500 mt-1">Manage sections and lectures for this course.</p>
            </div>
        </div>
        
        <div class="space-y-6">
            @foreach($course->sections as $section)
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <!-- Section Header -->
                    <div class="p-5 flex items-center justify-between border-b border-gray-100 dark:border-gray-700 bg-gray-100/50 dark:bg-gray-800/50">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white dark:bg-gray-800 rounded-xl flex items-center justify-center shadow-sm border border-gray-100 dark:border-gray-700">
                                <span class="text-sm font-black text-gray-400">{{ $loop->iteration }}</span>
                            </div>
                            <input type="text" 
                                   wire:model.live.debounce.500ms="sections.{{ $section->id }}.title" 
                                   wire:change="updateSectionTitle({{ $section->id }}, $event.target.value)"
                                   class="bg-transparent border-none focus:ring-0 font-bold text-gray-900 dark:text-white p-0 text-lg w-64"
                                   value="{{ $section->title }}">
                        </div>
                        <div class="flex items-center gap-2">
                            <button wire:click="addLecture({{ $section->id }})" class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Add Lecture
                            </button>
                            <button wire:click="deleteSection({{ $section->id }})" class="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-xl transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Lectures List -->
                    <div class="p-4 space-y-3">
                        @forelse($section->lectures as $lecture)
                            <div class="bg-white dark:bg-gray-800 p-4 rounded-2xl border border-gray-100 dark:border-gray-700 group transition-all hover:border-blue-500/30 shadow-sm">
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3 flex-grow">
                                            <div class="text-gray-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            </div>
                                            <input type="text" 
                                                   wire:change="updateLectureTitle({{ $lecture->id }}, $event.target.value)"
                                                   class="flex-grow bg-transparent border-none focus:ring-0 font-bold text-gray-900 dark:text-white p-0 text-sm"
                                                   value="{{ $lecture->title }}">
                                        </div>
                                        <button wire:click="deleteLecture({{ $lecture->id }})" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </button>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pl-8">
                                        <div class="space-y-1">
                                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">YouTube URL</label>
                                            <input type="text" 
                                                   wire:change="updateLectureVideo({{ $lecture->id }}, $event.target.value)"
                                                   placeholder="Paste YouTube link here..."
                                                   class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-xs dark:text-white focus:ring-2 focus:ring-blue-500/20"
                                                   value="{{ $lecture->video_url }}">
                                        </div>
                                        <div class="space-y-1">
                                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Time Range (Start - End)</label>
                                            <input type="text" 
                                                   wire:change="updateLectureTimeRange({{ $lecture->id }}, $event.target.value)"
                                                   placeholder="e.g. 5.00 - 10.00"
                                                   class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-900 border-none rounded-xl text-xs dark:text-white focus:ring-2 focus:ring-blue-500/20"
                                                   value="{{ $this->formatSecondsToTime($lecture->start_time) }} - {{ $this->formatSecondsToTime($lecture->start_time + $lecture->duration_seconds) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-8 text-center bg-white dark:bg-gray-800 rounded-2xl border border-dashed border-gray-200 dark:border-gray-700">
                                <p class="text-sm text-gray-500">No lectures yet. Click "Add Lecture" to begin.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Section Form -->
        <div class="mt-10 pt-10 border-t border-gray-100 dark:border-gray-700">
            <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-4">Add New Section</h4>
            <div class="flex gap-4">
                <input type="text" wire:model="newSectionTitle" 
                       placeholder="e.g. Advanced Routing Techniques" 
                       class="flex-grow px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-sm dark:text-white focus:ring-2 focus:ring-blue-500/20">
                <button wire:click="addSection" class="px-8 py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-black dark:hover:bg-gray-100 transition-all shadow-xl">
                    Add Section
                </button>
            </div>
            @error('newSectionTitle') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
