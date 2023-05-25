<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Alert -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .dt-buttons,
        #transactionTable_filter {
            margin-bottom: 10px;
        }

        /* set width of scroll bar */
        ::-webkit-scrollbar {
            width: 0px;
        }
    </style>

    <!-- Toastr -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

</head>

<body class="font-sans antialiased text-xs 2xl:text-sm overflow-hidden">
    <div class="bg-white-200">
        @include('admin.layouts.navigation')
        @include('admin.layouts.sidebar')

        <div class="p-4 sm:ml-64 h-screen overflow-y-auto">
            <div class="p-4">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Datatable -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.jqueryui.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.jshttps://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js">
    </script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>

    <!-- Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    <!-- Chart Js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Pusher -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;
        var pusher = new Pusher('2f313d094d056ab959ee', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('popup-channel');
        channel.bind('new-order', function(data) {
            toastr.success('Pesanan baru', JSON.stringify(data.invoice), {
                timeOut: 5000,
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right'
            });
        });
        channel.bind('new-user-login', function(data) {
            toastr.success(JSON.stringify(data.name), 'New User Login', {
                timeOut: 5000,
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right'
            });
        });
    </script>

    <script>
        Chart.defaults.font.family = 'Lexend Deca';
        Chart.defaults.scale.grid.display = false;
        $('input[type="search"]').addClass('text-sm');

        function formatTanggal(tanggal) {
            // 02-01-2021
            return tanggal.split('T')[0].split('-').reverse().join('-');
        }

        function formatRupiah(angka, prefix) {
            return prefix == undefined ? 'Rp. ' + angka.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') :
                prefix + angka.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        }

        function formatIncome(angka) {
            // convert 0 = 3 = K, 6 = M, 9 = B
            var number_string = angka.toString().replace(/[^,\d]/g, '');
            // hitung jumlah angka 0 di belakang
            var count = number_string.length - 1;
            // hitung jumlah angka 0 di belakang dibagi 3
            var count3 = count / 3;
            // hitung jumlah angka 0 di belakang dibagi 3 dibulatkan ke bawah
            var count3floor = Math.floor(count3);
            return count3floor == 0 ? formatRupiah(angka) : formatRupiah(angka / Math.pow(10, count3floor * 3)) + ['', ' K',
                ' Jt', ' M'
            ][count3floor];
        }

        // set all tag <a> with cursor-pointer
        $('a').addClass('cursor-pointer');

        $('select').select2();
    </script>

    @stack('js-internal')
</body>

</html>
