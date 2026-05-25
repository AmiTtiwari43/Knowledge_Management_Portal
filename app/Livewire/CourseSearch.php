<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CourseSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $selectedLevel = '';
    public $priceRange = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
        'selectedLevel' => ['except' => ''],
        'priceRange' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleCategory($slug)
    {
        $this->selectedCategory = ($this->selectedCategory === $slug) ? '' : $slug;
        $this->resetPage();
    }

    public function toggleLevel($level)
    {
        $this->selectedLevel = ($this->selectedLevel === $level) ? '' : $level;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'selectedCategory', 'selectedLevel', 'priceRange']);
        $this->resetPage();
    }

    public function render()
    {
        $courses = Course::where('status', 'published')
            ->with(['instructor', 'category'])
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedCategory, function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->selectedCategory);
                });
            })
            ->when($this->selectedLevel, function ($query) {
                $query->where('level', $this->selectedLevel);
            })
            ->when($this->priceRange !== 'all', function ($query) {
                if ($this->priceRange === 'free') {
                    $query->where('price', 0);
                } elseif ($this->priceRange === 'paid') {
                    $query->where('price', '>', 0);
                }
            })
            ->latest()
            ->paginate(9);

        $categories = Category::all();

        return view('livewire.course-search', [
            'courses' => $courses,
            'categories' => $categories
        ]);
    }
}
