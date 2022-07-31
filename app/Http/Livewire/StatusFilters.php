<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class StatusFilters extends Component
{
    public $status = 'All';

    protected $queryString = [
        'status',
    ];

    public function setStatus(string $newStatus)
    {
        $this->status = $newStatus;

        return redirect()->route('idea.index', [
            'status' => $this->status,
        ]);
    }

    public function mount(): void
    {
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
