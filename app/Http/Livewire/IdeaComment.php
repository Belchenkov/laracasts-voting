<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class IdeaComment extends Component
{
    public $comment;
    public $ideaUserId;

    protected $listeners = [
        'commentWasUpdated',
        'commentWasMarkedAsSpam',
        'commentWasMarkedAsNotSpam',
    ];

    public function commentWasUpdated(): void
    {
        $this->comment->refresh();
    }

    public function commentWasMarkedAsSpam(): void
    {
        $this->comment->refresh();
    }

    public function commentWasMarkedAsNotSpam(): void
    {
        $this->comment->refresh();
    }

    public function mount(Comment $comment, $ideaUserId): void
    {
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.idea-comment');
    }
}
