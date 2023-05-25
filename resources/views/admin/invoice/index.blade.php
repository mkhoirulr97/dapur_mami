<x-app-layout>
    <x-breadcrumbs name="invoice" />
    <h1 class="font-semibold text-2xl my-8">Tagihan</h1>

    <div class="lg:flex gap-x-4">
        <div class="lg:w-full" id="invoiceContainer">
            <div class="lg:flex justify-between items-center">
                <div class="flex gap-x-3">
                    <select id="invoiceSelect"
                        class="block max-w-auto p-2 text-sm text-gray-900 border border-gray-300 rounded-lg  focus:ring-primary focus:border-primary">
                        <option value="all">Semua Tagihan</option>
                        <option value="yesterday">Kemarin</option>
                        <option value="day">Harian</option>
                        <option value="week">Mingguan</option>
                        <option value="month">Bulanan</option>
                        <option value="year">Tahunan</option>
                    </select>
                    <select id="invoiceStatusSelect"
                        class="block max-w-auto p-2 text-sm text-gray-900 border border-gray-300 rounded-lg  focus:ring-primary focus:border-primary">
                        <option value="all">Semua Jenis</option>
                        <option value="1">Menunggu</option>
                        <option value="2">Berhasil</option>
                        <option value="3">Gagal</option>
                    </select>
                </div>
                <div class="flex gap-x-3">
                    <div class="relative">
                        <input type="text" id="search"
                            class="w-64 px-4 py-2 border text-sm border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-transparent"
                            placeholder="Cari menu" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                            <button type="submit"
                                class="p-1 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <i class="fa-solid fa-search text-gray-500"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-x-3 gap-y-4 mt-5 cursor-pointer"
                id="invoiceList">
                @forelse ($invoices as $invoice)
                    <div id="invoice-{{ $invoice->id }}" onclick="detailInvoice({{ $invoice->id }})"
                        data-status="{{ $invoice->status }}"
                        class="w-full bg-white p-4 hover:border hover:border-white-300 rounded-2xl shadow-xl hover:shadow-2xl">
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
            </div>
        </div>
        <div class="hidden" id="detailOrder"></div>
    </div>

    <!-- Modal Update Status -->
    <input type="checkbox" id="editStatusModal" class="modal-toggle" />
    <label for="editStatusModal" class="modal cursor-pointer">
        <label class="modal-box relative" for="">
            <h3 class="text-lg font-bold">Formulir Ubah Status Tagihan</h3>
            <div class="flex justify-between items-center mt-3">
                <span class="text-gray-800">Kode Transaksi</span>
                <span class="font-semibold text-md" id="transactionCode"></span>
            </div>
            <div class="flex justify-between items-center mt-3">
                <span class="text-gray-800">Nama Pelanggan</span>
                <span class="font-semibold text-md" id="customerName"></span>
            </div>
            <div class="flex justify-between items-center mt-3">
                <span class="text-gray-800">Tanggal</span>
                <span class="font-semibold text-md" id="transactionDate"></span>
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
                {{-- menunggu pembayaran --}}
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
                        let url = "{{ route('admin.invoice.update-status', ':id') }}";
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
                                    // reload page
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
                let url = "{{ route('admin.invoice.detail', ':id') }}";
                $.ajax({
                    url: url.replace(':id', id),
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        $('label.modal #transactionCode').html(data.transaction_code);
                        $('label.modal #customerName').html(data.customer_name);
                        $('label.modal #transactionDate').html(formatTanggal(data.created_at));
                        $('label.modal #totalPayment').html(formatRupiah(data.total_payment));
                        $('label.modal #status').html(data.status == 1 ? 'Menunggu Pembayaran' : data.status == 2 ?
                            'Pembayaran Selesai' : 'Pembayaran Gagal');

                        $('label.modal #btnSuccess').attr('onclick', 'updateStatus(' + id + ', 2)');
                        $('label.modal #btnFailed').attr('onclick', 'updateStatus(' + id + ', 3)');
                        $('label.modal #btnWaiting').attr('onclick', 'updateStatus(' + id + ', 1)');

                        // check status
                        if (data.status == 1) {
                            $('label.modal #btnWaiting').addClass('hidden');
                            $('label.modal #btnSuccess').removeClass('hidden');
                        } else if (data.status == 2) {
                            $('label.modal #btnSuccess').addClass('hidden');
                            $('label.modal #btnWaiting').removeClass('hidden');
                        } else {
                            $('label.modal #btnFailed').addClass('hidden');
                            $('label.modal #btnWaiting').removeClass('hidden');
                        }
                    }
                });
            }

            function detailInvoice(id) {
                // unbind event
                $(this).unbind('click');
                event.preventDefault();
                $('#invoiceContainer').removeClass('lg:w-full').addClass('lg:w-3/5');
                $('#invoiceList').removeClass('xl:grid-cols-4').addClass('xl:grid-cols-3');
                $('#detailOrder').removeClass('hidden');
                $('#detailOrder').addClass('lg:w-2/5');
                let url = '{{ route('admin.invoice.show', ':id') }}';
                $.ajax({
                    url: url.replace(':id', id),
                    type: 'GET',
                    success: function(data) {
                        $('#detailOrder').html(data);
                    }
                });
                return false;
            }

            $(function() {
                $('#invoiceSelect').select2();
                $('#invoiceSelect').on('change', function() {
                    let value = $(this).val();
                    console.log(value);
                    $.ajax({
                        url: '{{ route('admin.invoice.period') }}',
                        type: 'GET',
                        data: {
                            period: value
                        },
                        success: function(data) {
                            $('#invoiceList').html(data);
                        }
                    });
                });
                $('#invoiceStatusSelect').on('change', function() {
                    // filter invoiceList by status
                    let value = $(this).val();
                    console.log(value);
                    $('#invoiceList .bg-white').filter(function() {
                        $(this).toggle($(this).data('status') == value || value == 'all')
                    });
                });
                $('#search').on('keyup', function() {
                    let value = $(this).val();
                    $('#invoiceList').filter(function() {
                        $(this).toggle($(this).data('search') == value || value == '')
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
