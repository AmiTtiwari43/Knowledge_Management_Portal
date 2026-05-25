<?php

namespace App\Livewire;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use Livewire\Component;

class QuizPlayer extends Component
{
    public Quiz $quiz;
    public $currentQuestionIndex = 0;
    public $selectedOptions = [];
    public $showResult = false;
    public $score = 0;
    public $passed = false;
    public $attemptNumber = 1;
    public $canAttempt = true;

    public function mount(\App\Models\Course $course)
    {
        $this->quiz = $course->quiz()->with('questions.options')->first();
        
        if (!$this->quiz) {
            return redirect()->route('student.course.learn', $course->slug)->with('error', 'No quiz found for this course.');
        }

        $attemptsCount = auth()->user()->quizAttempts()->where('quiz_id', $this->quiz->id)->count();
        $this->attemptNumber = $attemptsCount + 1;
        
        if ($attemptsCount >= $this->quiz->max_attempts) {
            $this->canAttempt = false;
            $lastAttempt = auth()->user()->quizAttempts()->where('quiz_id', $this->quiz->id)->latest()->first();
            if ($lastAttempt) {
                $this->score = $lastAttempt->score;
                $this->passed = $lastAttempt->passed;
                $this->showResult = true;
            }
        }
    }

    public function selectOption($questionId, $optionId)
    {
        $this->selectedOptions[$questionId] = $optionId;
    }

    public function submitQuiz()
    {
        if (!$this->canAttempt) return;

        $totalPoints = 0;
        $earnedPoints = 0;

        foreach ($this->quiz->questions as $question) {
            $totalPoints += $question->points;
            $selectedOptionId = $this->selectedOptions[$question->id] ?? null;
            
            if ($selectedOptionId) {
                $option = $question->options->where('id', $selectedOptionId)->first();
                if ($option && $option->is_correct) {
                    $earnedPoints += $question->points;
                }
            }
        }

        $this->score = $totalPoints > 0 ? ($earnedPoints / $totalPoints) * 100 : 0;
        $this->passed = $this->score >= $this->quiz->passing_percentage;

        QuizAttempt::create([
            'user_id' => auth()->id(),
            'quiz_id' => $this->quiz->id,
            'score' => $this->score,
            'passed' => $this->passed,
            'attempt_number' => $this->attemptNumber,
        ]);

        $this->showResult = true;
        $this->canAttempt = ($this->attemptNumber < $this->quiz->max_attempts && !$this->passed);
    }

    public function retry()
    {
        if ($this->attemptNumber >= $this->quiz->max_attempts || $this->passed) return;
        
        $this->currentQuestionIndex = 0;
        $this->selectedOptions = [];
        $this->showResult = false;
        $this->attemptNumber++;
    }

    public function render()
    {
        return view('livewire.quiz-player');
    }
}
