<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const PENDING_STATUS = 1;
    const SUCCESS_STATUS = 2;
    const FAILED_STATUS  = 3;

    const PAYMENT_METHOD_CASH   = 1;
    const PAYMENT_METHOD_DEBIT  = 2;

    public $table = 'transactions';

    protected $fillable = [
        'users_id',
        'discounts_id',
        'transaction_code',
        'customer_name',
        'payment_method',
        'sub_total',
        'total_payment',
        'status',
        // for booking event //
        'event_name',
        'total_guest',
        'booking_date',
        'booking_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id', 'id');
    }

    public function generateTransactionCode()
    {
        // make code like : INV-2021-0001
        $code = 'INV-' . date('Y') . '-';
        $lastTransaction = Transaction::orderBy('id', 'DESC')->first();

        if ($lastTransaction) {
            $lastCode = $lastTransaction->transaction_code;
            $lastCode = explode('-', $lastCode);
            $lastCode = (int) end($lastCode);
            $lastCode += 1;
            $code .= str_pad($lastCode, 4, '0', STR_PAD_LEFT);
        } else {
            $code .= '0001';
        }

        return $code;
    }

    public function getStatus() {
        switch ($this->status) {
            case self::PENDING_STATUS:
                return 'Menunggu';
            case self::SUCCESS_STATUS:
                return 'Selesai';
            case self::FAILED_STATUS:
                return 'Gagal';
            default:
                return '-';
        }
    }

    public function getStatusColor() {
        switch ($this->status) {
            case self::PENDING_STATUS:
                return 'warning';
            case self::SUCCESS_STATUS:
                return 'primary';
            case self::FAILED_STATUS:
                return 'error';
            default:
                return 'default';
        }
    }
}
