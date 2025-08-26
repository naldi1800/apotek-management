<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
