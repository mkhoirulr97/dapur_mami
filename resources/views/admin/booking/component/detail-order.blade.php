<x-card-container>
    <p class="font-medium">
        <i class="fas fa-clock mr-2"></i>
        Detail Booking
    </p>
    <div class="flex justify-between items-center mt-4">
        <span class="font-semibold text-lg" id="detailEventName">
            {{ $booking->event_name }}
        </span>
        {{-- TODO: UPDATE BUTTON TO MODAL FOR UPDATE STATUS TRANSACTION --}}
        @if ($booking->status == 1)
            <label for="editStatusModal" onclick="editStatus({{ $booking->id }})"
                class="cursor-pointer bg-gray-700 text-white px-3 py-2 text-center rounded-lg text-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray">
                <i class="fas fa-edit mr-2"></i>
                Ubah Status
            </label>
        @endif
    </div>

    <p class="font-semibold my-4">Detail</p>

    <div class="grid grid-cols-2 mb-2 gap-x-4">
        <div>
            <div class="flex justify-between items-start mb-2">
                <span class="text-gray-500">Tanggal Booking</span>
                <span id="detailBookingDate">
                    {{ date('d/m/Y', strtotime($booking->booking_date)) }}
                </span>
            </div>
            <div class="flex justify-between items-start mb-2">
                <span class="text-gray-500">Jumlah Orang</span>
                <span id="detailTotalGuest">{{ $booking->total_guest }} Orang</span>
            </div>
        </div>
        <div>
            <div class="flex justify-between items-start mb-2">
                <span class="text-gray-500">Jam</span>
                <span id="detailBookingTime">
                    {{ date('H:i', strtotime($booking->booking_time)) }}
                </span>
            </div>
            <div class="flex justify-between items-start mb-2">
                <span class="text-gray-500">Kasir</span>
                <span id="detailBookingTime">
                    {{ $booking->user->first_name }}
                </span>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-200 my-4"></div>
    <p class="font-semibold my-4">Menu Pesanan</p>

    <div class="flex justify-between mb-4">
        <span class="text-gray-500">Menu</span>
        <span class="text-gray-500">Total</span>
    </div>

    @foreach ($booking->transactionDetails as $transactionDetail)
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
    @endforeach

    <div class="border border-t-1 my-2"></div>

    <div class="flex justify-between items-center">
        <span class="font-semibold">Sub Total</span>
        <span class="font-semibold" id="transactionSubTotal">Rp.
            {{ number_format($booking->sub_total, 0, ',', '.') }}</span>
    </div>
    <div class="flex justify-between items-center">
        <span class="font-semibold">Diskon</span>
        <span class="font-semibold" id="transactionDiscount">
            {{ $booking->discount ?? '-' }}</span>
    </div>
    <div class="flex justify-between items-center">
        <span class="font-semibold">Total</span>
        <span class="font-semibold" id="transactionTotalPayment">Rp.
            {{ number_format($booking->total_payment, 0, ',', '.') }}</span>
    </div>
    <div class="{{ $booking->status == 1 ? 'sm:block xl:grid grid-cols-2' : '' }} mt-4 gap-x-2">
        @if ($booking->status == 1)
            <button onclick="btnCancel('{{ $booking->id }}')"
                class="bg-red-600 px-4 py-3 rounded-lg text-sm text-white hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red">
                Hapus Booking
            </button>
        @endif
        @if ($booking->status == 1 || $booking->status == 2)
            <a href="{{ route('admin.booking.print', $booking->id) }}" target="_blank"
                class="bg-gray-800 text-white {{ $booking->status == 1 ? '' : 'flex justify-center w-full' }} px-4 py-3 text-center rounded-lg text-sm hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                Cetak Bukti Pembayaran
            </a>
        @endif
    </div>
</x-card-container>
