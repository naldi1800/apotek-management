<?php

namespace App\Livewire;

use App\Models\Sparepart;
use App\Models\Stock;
use Livewire\Component;
use App\Models\Basket as MBasket;
use App\Models\Employee;
use App\Models\Medicine;
use Livewire\Attributes\On;
use App\Models\Transaction;
use App\Models\TransactionModel;
use Illuminate\Support\Facades\Auth;

class Basket extends Component
{

    public $baskets = [];
    public $total = 0;

    public $nota = '';
    // protected $listeners =  [
    //     'addToBasket' => 'addToBasket',
    // ];

    public function mount()
    {
        $em = Employee::find(Auth::guard('employee')->id());
        if ($em->status == -1) return;
        $check = $em->status == 0;
        if ($check) {
            $em->update(['status' => 1]);
        }

        $this->loadBasket();
    }

    public function loadBasket()
    {
        $this->baskets = MBasket::with('medicine', 'stock')->get();

        $this->total = MBasket::sum('subtotal');
        $this->dispatch('updatedTotal', $this->total);

        $basket = MBasket::all();
        if (!$basket->isEmpty()) {
            $this->nota = $basket->last()->nomor_nota;
        } else {
            $this->nota = "-";
        }
    }


    #[On('getTotal')]
    public function getTotal(): void
    {
        $total = MBasket::sum('subtotal');
        $this->total = $total;
        $this->dispatch('updatedTotal', $total);
    }

    #[On('addToBasket')]
    public function addToBasket($medicine_id)
    {


        $medicine = Medicine::find($medicine_id);

        $stock = Stock::where('medicine_id', $medicine_id)
            ->where('status', 'tersedia')
            ->orderBy('expiry_date', 'asc')
            ->first();


        $basketItem = MBasket::where('medicine_id', $medicine_id)
            ->where('stock_id', $stock ? $stock->id : null)
            ->first();

        if (!$basketItem) {
            $basketItem = new MBasket();
            $basketItem->nomor_nota = ($this->nota === '-') ? "N" . now()->format('Ymd-His') : $this->nota;
            $basketItem->jumlah = 0;
        }

        $basketItem->medicine_id = $medicine_id;
        $basketItem->stock_id = $stock ? $stock->id : null;
        $basketItem->employee_id = Auth::guard('employee')->id();
        $basketItem->jumlah += 1;
        $basketItem->subtotal = $basketItem->jumlah * $medicine->selling_price;
        $basketItem->save();

        $this->loadBasket();
    }

    public function addItem($basketId)
    {
        $basket = MBasket::find($basketId);
        $medicine = Medicine::find($basket->medicine_id);
        $basket->jumlah += 1;
        $basket->subtotal = $basket->jumlah * $medicine->selling_price;
        $basket->save();
        $this->loadBasket();
    }

    public function subItem($basketId)
    {
        $basket = MBasket::find($basketId);
        $medicine = Medicine::find($basket->medicine_id);

        if ($basket->jumlah < 2) {
            $this->removeItem($basket->id);
        } else {
            $basket->jumlah -= 1;
            $basket->subtotal = $basket->jumlah * $medicine->selling_price;
            $basket->save();
            $this->loadBasket();
        }
    }

    public function removeItem($basketId)
    {
        MBasket::find($basketId)->delete();
        $this->loadBasket();
    }


    #[On('bayar')]
    public function bayar()
    {
        $baskets = MBasket::with('medicine', 'stock')->where('nomor_nota', $this->nota)
            ->where('employee_id', Auth::guard('employee')->id())
            ->get();

        if (empty($baskets)) {
            return;
        }

        $firstBasket = $baskets->first();
        $transaction = new Transaction();
        $transaction->nomor_nota = $firstBasket->nomor_nota;
        $transaction->employee_id = $firstBasket->employee_id;
        $transaction->total_harga = $baskets->sum('subtotal');
        $transaction->tanggal_transaksi = now();
        $transaction->keterangan = 'Transaksi via aplikasi kasir';
        $transaction->save();

        foreach ($baskets as $basket) {
            $transaction_model = new TransactionModel();
            $transaction_model->transaction_id = $transaction->id;
            $transaction_model->medicine_id = $basket->medicine_id;
            $transaction_model->stock_id = $basket->stock_id;
            $transaction_model->jumlah = $basket->jumlah;
            $transaction_model->harga_satuan = $basket->medicine->selling_price;
            $transaction_model->subtotal = $basket->subtotal;
            $transaction_model->save();
            $basket->delete();
        }
        $this->loadBasket();
    }

    public function render()
    {
        return view('livewire.basket');
    }
}
