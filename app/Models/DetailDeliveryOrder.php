<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDeliveryOrder extends Model
{
    use HasFactory;
    public $table = 'detail_delivery_orders';

    protected $fillable = [
        'delivery_orders_id',
        'menu_id',
        'price',
        'quantity',
        'total'
    ];

    public function deliveryOrder()
    {
        return $this->belongsTo(DeliveryOrder::class, 'delivery_orders_id', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}
