<?php

namespace App\Repositories;

use App\Interfaces\BookingInterface;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingRepository implements BookingInterface
{
    private $transaction;
    private $transactionDetail;

    public function __construct(Transaction $transaction, TransactionDetail $transactionDetail)
    {
        $this->transaction = $transaction;
        $this->transactionDetail = $transactionDetail;
    }

    public function get()
    {
        return $this->transaction->with('transactionDetails')->where('event_name', '!=', null)->orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return $this->transaction->with('transactionDetails')->find($id);
    }

    public function store($data)
    {
        DB::beginTransaction();

        // insert to transaction
        try {
            $transaction = $this->transaction->create([
                'users_id'         => auth()->user()->id,
                'transaction_code' => $this->transaction->generateTransactionCode(),
                'discounts_id'     => isset($data['discounts_id']) ? $data['discounts_id'] : null,
                'payment_method'   => Transaction::PAYMENT_METHOD_CASH,
                'sub_total'        => $data['sub_total'],
                'total_payment'    => $data['total_payment'],
                'status'           => Transaction::PENDING_STATUS,
                'event_name'       => $data['eventName'],
                'total_guest'      => $data['totalGuest'],
                'booking_date'     => date('Y-m-d', strtotime($data['bookingDate'])),   // convert to Y-m-d format
                'booking_time'     => date('H:i', strtotime($data['bookingTime'])),   // convert to H:i:s format
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

        try {
            // Store to transaction_details table
            foreach ($data['cart'] as $cart) {
                $this->transactionDetail->create([
                    'transactions_id' => $transaction->id,
                    'discounts_id'    => isset($cart['discounts_id']) ? $cart['discounts_id'] : null,
                    'menus_id'        => $cart['id'],
                    'quantity'        => $cart['quantity'],
                    'price'           => $cart['price'],
                    'total'           => $cart['total'],
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }

        DB::commit();
    }

    public function period($data)
    {
        $transactions = $this->transaction->where('customer_name', null)->with('transactionDetails')->get();

        // return yesterday data
        if ($data == 'yesterday') {
            return $transactions->filter(function ($value, $key) {
                return $value->created_at->isYesterday();
            });
        }

        // return today data
        if ($data == 'day') {
            return $transactions->filter(function ($value, $key) {
                return $value->created_at->isToday();
            });
        }

        // return this week data
        if ($data == 'week') {
            return $transactions->filter(function ($value, $key) {
                return $value->created_at->isCurrentWeek();
            });
        }

        // return this month data
        if ($data == 'month') {
            return $transactions->filter(function ($value, $key) {
                return $value->created_at->isCurrentMonth();
            });
        }

        // return this year data
        if ($data == 'year') {
            return $transactions->filter(function ($value, $key) {
                return $value->created_at->isCurrentYear();
            });
        }

        // return all data
        if ($data == 'all') {
            return $transactions;
        }
    }

    public function updateStatus($id, $status)
    {
        $this->transaction->find($id)->update([
            'status' => $status
        ]);

        return true;
    }

    public function cancel($id)
    {
        DB::beginTransaction();
        $booking = $this->transaction->find($id);

        try {
            foreach ($booking->transactionDetails as $transaction) {
                $transaction->delete();
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        }

        try {
            $booking->delete();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        }

        DB::commit();
    }
}
