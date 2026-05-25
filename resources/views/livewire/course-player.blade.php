<div class="flex flex-col h-screen overflow-hidden bg-[#0f172a]" x-data="{ sidebarOpen: true }">
    <!-- Header -->
    <header class="h-16 bg-[#1e293b] border-b border-slate-800 flex items-center justify-between px-6 shrink-0 z-20">
        <div class="flex items-center gap-4">
            <a href="{{ route('student.dashboard') }}" class="p-2 hover:bg-slate-700 rounded-lg transition-colors group">
                <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div class="h-6 w-px bg-slate-700 hidden sm:block"></div>
            <h1 class="text-sm font-bold text-slate-100 truncate max-w-[200px] md:max-w-md">{{ $course->title }}</h1>
        </div>

        <div class="flex items-center gap-6">
            <div class="hidden md:flex flex-col items-end">
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">Course Progress</span>
                    <span class="text-xs font-bold text-blue-400">{{ count($completedLectures) }}/{{ $course->sections->flatMap->lectures->count() }}</span>
                </div>
                <div class="w-32 h-1 bg-slate-800 rounded-full mt-1 overflow-hidden">
                    @php
                        $total = $course->sections->flatMap->lectures->count();
                        $percent = $total > 0 ? (count($completedLectures) / $total) * 100 : 0;
                    @endphp
                    <div class="h-full bg-blue-500 transition-all duration-500" style="width: {{ $percent }}%"></div>
                </div>
            </div>
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 bg-slate-800 hover:bg-slate-700 rounded-lg transition-colors lg:hidden">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            </button>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden relative">
        <!-- Main Video Area -->
        <main class="flex-1 overflow-y-auto bg-black relative flex flex-col custom-scrollbar" :class="sidebarOpen ? 'lg:mr-0' : ''">
            <div class="flex-1 flex flex-col">
                <!-- Video Container -->
                <div class="w-full bg-black aspect-video relative group">
                    @if($currentLecture && $currentLecture->type === 'video')
                        @if($this->youtubeEmbedUrl)
                            <iframe 
                                src="{{ $this->youtubeEmbedUrl }}" 
                                class="absolute inset-0 w-full h-full" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-500">
                                <svg class="w-20 h-20 mb-4 opacity-10" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/></svg>
                                <p class="text-xl font-bold">Video URL format not supported</p>
                            </div>
                        @endif
                    @elseif($currentLecture)
                        <div class="absolute inset-0 bg-slate-900 p-8 md:p-16 overflow-y-auto">
                            <div class="max-w-3xl mx-auto">
                                <h2 class="text-4xl font-black text-white mb-8">{{ $currentLecture->title }}</h2>
                                <div class="prose prose-invert max-w-none text-slate-300">
                                    {!! nl2br(e($currentLecture->content)) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Content Info Bar -->
                <div class="bg-[#1e293b] border-y border-slate-800 p-6 flex items-center justify-between sticky top-0 z-10">
                    <div class="flex items-center gap-6">
                        <button wire:click="goToPrevious" class="p-2 hover:bg-slate-700 rounded-full transition-colors group">
                            <svg class="w-6 h-6 text-slate-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <h2 class="text-xl font-black text-white hidden sm:block">{{ $currentLecture->title ?? 'Select a lecture' }}</h2>
                        <button wire:click="goToNext" class="p-2 hover:bg-slate-700 rounded-full transition-colors group">
                            <svg class="w-6 h-6 text-slate-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                    @if($currentLecture)
                        <button wire:click="toggleComplete({{ $currentLecture->id }})" 
                                class="flex items-center gap-2 px-6 py-3 rounded-xl font-black text-sm uppercase tracking-widest transition-all {{ in_array($currentLecture->id, $completedLectures) ? 'bg-emerald-500 text-white' : 'bg-blue-600 text-white hover:bg-blue-500 shadow-lg shadow-blue-900/20' }}">
                            @if(in_array($currentLecture->id, $completedLectures))
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Completed
                            @else
                                Mark Complete
                            @endif
                        </button>
                    @endif
                </div>

                <!-- Discussion/Notes Tabs -->
                <div class="p-8 max-w-5xl mx-auto w-full">
                    <div class="bg-[#1e293b] rounded-3xl p-8 border border-slate-800 shadow-xl">
                        <livewire:note-pad :lecture="$currentLecture" />
                    </div>
                </div>
            </div>
        </main>

        <!-- Sidebar Curriculum -->
        <aside class="fixed inset-y-0 right-0 w-80 bg-[#1e293b] border-l border-slate-800 z-30 transform transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0"
               :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full lg:hidden'">
            <div class="h-full flex flex-col">
                <div class="p-6 border-b border-slate-800 flex items-center justify-between">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-500">Course Content</h3>
                    <button @click="sidebarOpen = false" class="lg:hidden p-1 text-slate-500 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto custom-scrollbar p-2">
                    @foreach($course->sections as $section)
                        <div x-data="{ sectionOpen: true }" class="mb-2">
                            <button @click="sectionOpen = !sectionOpen" class="w-full flex items-center justify-between p-4 rounded-xl hover:bg-slate-800/50 transition-colors group">
                                <div class="text-left">
                                    <span class="block text-[10px] font-black text-blue-500 uppercase tracking-widest mb-1">Section {{ $loop->iteration }}</span>
                                    <span class="block text-sm font-bold text-slate-200 group-hover:text-white">{{ $section->title }}</span>
                                </div>
                                <svg class="w-4 h-4 text-slate-500 transition-transform" :class="sectionOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>

                            <div x-show="sectionOpen" x-collapse>
                                @foreach($section->lectures as $lecture)
                                    <button wire:click="selectLecture({{ $lecture->id }})" 
                                            class="w-full flex items-start gap-4 p-4 pl-8 rounded-xl transition-all relative group {{ ($currentLecture && $currentLecture->id === $lecture->id) ? 'bg-blue-600/10' : 'hover:bg-slate-800' }}">
                                        @if($currentLecture && $currentLecture->id === $lecture->id)
                                            <div class="absolute inset-y-2 left-2 w-1 bg-blue-500 rounded-full"></div>
                                        @endif

                                        <div class="shrink-0 mt-1">
                                            @if(in_array($lecture->id, $completedLectures))
                                                <div class="w-5 h-5 bg-emerald-500 rounded-full flex items-center justify-center">
                                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                </div>
                                            @else
                                                <div class="w-5 h-5 border-2 border-slate-700 rounded-full flex items-center justify-center">
                                                    <div class="w-1.5 h-1.5 bg-slate-700 rounded-full"></div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-1 text-left">
                                            <span class="block text-sm font-bold {{ ($currentLecture && $currentLecture->id === $lecture->id) ? 'text-blue-400' : 'text-slate-300 group-hover:text-slate-100' }}">
                                                {{ $lecture->title }}
                                            </span>
                                            <div class="flex items-center gap-3 mt-1.5 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                                <div class="flex items-center gap-1">
                                                    @if($lecture->type === 'video')
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/></svg>
                                                        <span>{{ gmdate("i:s", $lecture->duration_seconds) }}</span>
                                                    @else
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"/></svg>
                                                        <span>Article</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <!-- Final Quiz Section -->
                    @if($hasQuiz)
                        <div class="mt-8 mb-4">
                            <div class="px-4 py-3 bg-gradient-to-r from-blue-600/10 to-transparent rounded-xl border border-blue-500/20">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ $isComplete ? 'bg-blue-600' : 'bg-slate-700' }}">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </div>
                                    <div>
                                        <span class="block text-[10px] font-black text-blue-500 uppercase tracking-widest">Final Phase</span>
                                        <h4 class="text-sm font-bold text-white">Course Assessment</h4>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    @if($isComplete)
                                        <a href="{{ route('student.course.quiz', $course->slug) }}" class="w-full flex items-center justify-center gap-2 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-black text-[10px] uppercase tracking-[0.2em] transition-all shadow-lg shadow-blue-900/40">
                                            Take Final Test
                                        </a>
                                    @else
                                        <button disabled class="w-full py-3 bg-slate-800 text-slate-500 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] cursor-not-allowed">
                                            Complete Course to Unlock
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                </div>
            </div>
        </aside>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</div>
