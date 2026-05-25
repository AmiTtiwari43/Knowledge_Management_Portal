<?php

namespace App\Livewire;

use App\Models\Lecture;
use App\Models\Note;
use Livewire\Component;

class NotePad extends Component
{
    public Lecture $lecture;
    public $content = '';
    public $notes = [];

    protected $rules = [
        'content' => 'required|string|min:3',
    ];

    public function mount(Lecture $lecture)
    {
        $this->lecture = $lecture;
        $this->loadNotes();
    }

    public function loadNotes()
    {
        $this->notes = Note::where('user_id', auth()->id())
            ->where('lecture_id', $this->lecture->id)
            ->latest()
            ->get();
    }

    public function saveNote()
    {
        $this->validate();

        Note::create([
            'user_id' => auth()->id(),
            'lecture_id' => $this->lecture->id,
            'content' => $this->content,
        ]);

        $this->content = '';
        $this->loadNotes();
        
        $this->dispatch('note-saved');
    }

    public function deleteNote($noteId)
    {
        $note = Note::where('user_id', auth()->id())->find($noteId);
        if ($note) {
            $note->delete();
            $this->loadNotes();
        }
    }

    public function render()
    {
        return view('livewire.note-pad');
    }
}
