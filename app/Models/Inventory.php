<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'medicine_id',
        'stock_id',
        'type',
        'quantity',
        'description',
        'date',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
