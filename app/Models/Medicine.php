<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'generic_name',
        'brand_name',
        'unit',
        'purchase_price',
        'selling_price',
        'bpom_number',
    ];

    public function stock() {
        return $this->hasMany(Stock::class);
    }
}
