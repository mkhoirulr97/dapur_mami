<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>
        Nota Pembayaran - {{ explode('-', $invoice->transaction_code)[2] }}
    </title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ public_path('assets/images/logo.png') }}"
                                    style="width: 100%; max-width: 100px" />
                            </td>

                            <td>
                                {{-- Invoice #: {{ explode('-', $invoice->transaction_code)[2] }}<br /> --}}
                                Invoice #: {{ $invoice->transaction_code }}<br />
                                Dibuat: {{ date('F d, Y', strtotime($invoice->created_at)) }}<br />
                                Tagihan: {{ date('F d, Y', strtotime($invoice->created_at)) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                Kasir: {{ $invoice->user->fullname }}<br />
                                Pelanggan: {{ $invoice->customer_name }}<br />
                                Jam: {{ date('H:i', strtotime($invoice->created_at)) }} WIB <br>
                                Status:
                                <b>{{ $invoice->status == 1 ? 'Belum Dibayar' : ($invoice->status == 2 ? 'Sudah Dibayar' : 'Sudah Dibayar dan Diantar') }}</b>
                            </td>
                            <td>
                                Dapur Mami<br />
                                Jl. Anggrek, Logandang Barat<br />
                                Kabupaten Situbondo
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Menu</td>
                <td>Jumlah</td>
                <td style="text-align: right">Harga</td>
                <td style="text-align: right">Total</td>
            </tr>

            @foreach ($invoice->transactionDetails as $transaction)
                @if ($loop == $loop->last)
                    <tr class="item last">
                        <td>{{ $transaction->menu->name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td style="text-align: right">
                            {{ number_format($transaction->menu->price, 0, ',', '.') }}
                        </td>
                        <td style="text-align: right">
                            {{ number_format($transaction->quantity * $transaction->price, 0, ',', '.') }}
                        </td>
                    </tr>
                @else
                    <tr class="item">
                        <td>{{ $transaction->menu->name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td style="text-align: right">{{ number_format($transaction->menu->price, 0, ',', '.') }}</td>
                        <td style="text-align: right">
                            {{ number_format($transaction->quantity * $transaction->price, 0, ',', '.') }}</td>
                    </tr>
                @endif
            @endforeach

            <tr class="total">
                <td colspan="3"></td>
                <td>Total: Rp. {{ number_format($invoice->total_payment, 0, ',', '.') }}</td>
            </tr>
        </table>
        <br>
        <table cellpadding="0" cellspacing="0">
            <tr class="heading">
                <td colspan="3">Metode Pembayaran</td>
                <td>{{ $invoice->payment_method == 1 ? 'Tunai' : 'Transfer' }} #</td>
            </tr>
            <tr class="">
                <td colspan="3">Sub Total</td>
                <td>
                    Rp. {{ number_format($invoice->sub_total, 0, ',', '.') }}
                </td>
            </tr>
            <tr class="">
                <td colspan="3">Diskon</td>
                <td>
                    {{ $invoice->discount->amount ?? '-' }}
                </td>
            </tr>
            <tr class="details">
                <td colspan="3">Total</td>
                <td>
                    Rp. {{ number_format($invoice->total_payment, 0, ',', '.') }}
                </td>
            </tr>
        </table>

        <div style="text-align: center; margin-top: 90px">
            <p>
                Terima kasih sudah berbelanja di Dapur Mami <br>
                Semoga harimu menyenangkan <br>
                Silahkan datang kembali
            </p>
        </div>
    </div>
</body>

</html>
