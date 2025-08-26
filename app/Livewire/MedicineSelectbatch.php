<?php

namespace App\Livewire;

use Livewire\Component;

class MedicineSelectbatch extends Component
{
    public $batchNumber;
    public $selectedBatch;

    public function render()
    {
        return view('livewire.medicine-selectbatch');
    }

    // Di MedicineSelectbatch
    public function updatedSelectedBatch($batchId)
    {
        $this->dispatch('batchSelected', batchId: $batchId);
    }
}
