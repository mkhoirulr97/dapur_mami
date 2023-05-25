@forelse ($bookings as $booking)
    <div class="w-full bg-white p-4 hover:border rounded-2xl shadow-xl hover:shadow-2xl"
        onclick="detailOrder('{{ $booking->id }}')">
        <div class="flex justify-between items-center mb-3">
            <span class="font-semibold text-md" id="eventName">{{ $booking->event_name }}</span>
            @if ($booking->status == 1)
                <span class="badge badge-sm badge-warning">
                    Menunggu
                </span>
            @elseif($booking->status == 2)
                <span class="badge badge-sm badge-primary">
                    Selesai
                </span>
            @elseif($booking->status == 3)
                <span class="badge badge-sm badge-error">
                    Dibatalkan
                </span>
            @endif
        </div>
        <div class="mb-4">

            <ul class="mb-8 space-y-2 text-left text-gray-500 dark:text-gray-400">
                {{-- Booking date --}}
                <li class="flex items-center space-x-3">
                    <i class="fas fa-calendar flex-shrink-0 w-4 h-4"></i>
                    <span id="bookingDate">
                        {{ date('d/m/Y', strtotime($booking->booking_date)) }}
                    </span>
                </li>
                {{-- Total person --}}
                <li class="flex items-center space-x-3">
                    <i class="fas fa-users flex-shrink-0 w-4 h-4"></i>
                    <span id="totalGuest">{{ $booking->total_guest }} Orang</span>
                </li>
                {{-- Time --}}
                <li class="flex items-center space-x-3">
                    <i class="fas fa-clock flex-shrink-0 w-4 h-4"></i>
                    <span id="bookingTime">
                        {{ date('H:i', strtotime($booking->booking_time)) }}
                    </span>
                </li>
            </ul>

        </div>
        <div class="flex justify-between items-center">
            <span class="text-gray-500">Total</span>
            <span class="font-semibold text-md">Rp.
                {{ number_format($booking->total_payment, 0, ',', '.') }}</span>
        </div>
    </div>
@empty
    <div class="w-full bg-white p-4 hover:border rounded-2xl shadow-xl hover:shadow-2xl">
        <div class="flex justify-between items-center mb-3">
            <span class="font-semibold text-md" id="eventName">Belum ada booking</span>
        </div>
    </div>
@endforelse
