<div class="space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Course Assessment</h3>
                <p class="text-sm text-gray-500 mt-1">Configure the final MCQ test for students.</p>
            </div>
            <div class="flex gap-4">
                <div class="flex items-center gap-2 bg-gray-50 dark:bg-gray-900 px-4 py-2 rounded-xl">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Passing %</label>
                    <input type="number" wire:change="updateQuizSettings($event.target.value, {{ $quiz->max_attempts }})" 
                           value="{{ $quiz->passing_percentage }}" class="w-16 bg-transparent border-none p-0 text-sm font-bold text-blue-600 focus:ring-0">
                </div>
                <div class="flex items-center gap-2 bg-gray-50 dark:bg-gray-900 px-4 py-2 rounded-xl">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Max Attempts</label>
                    <input type="number" wire:change="updateQuizSettings({{ $quiz->passing_percentage }}, $event.target.value)" 
                           value="{{ $quiz->max_attempts }}" class="w-16 bg-transparent border-none p-0 text-sm font-bold text-blue-600 focus:ring-0">
                </div>
            </div>
        </div>

        <div class="space-y-6">
            @foreach($quiz->questions as $question)
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-3xl border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex-grow mr-4">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 block">Question {{ $loop->iteration }}</label>
                            <input type="text" wire:change="updateQuestion({{ $question->id }}, $event.target.value)" 
                                   value="{{ $question->question_text }}"
                                   class="w-full bg-transparent border-none p-0 text-lg font-bold text-gray-900 dark:text-white focus:ring-0">
                        </div>
                        <button wire:click="deleteQuestion({{ $question->id }})" class="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($question->options as $index => $option)
                            <div class="flex items-center gap-3 bg-white dark:bg-gray-800 p-3 rounded-2xl border {{ $option->is_correct ? 'border-emerald-500/50 bg-emerald-50/10' : 'border-gray-100 dark:border-gray-700' }}">
                                <button wire:click="setCorrectOption({{ $question->id }}, {{ $option->id }})" 
                                        class="w-6 h-6 rounded-full flex items-center justify-center border-2 {{ $option->is_correct ? 'bg-emerald-500 border-emerald-500' : 'border-gray-200 dark:border-gray-600' }}">
                                    @if($option->is_correct)
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    @endif
                                </button>
                                <input type="text" wire:change="updateOption({{ $option->id }}, $event.target.value)" 
                                       value="{{ $option->option_text }}" placeholder="Option {{ $index + 1 }}..."
                                       class="flex-grow bg-transparent border-none p-0 text-sm dark:text-white focus:ring-0">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Question Form -->
        <div class="mt-10 pt-10 border-t border-gray-100 dark:border-gray-700">
            <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-4">Add New MCQ</h4>
            <div class="flex gap-4">
                <input type="text" wire:model="newQuestionText" 
                       placeholder="e.g. What is the primary use case for this technology?" 
                       class="flex-grow px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl text-sm dark:text-white focus:ring-2 focus:ring-blue-500/20">
                <button wire:click="addQuestion" class="px-8 py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-black dark:hover:bg-gray-100 transition-all shadow-xl">
                    Add MCQ
                </button>
            </div>
            @error('newQuestionText') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
