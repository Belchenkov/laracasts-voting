<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Livewire\Component;
use Livewire\WithPagination;

class IdeaComments extends Component
{
    use WithPagination;

    public $idea;

    protected $listeners = ['commentWasAdded', 'commentWasDeleted', 'statusWasUpdated'];

    public function commentWasAdded(): void
    {
        $this->idea->refresh();
        $this->goToPage($this->idea->comments()->paginate()->lastPage());
    }

    public function statusWasUpdated(): void
    {
        $this->idea->refresh();
        $this->goToPage($this->idea->comments()->paginate()->lastPage());
    }

    public function commentWasDeleted(): void
    {
        $this->idea->refresh();
        $this->goToPage(1);
    }

    public function mount(Idea $idea): void
    {
        $this->idea = $idea;
    }

    public function render()
    {
        return view('livewire.idea-comments', [
            'comments' => Comment::with(['user', 'status'])->where('idea_id', $this->idea->id)->paginate()->withQueryString(),
        ]);
    }
}
