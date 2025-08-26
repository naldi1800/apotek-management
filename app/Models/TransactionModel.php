<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{

  
    protected $fillable = [
        'transaction_id',
        'medicine_id',
        'stock_id',
        'jumlah',
        'harga_satuan',
        'subtotal'
    ];
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
