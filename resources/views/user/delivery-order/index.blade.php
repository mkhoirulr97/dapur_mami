<x-guest-layout>
    <x-user-header />

    @if (auth()->check())
        <section class="w-full mt-10 flex items-center">
            <div class="max-w-screen-xl px-4 mx-auto w-full">
                <h3 class="text-2xl font-bold dark:text-white">
                    Daftar Transaksi
                </h3>
                <div class="xl:flex flex-col items-end py-4 space-y-3 space-x-4 md:flex-row md:space-y-0">
                    <div class="xl:grid grid-cols-2 gap-x-3">
                        <x-input id="search" name="search" placeholder="Cari invoice" type="text"
                            class="py-3 mb-1.4" />
                        <x-select id="period">
                            <option value="" selected disabled>Periode</option>
                            <option value="today">Hari ini</option>
                            <option value="yesterday">Kemarin</option>
                            <option value="last_week">7 hari terakhir</option>
                            <option value="last_thirty_days">30 hari terakhir</option>
                            <option value="this_month">Bulan ini</option>
                            <option value="last_year">Tahun ini</option>
                        </x-select>
                    </div>
                    <div class="xl:grid grid-cols-2 gap-x-3">
                        <x-select id="status">
                            <option value="all" selected>Semua</option>
                            <option value="0">Menunggu pembayaran</option>
                            <option value="0t">Menunggu konfirmasi</option>
                            <option value="1">Sudah dibayar</option>
                            <option value="2">Sudah dikirim</option>
                            <option value="3">Diterima</option>
                            <option value="4">Dibatalkan</option>
                        </x-select>
                        <x-select id="sort">
                            <option value="" selected disabled>Urutkan</option>
                            <option value="desc">Terbaru</option>
                            <option value="asc">Terlama</option>
                        </x-select>
                    </div>
                    <div class="xl:flex items-end gap-x-3">
                        <div date-rangepicker class="flex items-center py-4">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="far fa-calendar"></i>
                                </div>
                                <input name="startDate" type="text" id="startDate"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full pl-10 p-2.5  dark:bg-gray-700 py-3"
                                    placeholder="Tanggal mulai">
                            </div>
                            <span class="mx-4 text-gray-500 text-sm">sampai</span>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="far fa-calendar"></i>
                                </div>
                                <input name="endDate" type="text" id="endDate"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full pl-10 p-2.5 py-3"
                                    placeholder="Tanggal akhir">
                            </div>
                        </div>
                        <div>
                            <x-button id="btnFilterRange" class="bg-primary px-10 my-4 py-3">
                                Filter
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if ($transactions->count() != 0)
            <section class="w-full mt-10 flex items-center">
                <div class="max-w-screen-xl px-4 mx-auto w-full">
                    <div class="xl:grid grid-cols-3 gap-x-3 gap-y-4" id="orderList">
                    </div>
                </div>
            </section>
        @else
            {{-- no order --}}
            <section class="w-full flex items-center">
                <div class="max-w-screen-xl px-4 mx-auto w-full">
                    <div class="flex flex-col items-center justify-center py-10">
                        <img src="{{ asset('img/empty.svg') }}" alt="empty" class="w-1/2">
                        <h3 class="text-2xl font-bold dark:text-white">
                            Belum ada transaksi
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400">
                            Belum ada transaksi yang dilakukan
                        </p>
                    </div>
                </div>
            </section>
        @endif

        <x-user-footer />

        {{-- Modal Detail Transaction --}}
        <input type="checkbox" id="detailTransactionModal" class="modal-toggle" />
        <label for="detailTransactionModal" class="modal cursor-pointer">
            <label class="modal-box relative lg:w-6/12 max-w-5xl" for="">
                <h3 class="text-lg font-bold">
                    Detail Transaksi
                </h3>
                <div class="p-6 space-y-6">
                    <h4 class="text-md font-semibold text-gray-900 dark:text-white" id="labelStatus">
                        -
                    </h4>
                    <div class="hidden" id="paymentProofContainer">
                        <x-input id="id" name="id" type="hidden" />
                        <x-input type="hidden" id="proof" name="proof" />
                    </div>
                    <p class="text-gray-500 text-sm" id="labelProof">
                        -
                    </p>
                    <div class="xl:flex justify-between text-sm">
                        <span class="text-gray-500">No. Invoice</span>
                        <span class="text-primary font-semibold" id="labelInvoice">-</span>
                    </div>
                    <div class="xl:flex justify-between text-sm">
                        <span class="text-gray-500">Tanggal Pemesanan</span>
                        <span class="" id="labelDeliveryDate">-</span>
                    </div>
                    <div class="border-t border-gray-100 mb-4"></div>
                    <h4 class="text-md font-semibold text-gray-900 dark:text-white">
                        Informasi Pengiriman
                    </h4>
                    <div class="block">
                        <div class="xl:grid grid-cols-3 text-sm mb-3">
                            <span class="text-gray-500">Kurir</span>
                            <div class="text-gray-10 col-span-2 flex">
                                <span class="mr-2 hidden xl:block">:</span>
                                <p id="labelCourier">Dapur Mami</p>
                            </div>
                        </div>
                        <div class="xl:grid grid-cols-3 text-sm mb-3">
                            <span class="text-gray-500">Nama Penerima</span>
                            <div class="text-gray-10 col-span-2 flex">
                                <span class="mr-2 hidden xl:block">:</span>
                                <p id="labelReceiver" class="capitalize">-</p>
                            </div>
                        </div>
                        <div class="xl:grid grid-cols-3 text-sm mb-3">
                            <span class="text-gray-500">No. Telepon</span>
                            <div class="text-gray-10 col-span-2 flex">
                                <span class="mr-2 hidden xl:block">:</span>
                                <p id="labelPhone">-</p>
                            </div>
                        </div>
                        <div class="xl:grid grid-cols-3 text-sm mb-3">
                            <span class="text-gray-500">Alamat</span>
                            <div class="text-gray-10 col-span-2 flex">
                                <span class="mr-2 hidden xl:block">:</span>
                                <p id="labelAddress">-</p>
                            </div>
                        </div>
                        <div class="xl:grid grid-cols-3 text-sm mb-3">
                            <span class="text-gray-500">Catatan</span>
                            <div class="text-gray-10 col-span-2 flex">
                                <span class="mr-2 hidden xl:block">:</span>
                                <p id="labelNote">-</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 mb-4"></div>
                    <h4 class="text-md font-semibold text-gray-900 dark:text-white">
                        Informasi Pesanan
                    </h4>
                    <div class="block">
                        <div class="xl:grid grid-cols-3 text-sm mb-3">
                            <span class="text-gray-500">Bank</span>
                            <div class="text-gray-10 col-span-2 flex">
                                <span class="mr-2 hidden xl:block">:</span>
                                <p>{{ $setting->bank_name }}</p>
                            </div>
                        </div>
                        <div class="xl:grid grid-cols-3 text-sm mb-3">
                            <span class="text-gray-500">No. Rekening</span>
                            <div class="text-gray-10 col-span-2 flex">
                                <span class="mr-2 hidden xl:block">:</span>
                                <p>{{ $setting->bank_account }}</p>
                            </div>
                        </div>
                        <div class="xl:grid grid-cols-3 text-sm mb-3">
                            <span class="text-gray-500">Atas Nama</span>
                            <div class="text-gray-10 col-span-2 flex">
                                <span class="mr-2 hidden xl:block">:</span>
                                <p>{{ $setting->bank_account_name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 mb-4"></div>
                    <h4 class="text-md font-semibold text-gray-900 dark:text-white">
                        Rincian Pembayaran
                    </h4>
                    <div class="xl:flex justify-between text-sm">
                        <span class="text-gray-500">Metode Pembayaran</span>
                        <span class="text-gray-500 capitalize" id="labelPaymentMethod">-</span>
                    </div>
                    <div class="border-t border-gray-100 mb-4"></div>
                    <div class="xl:flex justify-between block text-sm">
                        <span class="text-gray-500">Total Harga</span>
                        <span class="text-gray-500" id="labelSubTotal">-</span>
                    </div>
                    <div class="xl:flex justify-between block text-sm">
                        <span class="text-gray-500">Total Ongkos Kirim</span>
                        <span class="text-gray-500" id="labelDeliveryPrice">-</span>
                    </div>
                    {{-- divider --}}
                    <div class="border-t border-gray-100 mb-4"></div>
                    <div class="lg:flex justify-between">
                        <h4 class="text-md font-semibold text-gray-900 dark:text-white">
                            Total
                        </h4>
                        <h4 class="text-md font-semibold text-gray-900 dark:text-white">
                            Rp.<span id="labelTotal"></span>
                        </h4>
                    </div>
                </div>
            </label>
        </label>

        @push('js-internal')
            <script>
                function priceFormat(price) {
                    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }

                function detailOrder(id) {
                    let url = '{{ route('admin.delivery-order.show', ':id') }}';
                    url = url.replace(':id', id);
                    $.ajax({
                        type: 'GET',
                        url: url,
                        dataType: "JSON",
                        success: function(response) {
                            $('input[name=id]').val(response.id);
                            $('#labelStatus').html(response.status == 0 && response.payment_at == null ?
                                'Silahkan upload bukti pembayaran' : response.status == 0 && response.payment_at !=
                                null ? 'Menunggu konfirmasi pembayaran' : response.status == 1 ?
                                'Pesanan sedang diproses' : response.status == 2 ? 'Pesanan sedang dikirim' :
                                response.status == 3 ? 'Pesanan telah diterima' : response.status == 4 ?
                                'Pesanan telah dibatalkan' : '-');
                            $('#labelInvoice').html(response.invoice);
                            let delivery_date = new Date(response.delivery_date);
                            let date = delivery_date.toLocaleDateString('id-ID', {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            $('#labelDeliveryDate').html(date);
                            $('#labelReceiver').html(response.customer_name);
                            $('#labelPhone').html(response.delivery_phone);
                            $('#labelAddress').html(response.delivery_address);
                            $('#labelNote').html(response.delivery_note);
                            $('#labelPaymentMethod').html(response.payment_method);
                            $('#labelSubTotal').html('Rp.' + priceFormat(response.sub_total));
                            // TODO: add delivery price
                            $('#labelDeliveryPrice').html('Rp.-');
                            $('#labelTotal').html(priceFormat(response.total_payment));
                            if (response.status == 0 && response.payment_proof == null) {
                                $('#labelProof').html('Kamu belum melakukan pembayaran');
                                $('#paymentProofContainer').removeClass('hidden');
                                $('input[name="proof"]').prop('type', 'file')
                                $('input[name="proof"]').prop('required', 'required')
                            } else if (response.status == 0 && response.payment_at != null) {
                                $('#labelProof').html('Menunggu konfirmasi pembayaran');
                                $('#paymentProofContainer').addClass('hidden');
                                $('input[name="proof"]').prop('type', 'hidden');
                                $('#labelProof').html(`
                                    <x-link-button route="{{ asset('storage/payment_proof') }}/${response.payment_proof}" class="bg-primary">
                                        Lihat Bukti Pembayaran
                                    </x-link-button>
                                `);
                            } else if (response.status == 1) {
                                $('#labelProof').html('Pesanan sedang diproses');
                                $('#paymentProofContainer').addClass('hidden');
                                $('input[name="proof"]').prop('type', 'hidden');
                                $('#labelProof').html(`
                                    <x-link-button route="{{ asset('storage/payment_proof') }}/${response.payment_proof}" class="bg-primary">
                                        Lihat Bukti Pembayaran
                                    </x-link-button>
                                `);
                            } else if (response.status == 2) {
                                $('#labelProof').html('Pesanan sedang dikirim');
                                $('#paymentProofContainer').addClass('hidden');
                                $('input[name="proof"]').prop('type', 'hidden');
                                $('#labelProof').html(`
                                    <x-link-button route="{{ asset('storage/payment_proof') }}/${response.payment_proof}" class="bg-primary">
                                        Lihat Bukti Pembayaran
                                    </x-link-button>
                                `);
                            } else if (response.status == 3) {
                                $('#labelProof').html('Pesanan telah diterima');
                                $('#paymentProofContainer').addClass('hidden');
                                $('input[name="proof"]').prop('type', 'hidden');
                                $('#labelProof').html(`
                                    <x-link-button route="{{ asset('storage/payment_proof') }}/${response.payment_proof}" class="bg-primary">
                                        Lihat Bukti Pembayaran
                                    </x-link-button>
                                `);
                            } else if (response.status == 4) {
                                $('#labelProof').html('Pesanan telah dibatalkan');
                                $('#paymentProofContainer').addClass('hidden');
                                $('input[name="proof"]').prop('type', 'hidden');
                            }
                        }
                    });
                }

                function cancelOrder(id) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Apakah kamu yakin?',
                        text: 'Pesanan akan dibatalkan',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, batalkan!',
                        confirmButtonColor: '#d33',
                        cancelButtonText: 'Tidak',
                        cancelButtonColor: '#3D4451',
                        reverseButtons: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let url = '{{ route('admin.delivery-order.cancel-order') }}';
                            $.ajax({
                                type: 'POST',
                                url: url,
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    id: id
                                },
                                success: function(response) {
                                    if (response.status == 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            text: response.message,
                                            showConfirmButton: false,
                                            timer: 1500
                                        }).then(() => {
                                            location.reload();
                                        })
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal',
                                            text: response.message,
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                    }
                                }
                            });
                        }
                    });
                }

                $(function() {
                    $('#orderList').html(
                        '<div></div><div class="my-8 flex justify-center items-center"><div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-10 w-10"></div><div></div>'
                    );
                    $.ajax({
                        url: '{{ route('admin.delivery-order.list') }}',
                        type: 'GET',
                        success: function(response) {
                            $('#orderList').html(response);
                        }
                    });
                    $('#search').keypress(function(e) {
                        let key = (e.keyCode ? e.keyCode : e.which);
                        if (key == '13') {
                            let val = $(this).val();
                            $.ajax({
                                url: '{{ route('admin.delivery-order.search') }}',
                                type: 'GET',
                                data: {
                                    keyword: val
                                },
                                success: function(response) {
                                    $('#orderList').html(response);
                                }
                            })
                        }
                    });

                    $('select#status').on('change', function(e) {
                        e.preventDefault();
                        let val = $(this).val();
                        $.ajax({
                            url: '{{ route('admin.delivery-order.filter.status') }}',
                            type: 'GET',
                            data: {
                                status: val
                            },
                            success: function(response) {
                                $('#orderList').html(response);
                            }
                        });
                        return false;
                    });

                    $('#btnFilterRange').on('click', function(e) {
                        let startDate = $('#startDate').val();
                        let endDate = $('#endDate').val();

                        $.ajax({
                            url: '{{ route('admin.delivery-order.filter.range-date') }}',
                            type: 'GET',
                            data: {
                                start_date: startDate,
                                end_date: endDate
                            },
                            success: function(response) {
                                $('#orderList').html(response);
                            }
                        });
                    });

                    $('#period').on('change', function(e) {
                        let val = $(this).val();
                        $.ajax({
                            url: '{{ route('admin.delivery-order.filter.period') }}',
                            type: 'GET',
                            data: {
                                period: val
                            },
                            success: function(response) {
                                $('#orderList').html(response);
                            }
                        });
                    });

                    $('select#sort').on('change', function(e) {
                        e.preventDefault();
                        let val = $(this).val();
                        $.ajax({
                            url: '{{ route('admin.delivery-order.filter.sort-by') }}',
                            type: 'GET',
                            data: {
                                sort_by: val
                            },
                            success: function(response) {
                                $('#orderList').html(response);
                            }
                        });
                    });

                    $('input[name="proof"]').on('change', function(e) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Peringatan',
                            text: 'Apakah anda yakin ingin melakukan konfirmasi pembayaran? Perhatian, konfirmasi pembayaran tidak dapat dibatalkan atau diubah!',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, saya yakin',
                            confirmButtonColor: '#19743b',
                            cancelButtonText: 'Batal',
                            cancelButtonColor: '#9a9a9a',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let formData = new FormData();
                                formData.append('_token', '{{ csrf_token() }}');
                                formData.append('id', $('input[name=id]').val());
                                formData.append('proof', $(this).prop('files')[0]);

                                $.ajax({
                                    url: '{{ route('admin.delivery-order.confirm-payment') }}',
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        if (response.status == 'success') {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                text: response.message,
                                            }).then((result) => {
                                                window.location.reload();
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: response.message,
                                            });
                                        }
                                    },
                                });
                            }
                        });
                    });
                });

                @if (Session::has('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{{ Session::get('success') }}',
                    });
                @endif

                @if (Session::has('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ Session::get('error') }}',
                    });
                @endif
            </script>
        @endpush
    @else
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
                <h1
                    class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-3xl dark:text-white">
                    Nampaknya anda belum login
                </h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-lg sm:px-16 lg:px-48 dark:text-gray-400">
                    Silahkan login terlebih dahulu untuk melanjutkan pemesanan
                </p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-2">
                    <x-link-button route="{{ route('login') }}" class="bg-primary">
                        Masuk
                    </x-link-button>
                    <x-link-button route="{{ route('register') }}" color="gray">
                        Daftar
                    </x-link-button>
                </div>
            </div>
        </section>
    @endif
</x-guest-layout>
