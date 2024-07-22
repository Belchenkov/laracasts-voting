<?php

namespace App\Http\Livewire;

use App\Jobs\NotifyAllVoters;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Response;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SetStatus extends Component
{
    public $idea;
    public $status;
    public $notifyAllVoters;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->status = $this->idea->status_id;
    }

    public function setStatus(): void
    {
        if (auth()->guest() || ! auth()->user()->isAdmin()) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $this->idea->status_id = $this->status;
        $this->idea->save();

        if ($this->notifyAllVoters) {
            NotifyAllVoters::dispatch($this->idea);
        }

        Comment::create([
            'user_id' => auth()->id(),
            'idea_id' => $this->idea->id,
            'status_id' => $this->status,
            'body' => $this->comment ?? 'No comment was added.',
            'is_status_update' => true,
        ]);

        $this->reset('comment');

        $this->emit('statusWasUpdated', 'Status was updated successfully!');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.set-status');
    }
}
