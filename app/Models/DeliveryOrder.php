<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    use HasFactory;

    public $table = 'delivery_orders';

    CONST STATUS_WAITING_PAYMENT    = 0;
    CONST STATUS_PAYMENT_CONFIRMED  = 1;
    CONST STATUS_DELIVERY           = 2;
    CONST STATUS_DELIVERED          = 3;
    CONST STATUS_CANCELED           = 4;

    CONST STATUS = [
        0 => 'Menunggu Pembayaran',
        1 => 'Pembayaran Dikonfirmasi',
        2 => 'Pesanan Dikirim',
        3 => 'Pesanan Diterima',
        4 => 'Pesanan Dibatalkan'
    ];

    protected $fillable = [
        'users_id',
        'invoice',
        'customer_name',
        'payment_method',
        'total_payment',
        'sub_total',
        'status',
        'delivery_time',
        'delivery_date',
        'delivery_address',
        'delivery_phone',
        'delivery_note',
        'updated_by',
        'payment_proof',
        'payment_at',
        'expired_at'
    ];

    public function detailDeliveryOrders()
    {
        return $this->hasMany(DetailDeliveryOrder::class, 'delivery_orders_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    // make invoice
    public static function generateInvoice()
    {
        $lastInvoice = DeliveryOrder::orderBy('id', 'DESC')->first();
        if ($lastInvoice) {
            $lastInvoiceId = $lastInvoice->id;
            $lastInvoiceId++;
            $invoice = 'INV-' . date('Ym') . '-' . sprintf('%04s', $lastInvoiceId);
        } else {
            $invoice = 'INV-' . date('Ym') . '-' . sprintf('%04s', 1);
        }
        return $invoice;
    }
}
