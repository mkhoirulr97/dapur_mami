@forelse ($invoices as $invoice)
    <div id="invoice-{{ $invoice->id }}" onclick="detailInvoice({{ $invoice->id }})"
        class="w-full bg-white p-4 hover:border hover:border-white-300 rounded-2xl shadow-xl hover:shadow-2xl cursor-pointer">
        <div class="flex justify-between items-center mb-1">
            <span class="font-semibold text-md">
                {{ $invoice->transaction_code }}
            </span>
            @if ($invoice->status == 1)
                <span class="badge badge-warning badge-sm">Menunggu</span>
            @elseif($invoice->status == 2)
                <span class="badge badge-primary badge-sm">Berhasil</span>
            @elseif($invoice->status == 3)
                <span class="badge badge-error badge-sm">Gagal</span>
            @endif
        </div>
        <div class="flex justify-between items-center mb-1 mt-2">
            <span class="text-gray-800">
                {{ $invoice->customer_name }}
            </span>
            <span class="font-semibold text-md">
                {{ date('H:i', strtotime($invoice->created_at)) }}
            </span>
        </div>
        <div class="flex justify-between items-center mb-4">
            <span class="text-gray-800">Tanggal</span>
            <span class="font-semibold text-md">
                {{ date('d-m-Y', strtotime($invoice->created_at)) }}
            </span>
        </div>
        <div class="border-t border-gray-200 my-4"></div>
        <div class="flex justify-between items-center">
            <span class="">Total</span>
            <span class="font-semibold text-md">Rp.
                {{ number_format($invoice->total_payment, 0, ',', '.') }}</span>
        </div>
    </div>
@empty
    <div class="w-full bg-white p-4 rounded-2xl shadow-xl">
        <p class="text-center">Tidak ada data</p>
    </div>
@endforelse
