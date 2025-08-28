<?php

namespace App\Livewire;

use App\Models\Medicine;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\Basket;

class MedicineSearch extends Component
{

    public $search; // Untuk menyimpan input pencarian
    public $medicines; // Data barang yang ditemukan

    public function mount()
    {
        $this->medicines = collect();
        Log::debug('Medicine updated: ' . $this->medicines);
    }

    public function updatedSearch()
    {
        Log::debug('Search updated: ' . $this->search);

        if ($this->search == '') {
            $this->medicines = collect();
            return;
        }

        $this->medicines = Medicine::with('stock')->where('generic_name', 'like', '%' . $this->search . '%')->orWhere('brand_name', 'like', '%' . $this->search . '%')->get();
        // dd($this->medicines);
    }

    public function addToBasketButton($medicineId)
    {
        $this->dispatch('addToBasket', $medicineId);
        $this->medicines = collect();
        $this->search = '';
    }

    public function render()
    {
        return view('livewire.medicine-search');
    }
}
