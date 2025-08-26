<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class TransactionLivewire extends Component
{

    public $money;
    public $moneyReturn = 0;
    public $total;
    public $disabledButton = 'disabled';

    public function mount()
    {
        $this->dispatch('getTotal');
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="col-6">
            <h4>Load...</h4>
        </div>
        HTML;
    }

    #[On('updatedTotal')]
    public function updatedTotal($total)
    {
        $this->total = $total;
    }

    public function updatedMoney()
    {
        if ($this->money !== "") {
            $this->moneyReturn = $this->money - $this->total;
        } else {
            $this->moneyReturn = 0;
        }
        $this->disabledButton = ($this->moneyReturn >= 0) ? '' : 'disabled';
    }


    public function bayar(){
        $this->dispatch('bayar');
        $this->money = 0;
        $this->moneyReturn = 0;
        $this->dispatch('getTotal');
    }

    public function render()
    {
        return view('livewire.transaction-livewire');
    }
}
