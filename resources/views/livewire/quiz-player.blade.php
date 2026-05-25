<div class="max-w-4xl mx-auto px-4 py-12">
    @if(!$showResult)
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">
            <!-- Progress Bar -->
            <div class="h-1.5 w-full bg-gray-100 dark:bg-gray-900">
                <div class="h-full bg-blue-600 transition-all duration-500" style="width: {{ (($currentQuestionIndex + 1) / $quiz->questions->count()) * 100 }}%"></div>
            </div>

            <div class="p-8 md:p-12">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white">{{ $quiz->title }}</h2>
                        <p class="text-sm text-gray-500 mt-1">Question {{ $currentQuestionIndex + 1 }} of {{ $quiz->questions->count() }}</p>
                    </div>
                    <div class="px-4 py-2 bg-blue-50 dark:bg-blue-900/30 rounded-xl">
                        <span class="text-xs font-black text-blue-600 dark:text-blue-400 uppercase tracking-widest">Attempt {{ $attemptNumber }}/{{ $quiz->max_attempts }}</span>
                    </div>
                </div>

                @php $question = $quiz->questions[$currentQuestionIndex]; @endphp

                <div class="space-y-8">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 leading-relaxed">
                        {{ $question->question_text }}
                    </h3>

                    <div class="grid gap-4">
                        @foreach($question->options as $option)
                            <button wire:click="selectOption({{ $question->id }}, {{ $option->id }})"
                                    class="w-full p-5 text-left rounded-2xl border-2 transition-all flex items-center justify-between group
                                    {{ ($selectedOptions[$question->id] ?? null) == $option->id 
                                        ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/20' 
                                        : 'border-gray-100 dark:border-gray-700 hover:border-blue-200 dark:hover:border-blue-800 bg-white dark:bg-gray-900' }}">
                                <span class="font-bold {{ ($selectedOptions[$question->id] ?? null) == $option->id ? 'text-blue-700 dark:text-blue-300' : 'text-gray-600 dark:text-gray-400' }}">
                                    {{ $option->option_text }}
                                </span>
                                @if(($selectedOptions[$question->id] ?? null) == $option->id)
                                    <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </div>
                                @else
                                    <div class="w-6 h-6 border-2 border-gray-200 dark:border-gray-600 rounded-full"></div>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="mt-12 flex justify-between items-center">
                    <button wire:click="$set('currentQuestionIndex', {{ max(0, $currentQuestionIndex - 1) }})" 
                            @if($currentQuestionIndex === 0) disabled @endif
                            class="px-8 py-3 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-white rounded-xl font-bold disabled:opacity-50 transition-all">
                        Previous
                    </button>

                    @if($currentQuestionIndex < $quiz->questions->count() - 1)
                        <button wire:click="$set('currentQuestionIndex', {{ $currentQuestionIndex + 1 }})" 
                                class="px-10 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-xl font-bold hover:bg-black dark:hover:bg-gray-100 transition-all shadow-lg">
                            Next Question
                        </button>
                    @else
                        <button wire:click="submitQuiz" 
                                class="px-12 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/30">
                            Submit Final Quiz
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-100 dark:border-gray-700 p-12 text-center">
            <div class="w-24 h-24 mx-auto mb-8 rounded-full flex items-center justify-center {{ $passed ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600' : 'bg-red-100 dark:bg-red-900/30 text-red-600' }}">
                @if($passed)
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                @else
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                @endif
            </div>

            <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-4">
                {{ $passed ? 'Congratulations!' : 'Almost There!' }}
            </h2>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">
                {{ $passed ? 'You have successfully passed the final assessment with an excellent score. Your certificate is now ready for download.' : 'You didn\'t reach the passing score of ' . $quiz->passing_percentage . '%. You can review the course material and try again.' }}
            </p>

            <div class="bg-gray-50 dark:bg-gray-900 rounded-2xl p-8 mb-8 grid grid-cols-2 gap-4">
                <div class="text-center">
                    <span class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Your Score</span>
                    <span class="text-3xl font-black {{ $passed ? 'text-emerald-500' : 'text-red-500' }}">{{ number_format($score, 0) }}%</span>
                </div>
                <div class="text-center">
                    <span class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</span>
                    <span class="text-3xl font-black {{ $passed ? 'text-emerald-500' : 'text-red-500' }}">{{ $passed ? 'PASSED' : 'FAILED' }}</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @if($passed)
                    <a href="{{ route('student.certificate.download', $quiz->course->slug) }}" class="px-10 py-4 bg-emerald-600 text-white rounded-2xl font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-500/30">
                        Download Certificate
                    </a>
                    <a href="{{ route('student.dashboard') }}" class="px-10 py-4 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-2xl font-bold hover:bg-black dark:hover:bg-gray-100 transition-all">
                        Back to Dashboard
                    </a>
                @else
                    @if($attemptNumber < $quiz->max_attempts)
                        <button wire:click="retry" class="px-10 py-4 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/30">
                            Try Again ({{ $quiz->max_attempts - $attemptNumber }} attempts left)
                        </button>
                    @endif
                    <a href="{{ route('student.dashboard') }}" class="px-10 py-4 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-white rounded-2xl font-bold hover:bg-gray-200 transition-all">
                        Return to Dashboard
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>
