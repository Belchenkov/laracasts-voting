<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class StatusFilters extends Component
{
    public $status = 'All';
    public $statusCount;

    protected $queryString = [
        'status',
    ];

    public function setStatus(string $newStatus): RedirectResponse
    {
        $this->status = $newStatus;

        return redirect()->route('idea.index', [
            'status' => $this->status,
        ]);
    }

    public function mount(): void
    {
        $this->statusCount = Status::getCount();

        if (Route::currentRouteName() === 'idea.show') {
            $this->status = null;
            $this->queryString = [];
        }
    }

    public function render(): View
    {
        return view('livewire.status-filters');
    }

    private function getPreviousRouteName(): ?string
    {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }
}
