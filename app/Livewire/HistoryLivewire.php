<?php

namespace App\Livewire;

use App\Models\History;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class HistoryLivewire extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $from;
    public $to;
    public $halaman = 10;

    public function mount()
    {
        if (empty($this->from) && empty($this->to)) {
            $this->from = now()->startOfMonth();
            $this->to = now();
        }
    }

    public function updateHalaman($halaman)
    {
        $this->halaman = $halaman;
        $this->resetPage();
    }

    public function getDatasProperty()
    {
        return History::with('sparepart')
            ->whereBetween('created_at', [$this->from, $this->to])
            ->paginate($this->halaman);
    }

    public function search()
    {
        $this->resetPage();
    }

    public function toNowMonth()
    {
        $this->from = now()->startOfMonth();
        $this->to = now();
    }

    public function render()
    {
        return view('livewire.history-livewire', ['datas' => $this->datas]);
    }
}

