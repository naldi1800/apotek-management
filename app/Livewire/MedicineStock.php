<?php

namespace App\Livewire;

use App\Helpers\Fungsi;
use App\Models\Medicine;
use App\Models\Sparepart;
use App\Models\Stock;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class MedicineStock extends Component
{
    protected $listeners = ['batchSelected'];
    public $search, $selectMode;
    public $medicines;
    // public $batchsNumber;


    public $medicine_id;
    public $stock_id;
    public $namaObat;
    public $selectedMode;
    public $batchNumber;
    public $expiry_date;
    public $stock_date;
    public $current_quantity;
    public $initial_quantity;
    public $status;
    public $stok_masuk;
    public $harga_beli;
    public $harga_jual;
    public $keuntungan;
    public $total_harga;
    public $help_stok_masuk = null;
    public $current_quantity_same = false;

    public $batch_number;
    public $isBatchExist = false;
    public $quantity = 0;


    public function mount()
    {
        $this->medicines = Medicine::all();
    }

    public function updatedNamaObat($medicineId)
    {
        $this->selectedMode = null;
        $this->resetBatchProperties();
        $this->selectMode = $medicineId;
        $this->medicine_id = $medicineId;
    }

    public function updatedSelectedMode()
    {
        if ($this->selectedMode == 1) {
            $this->resetBatchProperties();
        } else if ($this->selectedMode == 2) {
            $this->batchNumber = Stock::where("medicine_id", $this->selectMode)->get() ;
            $this->resetBatchProperties();
        }
    }
    private function resetBatchProperties()
    {
        $this->current_quantity = null;
        $this->expiry_date = null;
        $this->stock_date = null;
        $this->harga_beli = null;
        $this->harga_jual = null;
        $this->initial_quantity = null;
        $this->status = null;
        $this->quantity = 0;
        $this->stock_id = null;
        $this->batch_number = null;
        $this->isBatchExist = false;
    }

    public function batchSelected($batchId)
    {
        $stock = Stock::find($batchId)->with('medicine')->first();
        if ($stock) {
            $this->medicine_id = $stock->medicine_id;
            $this->stock_id = $stock->id;
            $this->current_quantity = $stock->current_quantity;
            $this->initial_quantity = $stock->initial_quantity;
            $this->quantity = $stock->initial_quantity;
            $this->expiry_date = $stock->expiry_date;
            $this->stock_date = $stock->stock_date;
            $this->status = $stock->status;
            $this->harga_beli = "Rp. " . number_format($stock->medicine->purchase_price, 0, ',', '.');
            $this->harga_jual = "Rp. " . number_format($stock->medicine->selling_price, 0, ',', '.');
        }
    }

    public function updatedInitialQuantity()
    {
        $this->quantity = $this->initial_quantity;
        // if($this->current_quantity_same){
        //     $this->current_quantity = $this->initial_quantity;
        // }
    }

    public function updatedBatchNumber()
    {
        
        if ($this->batch_number == null) {
            return;
        }
        // dd("Update");

        $stock = Stock::where('batch_number', $this->batch_number)
            ->where('medicine_id', $this->selectMode)
            ->first();
        // dd($stock);
        $this->isBatchExist = (bool) $stock;
    }


    // public function updatedStokMasuk()
    // {
    //     if ($this->stok_masuk > 0) {
    //         $this->total_harga = ($this->search->harga_jual * $this->stok_masuk) * $this->stok_masuk;
    //         $help_stok_masuk = null;
    //     } else {
    //         $this->total_harga = 0;
    //         $help_stok_masuk = "Stok masuk harus lebih besar dari 0";
    //     }
    //     $this->keuntungan = "Rp. " . number_format($this->total_harga, 0, ',', '.');
    // }


    public function render()
    {
        return view('livewire.medicine-stock');
    }
}
