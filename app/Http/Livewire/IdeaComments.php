<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaComments extends Component
{
    public $idea;

    protected $listeners = ['commentWasAdded'];

    public function commentWasAdded(): void
    {
        $this->idea->refresh();
    }
    public function mount(Idea $idea): void
    {
        $this->idea = $idea;
    }

    public function render()
    {
        return view('livewire.idea-comments', [
            'comments' => $this->idea->comments,
        ]);
    }
}
