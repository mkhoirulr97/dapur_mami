<x-app-layout>
    <x-breadcrumbs name="dashboard" />
    <div class="lg:flex justify-between items-center">
        <h1 class="font-semibold text-2xl my-8">Halaman Utama</h1>
        <h2 class="text-lg" id="currentDate"></h2>
    </div>

    <div class="lg:flex gap-x-3">
        <div class="lg:w-2/5">
            <x-card-container>
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold">Penjualan Harian</h3>
                    <span class="dateLabel"></span>
                    <select id="totalSalesHourlySelect"
                        class="block max-w-auto p-2 text-sm text-gray-900 border border-gray-300 rounded-lg  focus:ring-primary focus:border-primary">
                        <option value="day">Hari Ini</option>
                        <option value="week">Mingguan</option>
                        <option value="month">Bulanan</option>
                        <option value="year">Tahunan</option>
                        <option value="all" selected>Semua</option>
                    </select>
                </div>
                <div style="height: 317px">
                    <canvas id="dailySalesChart"></canvas>
                </div>
            </x-card-container>
        </div>
        <div class="lg:w-2/5">
            <x-card-container>
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold">Total Pendapatan</h3>
                    <select id="totalSalesTypeOfMenuSelect"
                        class="block max-w-auto p-2 text-sm text-gray-900 border border-gray-300 rounded-lg  focus:ring-primary focus:border-primary">
                        <option value="day">Hari Ini</option>
                        <option value="week">Mingguan</option>
                        <option value="month">Bulanan</option>
                        <option value="year">Tahunan</option>
                        <option value="all" selected>Semua</option>
                    </select>
                </div>
                <div style="height: 300px" class="relative">
                    <canvas id="totalIncomeChart" class="absolute z-10"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="flex flex-col items-center sm:mb-12 mb-14">
                            <span class="text-gray-500">Rupiah</span>
                            <span class="sm:text-xl text-lg font-semibold" id="totalIncome">-</span>
                        </div>
                    </div>
                </div>
            </x-card-container>
        </div>
        <div class="lg:w-1/5 flex justify-between flex-col lg:h-[350px]">
            <x-card-container>
                <div class="flex gap-x-2 items-center">
                    <!-- make rectangle with icon -->
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold">
                            Total Pemesanan
                        </h3>
                        <span class="text-gray-500">
                            +<span id="totalOrderToday"></span>
                        </span>
                    </div>
                </div>
                <div class="text-center mt-7">
                    <h3 class="text-4xl font-semibold" id="totalOrder"></h3>
                    <div class="w-full bg-gray-200 rounded-full h-1 dark:bg-gray-700 mt-5 mb-3">
                        <div class="bg-green-600 h-1 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
            </x-card-container>
            <x-card-container>
                <div class="flex gap-x-2 items-center">
                    <!-- make rectangle with icon -->
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold">
                            Total Pelanggan
                        </h3>
                        <span class="text-gray-500">
                            +<span id="totalCustomerToday"></span>
                        </span>
                    </div>
                </div>
                <div class="text-center mt-7">
                    <h3 class="text-4xl font-semibold" id="totalCustomer"></h3>
                    <div class="w-full bg-gray-200 rounded-full h-1 dark:bg-gray-700 mt-5 mb-3">
                        <div class="bg-green-600 h-1 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
            </x-card-container>
        </div>
    </div>

    <div class="lg:flex gap-x-3">
        <div class="lg:w-2/5">
            <x-card-container>
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold">Menu Favorit</h3>
                    {{-- <select id="favoriteMenuSelect"
                        class="block max-w-auto p-2 text-sm text-gray-900 border border-gray-300 rounded-lg  focus:ring-primary focus:border-primary">
                        <option value="day">Harian</option>
                        <option value="week">Mingguan</option>
                        <option value="month">Bulanan</option>
                    </select> --}}
                </div>
                <div class="flex justify-between mt-4">
                    <div class="flex">
                        <span class="font-medium text-gray-600 mr-2">Nomor</span>
                        <span class="font-medium text-gray-600">Nama Menu</span>
                    </div>
                    <span class="font-medium text-gray-600">Jumlah Pesanan</span>
                </div>
                {{-- divider --}}
                <div class="border-b border-gray-200 my-2"></div>
                {{-- Data Menu --}}
                @foreach ($favoriteMenu as $fm)
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <span class="font-semibold text-md mr-11">
                                {{ $loop->iteration }}
                            </span>
                            <div class="flex items-center gap-x-3 my-2">
                                <div class="avatar">
                                    <div class="w-12 rounded-xl rounded">
                                        <img src="{{ $fm->menu->image ? asset($fm->menu->image) : asset('images/menu/default.jpg') }}"
                                            alt="">
                                    </div>
                                </div>
                                <div>
                                    <span class="badge badge-primary badge-sm">
                                        {{ $fm->menu->getCategoryNameAttribute() }}
                                    </span>
                                    <h3 class="font-semibold mt-1 text-md">
                                        {{ $fm->menu->name }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <span class="font-semibold text-md">
                            {{ $fm->total_quantity }}
                        </span>
                    </div>
                @endforeach
            </x-card-container>
        </div>
        <div class="lg:w-3/5">
            <x-card-container>
                <h3 class="font-semibold mb-4">Transaksi Terbaru</h3>
                <table class="w-full" id="recentOrderTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pelanggan</th>
                            <th>Invoice</th>
                            <th>No. Pesanan</th>
                            <th>Total Bayar</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                </table>
            </x-card-container>
        </div>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                setInterval(() => {
                    // dont use moment.js
                    $('#currentDate').html(new Date().toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                        second: 'numeric'
                    }) + ' WIB');
                }, 1000);

                $('#favoriteMenuSelect').select2({
                    width: 'resolve'
                });

                $('#recentOrderTable').DataTable({
                    responsive: true,
                    autoWidth: false,
                    serverSide: true,
                    ajax: "{{ route('admin.dashboard') }}",
                    columns: [{
                            className: 'dt-control',
                            orderable: false,
                            data: null,
                            defaultContent: ''
                        },
                        {
                            data: 'customer',
                            name: 'customer'
                        },
                        {
                            data: 'invoice',
                            name: 'invoice'
                        },
                        {
                            data: 'order_number',
                            name: 'order_number'
                        },
                        {
                            data: 'total_payment',
                            name: 'total_payment'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'menu',
                            name: 'menu',
                            className: 'none'
                        },
                    ]
                });

                $('#totalSalesHourlySelect').on('change', function() {
                    let value = $(this).val();
                    if (value == 'day') {
                        // set current date dont using moment
                        $('.dateLabel').text(new Date().toLocaleDateString('id-ID', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        }));
                    } else if (value == 'week') {
                        // show this week dont using moment
                        // start date of this week (sunday), end date of this week (saturday)
                        let startOfWeek = new Date();
                        startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay());
                        let endOfWeek = new Date();
                        endOfWeek.setDate(endOfWeek.getDate() + (6 - endOfWeek.getDay()));
                        $('.dateLabel').text(`${startOfWeek.toLocaleDateString('id-ID', {
                            day: 'numeric'
                        })} - ${endOfWeek.toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        })}`);
                    }

                    if (value == 'month') {
                        // show this month
                        $('.dateLabel').text(new Date().toLocaleDateString('id-ID', {
                            month: 'long',
                            year: 'numeric'
                        }));
                    }

                    if (value == 'year') {
                        // show this year
                        $('.dateLabel').text(new Date().toLocaleDateString('id-ID', {
                            year: 'numeric'
                        }));
                    }

                    $.ajax({
                        type: "GET",
                        url: "{{ route('dashboard.total-sales-hourly') }}",
                        data: {
                            type: value
                        },
                        dataType: "json",
                        success: function(response) {
                            let totalSalesHourly = response;
                            dailySalesChart.data.datasets[0].data = totalSalesHourly;
                            dailySalesChart.update();
                        }
                    });
                });

                $('#totalSalesTypeOfMenuSelect').on('change', function() {
                    let value = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: "{{ route('dashboard.total-sales-type-of-menu') }}",
                        data: {
                            type: value
                        },
                        dataType: "json",
                        success: function(response) {
                            let totalSalesTypeOfMenu = response.totalSalesTypeOfMenu;
                            totalIncomeChart.data.datasets[0].data = totalSalesTypeOfMenu;
                            totalIncomeChart.update();

                            let totalIncome = response.totalIncome;
                            $('#totalIncome').text(formatIncome(totalIncome));
                        }
                    });
                });
            });

            let totalSalesHourly = @json($totalSalesHourly);
            let totalSalesTypeOfMenu = @json($totalSalesTypeOfMenu);
            let totalIncome = @json($totalIncome);
            let totalOrder = @json($totalOrder);
            let totalOrderToday = @json($totalOrderToday);
            let totalCustomer = @json($totalCustomer);
            let totalCustomerToday = @json($totalCustomerToday);
            let favoriteMenu = @json($favoriteMenu);

            $('#totalIncome').text(
                formatIncome(totalIncome)
            );

            $('#totalOrder').text(totalOrder);
            $('#totalOrderToday').text(totalOrderToday == null ? 0 : totalOrderToday);

            $('#totalCustomer').text(totalCustomer);
            $('#totalCustomerToday').text(totalCustomerToday == null ? 0 : totalCustomerToday);
        </script>
        <script src="{{ asset('js/daily-sales.js') }}"></script>
        <script src="{{ asset('js/total-income.js') }}"></script>
    @endpush
</x-app-layout>
