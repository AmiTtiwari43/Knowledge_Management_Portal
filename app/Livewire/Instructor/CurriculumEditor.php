<?php

namespace App\Livewire\Instructor;

use App\Models\Course;
use App\Models\Section;
use App\Models\Lecture;
use Livewire\Component;

class CurriculumEditor extends Component
{
    public Course $course;
    public $newSectionTitle = '';

    public function mount(Course $course)
    {
        $this->course = $course->load('sections.lectures');
    }

    public function addSection()
    {
        $this->validate(['newSectionTitle' => 'required|string|max:255']);
        
        $this->course->sections()->create([
            'title' => $this->newSectionTitle,
            'position' => $this->course->sections()->count() + 1
        ]);

        $this->newSectionTitle = '';
        $this->course->load('sections.lectures');
    }

    public function updateSectionTitle($sectionId, $title)
    {
        Section::find($sectionId)->update(['title' => $title]);
    }

    public function addLecture($sectionId)
    {
        $section = Section::find($sectionId);
        $section->lectures()->create([
            'title' => 'New Lecture',
            'type' => 'video',
            'video_url' => '',
            'duration_seconds' => 0,
            'position' => $section->lectures()->count() + 1
        ]);

        $this->course->load('sections.lectures');
    }

    public function updateLectureTitle($lectureId, $title)
    {
        Lecture::find($lectureId)->update(['title' => $title]);
    }

    public function updateLectureVideo($lectureId, $url)
    {
        Lecture::find($lectureId)->update(['video_url' => $url]);
    }

    public function updateLectureDuration($lectureId, $duration)
    {
        Lecture::find($lectureId)->update(['duration_seconds' => $duration]);
    }

    public function formatSecondsToTime($seconds)
    {
        $mins = floor($seconds / 60);
        $secs = $seconds % 60;
        return sprintf('%02d:%02d', $mins, $secs);
    }

    public function updateLectureTimeRange($lectureId, $rangeString)
    {
        // Format expected: "MM.SS - MM.SS" or "MM:SS - MM:SS"
        $parts = explode('-', $rangeString);
        if (count($parts) !== 2) return;

        $startStr = trim($parts[0]);
        $endStr = trim($parts[1]);

        $startSeconds = $this->parseTimeToSeconds($startStr);
        $endSeconds = $this->parseTimeToSeconds($endStr);

        if ($endSeconds > $startSeconds) {
            Lecture::find($lectureId)->update([
                'start_time' => $startSeconds,
                'duration_seconds' => $endSeconds - $startSeconds
            ]);
        }
    }

    private function parseTimeToSeconds($timeStr)
    {
        // Replace . with : for unified parsing
        $timeStr = str_replace('.', ':', $timeStr);
        $parts = explode(':', $timeStr);
        
        if (count($parts) === 2) {
            return (intval($parts[0]) * 60) + intval($parts[1]);
        } elseif (count($parts) === 1) {
            return intval($parts[0]);
        }
        
        return 0;
    }

    public function deleteSection($sectionId)
    {
        Section::find($sectionId)->delete();
        $this->course->load('sections.lectures');
    }

    public function deleteLecture($lectureId)
    {
        Lecture::find($lectureId)->delete();
        $this->course->load('sections.lectures');
    }

    public function render()
    {
        return view('livewire.instructor.curriculum-editor');
    }
}
