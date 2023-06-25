<?php

namespace App\Repositories;

use App\Interfaces\InvoiceInterface;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements InvoiceInterface
{
    private $transaction;
    private $transactionDetail;

    public function __construct(Transaction $transaction, TransactionDetail $transactionDetail)
    {
        $this->transaction = $transaction;
        $this->transactionDetail = $transactionDetail;
    }


    public function store($data)
    {
        DB::beginTransaction();

        // Store to transactions table
        try {
            $transaction = $this->transaction->create([
                'users_id'         => auth()->user()->id,
                'discounts_id'     => isset($data['discounts_id']) ? $data['discounts_id'] : null,
                'transaction_code' => $this->transaction->generateTransactionCode(),
                'customer_name'    => $data['customer_name'],
                'payment_method'   => Transaction::PAYMENT_METHOD_CASH,
                'sub_total'        => $data['sub_total'],
                'total_payment'    => $data['total'],
                'status'           => Transaction::PENDING_STATUS,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
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

    public function get()
    {
        return $this->transaction->with('transactionDetails')->where('event_name', null)->get();
    }

    public function period($data)
    {
        // return yesterday data
        if ($data == 'yesterday') {
            return $this->transaction->with('transactionDetails')
                ->whereDate('created_at', '=', Carbon::yesterday()->toDateString())
                ->get();
        }

        // return today data
        if ($data == 'day') {
            return $this->transaction->with('transactionDetails')
                ->whereDate('created_at', Carbon::today())
                ->get();
        }

        // return this week data
        if ($data == 'week') {
            return $this->transaction->with('transactionDetails')
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get();
        }

        // return this month data
        if ($data == 'month') {
            return $this->transaction->with('transactionDetails')
                ->whereMonth('created_at', Carbon::now()->month)
                ->get();
        }

        // return this year data
        if ($data == 'year') {
            return $this->transaction->with('transactionDetails')
                ->whereYear('created_at', Carbon::now()->year)
                ->get();
        }

        // return all data
        if ($data == 'all') {
            return $this->transaction->with('transactionDetails')->get();
        }
    }

    public function show($id)
    {
        return $this->transaction->with('transactionDetails')->find($id);
    }

    public function search($data)
    {
        return $this->transaction->with('transactionDetails')
            ->where('transaction_code', 'like', '%' . $data . '%')
            ->orWhere('customer_name', 'like', '%' . $data . '%')
            ->get();
    }

    public function updateStatus($id, $data)
    {
        $transaction = $this->transaction->find($id);
        $transaction->status = $data;
        $transaction->save();
    }

    public function getAll()
    {
        return $this->transaction->with('transactionDetails')->get();
    }

    public function filterByMonth($month)
    {
        return $this->transaction->with('transactionDetails')
            ->whereMonth('created_at', $month)
            ->get();
    }

    public function filterByDateRange($start, $end)
    {
        $start = date('Y-m-d', strtotime($start));
        $end = date('Y-m-d', strtotime($end));

        return $this->transaction->with('transactionDetails')
        ->where([
            ['created_at', '>=', $start],
            ['created_at', '<=', $end]
        ])
        ->get();
    }

    public function getTotalSales()
    {
        return $this->transaction->where('status', Transaction::SUCCESS_STATUS)->sum('total_payment');
    }
}
