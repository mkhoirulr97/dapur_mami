@forelse($transactions as $transaction)
    <x-card-container id="orderItem-{{ $transaction->id }}">
        <div class="flex space-x-3 mb-6">
            <span id="transaction_date" class="text-sm">
                {{ \Carbon\Carbon::parse($transaction->created_at)->isoFormat('D MMMM Y') }}
            </span>
            <span
                class="badge badge-sm badge-{{ $transaction->status == 0 && $transaction->payment_at == null ? 'warning animate-pulse' : ($transaction->status == 0 && $transaction->payment_at != null ? 'info' : ($transaction->status == 1 ? 'primary' : ($transaction->status == 2 ? 'primary' : ($transaction->status == 3 ? 'primary' : 'error')))) }}">
                {{ $transaction->status == 0 && $transaction->payment_at == null ? 'Belum dibayar' : ($transaction->status == 0 && $transaction->payment_at != null ? 'Menunggu konfirmasi' : ($transaction->status == 1 ? 'Dikonfirmasi' : ($transaction->status == 2 ? 'Dikirim' : ($transaction->status == 3 ? 'Selesai' : 'Dibatalkan')))) }}
            </span>
            <span class="text-gray-600 text-sm">
                {{ $transaction->invoice }}
            </span>
        </div>
        @foreach ($transaction->detailDeliveryOrders as $detailDeliveryOrder)
            <div class="flex items-center space-x-4 mb-4">
                <div class="flex-shrink-0">
                    <img class="w-10 h-10 rounded-md object-cover"
                        src="{{ $detailDeliveryOrder->menu->image
                            ? asset($detailDeliveryOrder->menu->image)
                            : asset('images/menu/default.jpg') }}"
                        alt="Neil image">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                        {{ $detailDeliveryOrder->menu->name }}
                    </p>
                    <p class="text-sm text-gray-500 truncate font-normal">
                        {{ $detailDeliveryOrder->quantity . ' barang' }} x
                        {{ 'Rp' . number_format($detailDeliveryOrder->menu->price, 0, ',', '.') }}
                    </p>
                </div>
                <div class="inline-flex items-center text-sm font-medium">
                    Rp {{ number_format($detailDeliveryOrder->total, 0, ',', '.') }}
                </div>
            </div>
        @endforeach
        <div class="border-t border-gray-100 mb-4"></div>
        {{-- check if expired time > now --}}
        @if (
            \Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($transaction->expired_at)) && $transaction->payment_at == null
        )
            <span class="text-sm text-gray-500">
                Pembayaran kadaluarsa <i class="far fa-times-circle ml-2 text-error"></i>
            </span>
        @else
            <div class="flex justify-between items-center">
                <label for="detailTransactionModal" onClick="detailOrder('{{ $transaction->id }}')"
                    class="text-primary text-sm font-medium cursor-pointer">
                    @if ($transaction->status == 0 && $transaction->payment_proof == null)
                        Konfirmasi Pembayaran <i class="far fa-check-circle ml-2"></i>
                    @else
                        Lihat Detail Transaksi <i class="fas fa-angle-right ml-3"></i>
                    @endif
                </label>
            </div>
            @if ($transaction->payment_at == null && $transaction->status == 0)
                <div class="flex justify-between items-center mt-4">
                    <span class="text-sm text-gray-500">
                        Pembayaran kadalaursa dalam
                    </span>
                    <span class="badge badge-md badge-error animate-pulse">
                        <span id="expiredAt-{{ $transaction->id }}">
                            {{ // hour, minute, for human
                                \Carbon\Carbon::parse($transaction->expired_at)->diffForHumans(null, true, false, 2) }}
                        </span>
                    </span>
                </div>
                {{-- batalkan pemesanan --}}
                <div class="flex justify-between items-center mt-4">
                    <label for="cancelOrderModal" onClick="cancelOrder('{{ $transaction->id }}')"
                        class="text-error text-sm font-medium cursor-pointer">
                        Batalkan Pemesanan <i class="fas fa-times-circle ml-2"></i>
                    </label>
                </div>
            @endif
        @endif

    </x-card-container>
@empty
    <div></div>
    <div class="flex flex-col items-center justify-center mt-6 mb-12">
        <img src="{{ asset('images/order/empty.png') }}" class="w-64 h-64" alt="Empty">
        <span class="text-gray-400 font-medium mt-4">Tidak ada data</span>
    </div>
    <div></div>
@endforelse
