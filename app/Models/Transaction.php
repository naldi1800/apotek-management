<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    use HasFactory;
    protected $guarded = [];

    public function transaction_model()
    {
        return $this->belongsToMany(TransactionModel::class);
    }

    protected $fillable = [
        'nomor_nota',
        'employee_id',
        'total_harga',
        'tanggal_transaksi',
        'keterangan'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function transactionModels()
    {
        return $this->hasMany(TransactionModel::class);
    }

    // Method untuk mendapatkan semua medicine melalui transactionModels
    public function medicines()
    {
        return $this->hasManyThrough(
            Medicine::class,
            TransactionModel::class,
            'transaction_id', // Foreign key on transaction_models table
            'id', // Foreign key on medicines table
            'id', // Local key on transactions table
            'medicine_id' // Local key on transaction_models table
        );
    }
}
