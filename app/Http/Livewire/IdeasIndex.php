<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\Vote;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    public string $status = '';
    public $category = '';

    protected $queryString = [
        'status',
        'category',
    ];

    protected $listeners = [
        'queryStringUpdatedStatus'
    ];

    public function mount(): void
    {
        $this->status = request()->status ?? 'All';
    }

    public function queryStringUpdatedStatus($newStatus): void
    {
        $this->resetPage();
        $this->status = $newStatus;
    }

    public function render()
    {
        $statuses = Status::all()->pluck('id', 'name');
        $categories = Category::all();
        $ideas = Idea::with('category', 'user', 'status')
            ->when($this->status && $this->status !== 'All', function ($query) use ($statuses) {
                return $query->where('status_id', $statuses->get($this->status));
            })
            ->when($this->category && $this->category !== 'All Categories', function ($query) use ($categories) {
                return $query->where('category_id', $categories->pluck('id', 'name')->get($this->category));
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
            ->with(compact('ideas', 'categories'));
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }
}
