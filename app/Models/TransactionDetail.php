<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    public $table = 'transaction_details';

    protected $fillable = [
        'transactions_id',
        'menus_id',
        'discounts_id',
        'price',
        'quantity',
        'total_price',
    ];

    // RELATIONSHIP

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menus_id', 'id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discounts_id', 'id');
    }
}
