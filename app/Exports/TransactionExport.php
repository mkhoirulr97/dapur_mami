<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

// make export file
class TransactionExport implements FromCollection
{
    // add header
    public function headings(): array
    {
        return [
            'Kode Transaksi',
            'Pelanggan',
            'Jumlah Item',
            'Total Bayar',
            'Status Pembayaran',
            'Tanggal'
        ];
    }

    public function collection()
    {
        $transactions = Transaction::with(['user', 'transactionDetails'])->get();
        $data = [];
        foreach ($transactions as $transaction) {
            $data[] = [
                'Kode Transaksi' =>$transaction->transaction_code,
                'Pelanggan' => $transaction->customer_name ?? $transaction->event_name,
                'Jumlah Item' => $transaction->transactionDetails->sum('quantity'),
                'Total Bayar' => $transaction->total_payment,
                'Status Pembayaran' => $transaction->status == 1 ? 'Menunggu' : ($transaction->status == 2 ? 'Dibayar' : 'Dibatalkan'),
                'Tanggal' => date('d M Y', strtotime($transaction->created_at))
            ];
        }

        // add header
        array_unshift($data, $this->headings());

        return collect($data);
    }
}
