<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Status;
use App\Models\Vote;
use Livewire\Component;

class IdeasIndex extends Component
{

    public function render()
    {
        $statuses = Status::all()->pluck('id', 'name');

        $ideas = Idea::with('category', 'user', 'status')
            ->when(request()->status && request()->status !== 'All', function ($query) use ($statuses) {
                return $query->where('status_id', $statuses->get(request()->status));
            })
            ->addSelect([
                'voted_by_user' => Vote::select('id')
                    ->where('user_id', auth()->id())
                    ->whereColumn('idea_id', 'ideas.id')
            ])
            ->withCount('votes')
            ->orderBy('id', 'desc')
            ->simplePaginate(Idea::PAGINATION_COUNT);

        return view('livewire.ideas-index')
            ->with(compact('ideas'));
    }
}
