<?php

namespace App\Livewire\Instructor;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Livewire\Component;

class QuizEditor extends Component
{
    public Course $course;
    public $quiz;
    public $newQuestionText = '';

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->quiz = Quiz::firstOrCreate(
            ['course_id' => $course->id],
            ['title' => "Final Assessment: {$course->title}", 'passing_percentage' => 60, 'max_attempts' => 3]
        );
        $this->quiz->load('questions.options');
    }

    public function addQuestion()
    {
        $this->validate(['newQuestionText' => 'required|string|min:5']);
        
        $question = $this->quiz->questions()->create([
            'question_text' => $this->newQuestionText,
            'points' => 20
        ]);

        // Add 4 empty options
        for ($i = 0; $i < 4; $i++) {
            $question->options()->create([
                'option_text' => '',
                'is_correct' => ($i === 0)
            ]);
        }

        $this->newQuestionText = '';
        $this->quiz->load('questions.options');
    }

    public function updateQuizSettings($percentage, $attempts)
    {
        $this->quiz->update([
            'passing_percentage' => $percentage,
            'max_attempts' => $attempts
        ]);
    }

    public function updateQuestion($questionId, $text)
    {
        Question::find($questionId)->update(['question_text' => $text]);
    }

    public function updateOption($optionId, $text)
    {
        Option::find($optionId)->update(['option_text' => $text]);
    }

    public function setCorrectOption($questionId, $optionId)
    {
        $question = Question::find($questionId);
        $question->options()->update(['is_correct' => false]);
        Option::find($optionId)->update(['is_correct' => true]);
        $this->quiz->load('questions.options');
    }

    public function deleteQuestion($questionId)
    {
        Question::find($questionId)->delete();
        $this->quiz->load('questions.options');
    }

    public function render()
    {
        return view('livewire.instructor.quiz-editor');
    }
}
