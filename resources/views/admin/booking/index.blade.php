<x-app-layout>
    <x-breadcrumbs name="booking" />
    <h1 class="font-semibold text-2xl my-8">Reservasi</h1>

    <div class="lg:flex gap-x-4">
        <div class="lg:w-full" id="bookingListContainer">
            <div class="lg:flex gap-x-3 items-end">
                <div class="mb-4">
                    <label for="bookingSelect" class="block mb-2 text-sm font-medium text-gray-900">Filter
                        Tagihan</label>
                    <select id="bookingSelect"
                        class="block max-w-auto p-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                        <option value="all">Semua Tagihan</option>
                        <option value="yesterday">Kemarin</option>
                        <option value="day">Harian</option>
                        <option value="week">Mingguan</option>
                        <option value="month">Bulanan</option>
                        <option value="year">Tahunan</option>
                    </select>
                </div>
                <x-input id="search" label="Cari" placeholder="Masukan nama acara" name="search" type="text" />
                @if ($bookingStatus == true)
                    <x-link-button route="{{ route('admin.booking.create') }}" class="mb-4 ml-auto" color="gray">
                        Tambah Reservasi
                    </x-link-button>
                    @else
                    <x-link-button class="mb-4 ml-auto" color="gray" disabled>
                        Layanan reservasi sedang tidak aktif
                    </x-link-button>
                @endif
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-x-3 gap-y-4 mt-5" id="listBooking">
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
            </div>
        </div>
        <div class="" id="detailOrder">
        </div>
    </div>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="editStatusModal" class="modal-toggle" />
    <label for="editStatusModal" class="modal cursor-pointer">
        <label class="modal-box relative" for="">
            <h3 class="text-lg font-bold">Formulir Ubah Status Tagihan</h3>
            <div class="flex justify-between items-center mt-3">
                <span class="text-gray-800">Kode Transaksi</span>
                <span class="font-semibold text-md" id="transactionCode"></span>
            </div>
            <div class="flex justify-between items-center mt-3">
                <span class="text-gray-800">Nama Acara</span>
                <span class="font-semibold text-md" id="eventName"></span>
            </div>
            <div class="flex justify-between items-center mt-3">
                <span class="text-gray-800">Jumlah Tamu</span>
                <span class="font-semibold text-md" id="totalGuest"></span>
            </div>
            <div class="flex justify-between items-center mt-3">
                <span class="text-gray-800">Jam</span>
                <span class="font-semibold text-md" id="bookingTime"></span>
            </div>
            <div class="flex justify-between items-center mt-3">
                <span class="text-gray-800">Tanggal Reservasi</span>
                <span class="font-semibold text-md" id="bookingDate"></span>
            </div>
            <div class="flex justify-between items-center mt-3">
                <span class="text-gray-800">Total</span>
                <span class="font-semibold text-md" id="totalPayment"></span>
            </div>
            <div class="flex justify-between items-center mt-3">
                <span class="text-gray-800">Status</span>
                <span class="font-semibold text-md" id="status"></span>
            </div>
            <div class="flex gap-x-3 mt-6">
                <button type="button" id="btnWaiting"
                    class="bg-yellow-500 w-full text-white px-3 py-2 text-center rounded-lg text-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    <i class="fa-solid fa-clock mr-2"></i>
                    Menunggu
                </button>
                <button type="button" id="btnSuccess"
                    class="bg-primary w-full text-white px-3 py-2 text-center rounded-lg text-sm hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <i class="fa-solid fa-check mr-2"></i>
                    Selesai
                </button>
                <button type="button" id="btnFailed"
                    class="bg-red-600 w-full text-white px-3 py-2 text-center rounded-lg text-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-800">
                    <i class="fa-solid fa-times mr-2"></i>
                    Gagal
                </button>
            </div>
            <div class="modal-action">
                <label for="editStatusModal"
                    class="bg-gray-200 cursor-pointer w-full text-gray-800 px-4 py-3 text-center rounded-lg text-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray">
                    Batal
                </label>
            </div>
        </label>
    </label>
    @push('js-internal')
        <script>
            function btnCancel(id) {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Anda tidak dapat mengembalikan data yang telah diubah!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Batalkan Booking!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('admin.booking.cancel', ':id') }}";
                        $.ajax({
                            url: url.replace(':id', id),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data.status == true) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonColor: '#19743b',
                                    }).then((result) => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: data.message,
                                        icon: 'error',
                                        confirmButtonColor: '#19743b',
                                    });
                                }
                            }
                        });
                    }
                })
            }

            function updateStatus(id, value) {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Anda tidak dapat mengembalikan data yang telah diubah!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#19743b',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, ubah status!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('admin.booking.update-status', ':id') }}";
                        $.ajax({
                            url: url.replace(':id', id),
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: value,
                                status: value
                            },
                            success: function(data) {
                                console.log(data);
                                if (data.status == true) {
                                    $('#invoice-' + id).remove();
                                    $('#detailOrder').html('');
                                    $('#editStatusModal').prop('checked', false);
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Status tagihan berhasil diubah',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    // reload
                                    location.reload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: 'Status tagihan gagal diubah',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            }
                        });
                    } else {
                        $('#editStatusModal').prop('checked', false);
                    }
                });
            }

            function editStatus(id) {
                let url = "{{ route('admin.booking.show', ':id') }}";
                $.ajax({
                    url: url.replace(':id', id),
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        $('label.modal #transactionCode').html(data.transaction_code);
                        $('label.modal #eventName').html(data.event_name);
                        $('label.modal #totalGuest').html(data.total_guest);
                        $('label.modal #bookingTime').html(data.booking_time.slice(0, 5));
                        $('label.modal #bookingDate').html(data.booking_date);
                        $('label.modal #totalPayment').html('Rp. ' + data.total_payment);
                        $('label.modal #status').html(data.status == 1 ? 'Menunggu Pembayaran' : data.status == 2 ?
                            'Pembayaran Selesai' : 'Pembayaran Gagal');

                        $('label.modal #btnSuccess').attr('onclick', 'updateStatus(' + id + ', 2)');
                        $('label.modal #btnFailed').attr('onclick', 'updateStatus(' + id + ', 3)');
                        $('label.modal #btnWaiting').attr('onclick', 'updateStatus(' + id + ', 1)');
                    }
                });
            }

            function detailOrder(id) {
                $('#bookingListContainer').removeClass('lg:w-full').addClass('lg:w-3/5');
                $('#detailOrder').addClass('lg:w-2/5');
                $('#listBooking').removeClass('xl:grid-cols-4').addClass('xl:grid-cols-3');
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.booking.detail', ':id') }}".replace(':id', id),
                    success: function(data) {
                        $('#detailOrder').html(data);

                        return false;
                    }
                });
                return false;
            }

            $(function() {
                $('#bookingSelect').select2();
                $('#bookingSelect').on('change', function() {
                    let value = $(this).val().toLowerCase();
                    console.log(value);
                    $.ajax({
                        url: "{{ route('admin.booking.period') }}",
                        type: "GET",
                        data: {
                            period: value
                        },
                        success: function(data) {
                            // console.log(data);
                            $('#listBooking').html(data);
                        }
                    });
                });
                $('#search').on('keyup', function() {
                    let value = $(this).val().toLowerCase();
                    $('#listBooking .bg-white').filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
