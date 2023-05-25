<x-card-container>
    <p class="font-medium">
        <i class="fas fa-clock mr-2"></i>
        Detail Tagihan
    </p>
    <div class="flex justify-between items-center mt-4">
        <div class="">
            <p class="font-semibold text-lg" id="transactionCode">
                {{ $invoice->transaction_code }}
            </p>
            <span
                class="mt-2 badge badge-{{ $invoice->status == 1 ? 'warning' : ($invoice->status == 2 ? 'primary' : 'error') }}">
                {{ $invoice->getStatus() }}
            </span>
        </div>
        @if ($invoice->status == 1)
            <label for="editStatusModal" onclick="editStatus({{ $invoice->id }})"
                class="cursor-pointer bg-gray-600 text-white px-3 py-2 text-center rounded-lg text-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray">
                <i class="fas fa-edit mr-2"></i>
                Ubah Status
            </label>
        @endif
    </div>

    <p class="font-semibold my-4">Detail</p>

    <div class="grid grid-cols-3 mb-2">
        <div class="">
            <p class="text-gray-500">Customer</p>
            <p class="font-medium" id="transactionCustomerName">
                {{ $invoice->customer_name }}
            </p>
        </div>
        <div class="text-center">
            <p class="text-gray-500">Total Menu</p>
            <p class="font-medium" id="transactionTotalItemMenu">
                {{ $totalItemOrder }}
            </p>
        </div>
        <div class="text-end">
            <p class="text-gray-500">Pembayaran</p>
            <p class="font-medium" id="transactionPaymentMethod">
                {{ $invoice->payment_method == 1 ? 'Tunai' : 'Transfer' }}
            </p>
        </div>
    </div>
    <div class="border-t border-gray-200 my-4"></div>
    <p class="font-semibold my-4">Info Pesanan</p>

    <div class="flex justify-between mb-4">
        <span class="text-gray-500">Menu</span>
        <span class="text-gray-500">Total</span>
    </div>

    <div id="transactionOrderList">
        @forelse ($invoice->transactionDetails as $transactionDetail)
            <div class="flex justify-between items-center my-4">
                <div class="flex gap-x-3 items-center">
                    <div class="avatar">
                        <div class="w-12 rounded rounded-xl">
                            <img
                                src="{{ $transactionDetail->menu->image ? asset($transactionDetail->menu->image) : asset('images/menu/default.jpg') }}" />
                        </div>
                    </div>
                    <div>
                        <span class="font-medium">
                            {{ $transactionDetail->menu->name }}
                        </span>
                        <span class="font-semibold">x {{ $transactionDetail->quantity }}
                        </span>
                        <p class="text-gray-500">Rp. {{ number_format($transactionDetail->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                <span class="font-medium">Rp.
                    {{ number_format($transactionDetail->quantity * $transactionDetail->price, 0, ',', '.') }}</span>
            </div>
        @empty
            <p class="text-center">Tidak ada data</p>
        @endforelse
    </div>

    <div class="border border-t-1 my-2"></div>

    <div class="flex justify-between items-center">
        <span class="font-semibold">Sub Total</span>
        <span class="font-semibold" id="transactionSubTotal">Rp.
            {{ number_format($invoice->sub_total, 0, ',', '.') }}</span>
    </div>
    <div class="flex justify-between items-center">
        <span class="font-semibold">Diskon</span>
        <span class="font-semibold" id="transactionDiscount">
            {{ $invoice->discount ?? '-' }}</span>
    </div>
    <div class="flex justify-between items-center">
        <span class="font-semibold">Total</span>
        <span class="font-semibold" id="transactionTotalPayment">Rp.
            {{ number_format($invoice->total_payment, 0, ',', '.') }}</span>
    </div>
    <div class="lg:grid grid-cols-2 mt-4 gap-x-3">
        <x-link-button class="w-full justify-center" color="red">
            Batal
        </x-link-button>
        <x-link-button route="{{ route('admin.invoice.print', $invoice->id) }}" target="_blank" color="gray"
            class="w-full justify-center">
            Cetak
        </x-link-button>
    </div>
</x-card-container>
