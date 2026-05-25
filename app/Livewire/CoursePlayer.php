<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Lecture;
use App\Models\Section;
use Livewire\Component;

class CoursePlayer extends Component
{
    public Course $course;
    public $currentLecture;
    public $completedLectures = [];
    public $lectureIds = [];
    public $isComplete = false;
    public $hasQuiz = false;

    public function mount(Course $course, $lectureId = null)
    {
        // Check if user is enrolled or is the instructor/admin
        $user = auth()->user();
        $isInstructor = ($user->role === 'instructor' && $user->id === $course->instructor_id);
        $isAdmin = ($user->role === 'admin');
        $isEnrolled = ($user->role === 'student' && $user->enrollments()->where('course_id', $course->id)->exists());

        if (!$isEnrolled && !$isInstructor && !$isAdmin) {
            return redirect()->route('courses.show', $course->slug)->with('error', 'Access denied.');
        }

        $this->course = $course;
        $this->loadCourseData();
        
        if ($lectureId) {
            $this->currentLecture = Lecture::find($lectureId);
        } else {
            $this->currentLecture = Lecture::whereIn('id', $this->lectureIds)->first();
        }

        $this->loadProgress();
    }

    public function loadCourseData()
    {
        // Load sections and lectures to get IDs in correct order
        $sections = Section::where('course_id', $this->course->id)
            ->orderBy('position')
            ->with(['lectures' => fn($q) => $q->orderBy('position')])
            ->get();

        $this->lectureIds = $sections->flatMap(function($section) {
            return $section->lectures->pluck('id');
        })->toArray();
        
        // Convert to integers to be safe
        $this->lectureIds = array_map('intval', $this->lectureIds);
    }

    public function loadProgress()
    {
        if (auth()->check()) {
            $this->completedLectures = auth()->user()->lectureProgress()
                ->whereIn('lecture_id', $this->lectureIds)
                ->where('completed', true)
                ->pluck('lecture_id')
                ->map(fn($id) => (int)$id)
                ->toArray();
            
            $totalLectures = count($this->lectureIds);
            $this->isComplete = ($totalLectures > 0 && count($this->completedLectures) === $totalLectures);
            $this->hasQuiz = $this->course->quiz()->exists();
        }
    }

    public function selectLecture($lectureId)
    {
        $this->currentLecture = Lecture::find($lectureId);
        $this->loadProgress();
    }

    public function goToNext()
    {
        $this->loadCourseData();
        $currentId = (int)$this->currentLecture->id;
        $currentIndex = array_search($currentId, $this->lectureIds);
        
        if ($currentIndex !== false && isset($this->lectureIds[$currentIndex + 1])) {
            $this->selectLecture($this->lectureIds[$currentIndex + 1]);
        }
    }

    public function goToPrevious()
    {
        $this->loadCourseData();
        $currentId = (int)$this->currentLecture->id;
        $currentIndex = array_search($currentId, $this->lectureIds);
        
        if ($currentIndex !== false && isset($this->lectureIds[$currentIndex - 1])) {
            $this->selectLecture($this->lectureIds[$currentIndex - 1]);
        }
    }

    public function toggleComplete($lectureId)
    {
        if (!auth()->check()) return;

        $progress = auth()->user()->lectureProgress()->firstOrCreate(
            ['lecture_id' => $lectureId],
            ['completed' => false]
        );

        $progress->completed = !$progress->completed;
        $progress->save();

        $this->loadCourseData();
        $this->loadProgress();
        $this->updateCourseProgress();
    }

    protected function updateCourseProgress()
    {
        $totalLectures = count($this->lectureIds);
        $completedCount = count($this->completedLectures);
        
        $percent = $totalLectures > 0 ? round(($completedCount / $totalLectures) * 100) : 0;
        $this->isComplete = ($percent == 100);

        $enrollment = auth()->user()->enrollments()->where('course_id', $this->course->id)->first();
        if ($enrollment) {
            $enrollment->update([
                'progress_percent' => $percent,
                'completed_at' => $percent == 100 ? now() : null
            ]);
        }
    }

    public function getYoutubeEmbedUrlProperty()
    {
        if (!$this->currentLecture || !$this->currentLecture->video_url) {
            return null;
        }

        $url = $this->currentLecture->video_url;
        $videoId = null;

        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $match)) {
            $videoId = $match[1];
        }

        if (!$videoId) {
            return $url;
        }

        $startTime = $this->currentLecture->start_time ?? 0;
        return "https://www.youtube.com/embed/{$videoId}?autoplay=1&rel=0&modestbranding=1&showinfo=0&start={$startTime}";
    }

    public function render()
    {
        // Ensure course is loaded for the view
        $this->course->load(['sections.lectures']);
        return view('livewire.course-player')->layout('layouts.learning');
    }
}
