<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Livewire\Component;

class StatusFilters extends Component
{
    public $status;
    public $statusCount;

    public function setStatus(string $newStatus)
    {
        $this->status = $newStatus;
        $this->emit('queryStringUpdatedStatus', $this->status);

        return redirect()->route('idea.index', [
            'status' => $this->status,
        ]);
    }

    public function mount(): void
    {
        $this->statusCount = Status::getCount();
        $this->status = request()->status ?? 'All';

        if (Route::currentRouteName() === 'idea.show') {
            $this->status = null;
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
