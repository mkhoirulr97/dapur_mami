<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    const ACTIVE_STATUS  = 1;
    const INACTIVE_STATUS = 2;

    public $table = 'discounts';

    protected $fillable = [
        'name',
        'amount',
        'expired_date',
        'status'
    ];

    // RELATION

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'discount_id', 'id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'discounts_id', 'id');
    }
}
