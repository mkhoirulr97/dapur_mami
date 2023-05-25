<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialTransaction extends Model
{
    use HasFactory;

    const STATUS = [
        1 => 'Menunggu Pembayaran',
        2 => 'Di Proses',
        3 => 'Selesai',
        4 => 'Dibatalkan'
    ];

    protected $fillable = [
        'transaction_code',
        'total_paid',
        'total_return',
        'total_purchase',
        'status',
        'suppliers',
        'purchase_note',
        'purchase_proof',
        'purchase_date',
        'user_id',
        'cashier_id'
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materialTransactionDetail()
    {
        return $this->hasMany(MaterialTransactionDetail::class);
    }
}
