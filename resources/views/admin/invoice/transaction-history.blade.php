<x-app-layout>
    <x-breadcrumbs name="transaction-history" />
    <h1 class="font-semibold text-2xl my-8">Riwayat Pemesanan</h1>

    <x-card-container>
        <h1 class="mb-4">Filter Transaksi</h1>

        <div class="lg:flex gap-x-3">
            <x-select id="filterType">
                <option value="month" selected>Bulanan</option>
                <option value="date">Tanggal</option>
            </x-select>
            <div id="filterMonth">
                <x-select id="monthOptionFilter">
                    <option value="Semua" selected>Semua</option>
                    @foreach ($months as $month)
                        <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
                </x-select>
            </div>
            {{-- TODO: tambah hidden di class-nya --}}
            <div id="filterRange" class="items-center hidden">
                <div date-rangepicker class="flex items-center">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input name="startDate" type="text"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-800 focus:border-green-800 block w-full pl-10 p-2.5"
                            placeholder="Pilih tanggal mulai">
                    </div>
                    <span class="mx-4 text-gray-500">sampai</span>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input name="endDate" type="text"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-800 focus:border-green-800 block w-full pl-10 p-2.5"
                            placeholder="Pilih tanggal berakhir">
                    </div>
                </div>
                <x-button type="button" id="filterRangeBtn" class="bg-primary ml-3">
                    Jalankan Filter
                </x-button>
            </div>
        </div>
    </x-card-container>
    <div class="stats w-full my-5">

        {{-- <div class="stat">
            <div class="stat-figure text-secondary">
                <i class="fas fa-money-bill-wave-alt h-8 w-8 inline-block"></i>
            </div>
            <div class="stat-title">Total Pendapatan</div>
            <div class="stat-value" id="totalSales">{{
                number_format($totalSales, 0, ',', '.')
            }}</div>
            <div class="stat-desc hidden" id="totalSalesPeriod">Jan 1st - Feb 1st</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-8 h-8 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                    </path>
                </svg>
            </div>
            <div class="stat-title">New Users</div>
            <div class="stat-value">4,200</div>
            <div class="stat-desc">↗︎ 400 (22%)</div>
        </div>

        <div class="stat">
            <div class="stat-figure text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-8 h-8 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                </svg>
            </div>
            <div class="stat-title">New Registers</div>
            <div class="stat-value">1,200</div>
            <div class="stat-desc">↘︎ 90 (14%)</div>
        </div> --}}

    </div>

    <x-card-container>

        <div class="overflow-x-auto" id="transactionTableContainer">
            <table class="w-full" id="transactionTable">
                <thead>
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Invoice</th>
                        <th>Pelanggan</th>
                        <th>Menu</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                    </tr>
                </thead>
            </table>
        </div>
    </x-card-container>

    @push('js-internal')
        <script>
            function btnPrint() {
                window.print();
            }

            $(function() {
                $('#transactionTable thead tr')
                    .clone(true)
                    .addClass('filters')
                    .appendTo('#example thead');

                $('#transactionTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: "{{ route('admin.transaction-history') }}",
                    columns: [{
                            data: 'invoice',
                            name: 'invoice'
                        },
                        {
                            data: 'customer',
                            name: 'customer'
                        },
                        {
                            data: 'menu',
                            name: 'menu'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'user',
                            name: 'user'
                        }
                    ],
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        title: 'Data export'
                    }, {
                        extend: 'pdfHtml5',
                        title: 'Data export'
                    }, {
                        // filter status
                        extend: 'collection',
                        text: 'Filter Status',
                        buttons: [{
                                text: 'Semua',
                                action: function(e, dt, node, config) {
                                    dt.search('').draw();
                                }
                            },
                            {
                                text: 'Menunggu',
                                action: function(e, dt, node, config) {
                                    dt.search('Menunggu').draw();
                                }
                            },
                            {
                                text: 'Dibayar',
                                action: function(e, dt, node, config) {
                                    dt.search('Dibayar').draw();
                                }
                            },
                            {
                                text: 'Dibatalkan',
                                action: function(e, dt, node, config) {
                                    dt.search('Dibatalkan').draw();
                                }
                            }
                        ]
                    }]
                });
                $('#filterType').on('change', function() {
                    let val = $(this).val();
                    if (val == 'date') {
                        $('#filterRange').removeClass('hidden').addClass('flex');
                        $('#filterMonth').addClass('hidden')
                    } else {
                        $('#filterRange').addClass('hidden').removeClass('flex');
                        $('#filterMonth').removeClass('hidden');
                    }
                });

                $('#monthOptionFilter').on('change', function() {
                    let month = $(this).val();
                    // translate to english month
                    switch (month) {
                        case 'Januari':
                            month = 'January'
                            break;
                        case 'Februari':
                            month = 'February'
                            break;
                        case 'Maret':
                            month = 'March'
                            break;
                        case 'April':
                            month = 'April'
                            break;
                        case 'Mei':
                            month = 'May'
                            break;
                        case 'Juni':
                            month = 'June'
                            break;
                        case 'Juli':
                            month = 'July'
                            break;
                        case 'Agustus':
                            month = 'August'
                            break;
                        case 'September':
                            month = 'September'
                            break;
                        case 'Oktober':
                            month = 'October'
                            break;
                        case 'November':
                            month = 'November'
                            break;
                        case 'Desember':
                            month = 'December'
                            break;
                        case 'Semua':
                            month = ''
                            break;
                    }
                    $('#transactionTable').DataTable().search(month ?? '').draw();
                })

                $('#filterRangeBtn').on('click', function(e) {
                    e.preventDefault();
                    let start = $('input[name="startDate"]').val();
                    let end = $('input[name="endDate"]').val();

                    $.ajax({
                        url: '{{ route('admin.transaction-history.filter.date-range') }}',
                        type: 'GET',
                        data: {
                            start_date: start,
                            end_date: end
                        },
                        success: function(data) {
                            $('#transactionTable').DataTable().clear().destroy();
                            $('#transactionTable').DataTable({
                                processing: true,
                                autoWidth: false,
                                data: data,
                                columns: [{
                                        data: 'invoice',
                                        name: 'invoice'
                                    },
                                    {
                                        data: 'customer',
                                        name: 'customer'
                                    },
                                    {
                                        data: 'menu',
                                        name: 'menu'
                                    },
                                    {
                                        data: 'quantity',
                                        name: 'quantity'
                                    },
                                    {
                                        data: 'total',
                                        name: 'total'
                                    },
                                    {
                                        data: 'status',
                                        name: 'status'
                                    },
                                    {
                                        data: 'created_at',
                                        name: 'created_at'
                                    },
                                    {
                                        data: 'user',
                                        name: 'user'
                                    }
                                ],
                                dom: 'Bfrtip',
                                buttons: [{
                                    extend: 'excelHtml5',
                                    title: 'Data export'
                                }, {
                                    extend: 'pdfHtml5',
                                    title: 'Data export'
                                }, {
                                    // filter status
                                    extend: 'collection',
                                    text: 'Filter Status',
                                    buttons: [{
                                            text: 'Semua',
                                            action: function(e, dt, node,
                                                config) {
                                                dt.search('').draw();
                                            }
                                        },
                                        {
                                            text: 'Menunggu',
                                            action: function(e, dt, node,
                                                config) {
                                                dt.search('Menunggu')
                                                    .draw();
                                            }
                                        },
                                        {
                                            text: 'Dibayar',
                                            action: function(e, dt, node,
                                                config) {
                                                dt.search('Dibayar').draw();
                                            }
                                        },
                                        {
                                            text: 'Dibatalkan',
                                            action: function(e, dt, node,
                                                config) {
                                                dt.search('Dibatalkan')
                                                    .draw();
                                            }
                                        }
                                    ]
                                }]
                            });
                        }
                    })
                });
            });
        </script>
    @endpush
</x-app-layout>
