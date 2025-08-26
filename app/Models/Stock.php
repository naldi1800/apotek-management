<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'medicine_id',
        'batch_number',
        'expiry_date',
        'stock_date',
        'initial_quantity',
        'current_quantity',
        'status',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
