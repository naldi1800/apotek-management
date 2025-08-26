<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionViewLivewire extends Component
{

    use WithPagination;

    public $search;
    public $transactions;

    public function mount()
    {
        $this->loadTransactions();
    }

    public function loadTransactions()
    {
        $query = Transaction::with(['transactionModels.medicine', 'employee']);

        if (!empty($this->search)) {
            $query->where('nomor_nota', 'like', '%' . $this->search . '%');
        }

        $this->transactions = $query->orderBy('tanggal_transaksi', 'desc')
            ->get();
    }

    public function updatedSearch($value)
    {
        $this->loadTransactions();
    }

    public function render()
    {
        return view('livewire.transaction-view-livewire', [
            'transactions' => $this->transactions
        ]);
    }
}
