<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialTransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_transaction_id',
        'name',
        'unit_type',
        'quantity',
        'ppu',
        'total',
        'status'
    ];

    public function materialTransaction()
    {
        return $this->belongsTo(MaterialTransaction::class);
    }
}
