<?php

namespace App\Livewire;

use App\Models\Inventory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;


class InventoryLivewire extends Component
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
        return Inventory::with('medicine', 'stock')
            ->whereBetween('date', [$this->from, $this->to])
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
        return view('livewire.inventory-livewire', ['datas' => $this->datas]);
    }
}
