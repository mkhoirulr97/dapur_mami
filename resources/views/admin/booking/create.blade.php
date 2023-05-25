<x-app-layout>
    <x-breadcrumbs name="booking.create" />
    <h1 class="font-semibold text-2xl my-8">Tambah Reservasi</h1>

    <x-card-container>
        <form action="{{ route('admin.booking.store') }}" method="POST">
            @csrf
            <p class="font-semibold text-lg mb-3">Informasi Acara</p>
            <div class="xl:grid grid-cols-2 gap-x-3">
                <x-input id="event_name" label="Nama Acara" placeholder="Masukan nama" name="event_name" type="text" />
                <x-input-single-datepicker label="Tanggal Reservasi" id="booking_date" name="booking_date"
                    autocomplete="off" />
            </div>
            <div class="xl:grid grid-cols-2 gap-x-3">
                <x-input id="total_guest" label="Jumlah Tamu (Orang)" name="total_guest" type="number" />
                <x-input id="booking_time" label="Waktu" placeholder="Masukan waktu" name="booking_time"
                    type="time" />
            </div>
            <div class="flex justify-end">
                <x-button type="button" id="btnCheck" class="text-end">
                    Cek Ketersediaan Tempat
                </x-button>
            </div>
        </form>
    </x-card-container>

    <p class="font-semibold text-lg mb-3 mt-4">Detail Pesanan</p>
    <div class="flex gap-x-3 hidden" id="detailOrderForm">
        <div class="lg:w-full" id="listMenu">
            {{-- Menu Item --}}
            <div class="xl:grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-6 mt-8" id="menuList">
                @forelse ($menus as $menu)
                    <div onclick="addCart({{ $menu->id }} , {{ $menu->price }})" id="menu-{{ $menu->id }}"
                        class="w-full bg-white h-fit rounded-2xl shadow-xl hover:shadow-2xl">
                        <a href="#">
                            <img class="rounded-t-lg w-full h-48 object-cover object-center"
                                src="{{ $menu->image ? asset($menu->image) : asset('images/menu/default.jpg') }}" />
                        </a>
                        <div class="px-5 pb-5 mt-4">
                            <a>
                                <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ $menu->name }}</h5>
                            </a>
                            <p class="mt-2 text-gray-600 dark:text-gray-400 my-4 truncate hover:">
                                {{ $menu->weight }} gram
                            </p>
                            <div class="flex items-end justify-between">
                                <span
                                    class="flex md:text-lg lg:text-xl xl:text-lg font-bold text-gray-900 dark:text-white">
                                    Rp. {{ number_format($menu->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Tidak ada menu</p>
                @endforelse
            </div>
        </div>
        <div class="lg:w-1/4 hidden" id="detailOrder">
            <x-card-container>
                <div class="flex justify-between mt-3">
                    <h3 class="font-semibold text-sm">Tanggal</h3>
                    <h3 class="text-sm">{{ date('d/m/Y') }}</h3>
                </div>
                <div class="flex justify-between mt-2">
                    <h3 class="font-semibold text-sm">Jam</h3>
                    <h3 class="text-sm">{{ date('d-m-y h:i:s') }}</h3>
                </div>
                <div id="cartList"></div>

                <div class="border-t border-gray-200 my-4"></div>

                <div class="flex justify-between my-4">
                    <h3 class="font-semibold text-sm">Sub Total</h3>
                    <h3 class="font-semibold text-sm" id="subTotal">0</h3>
                </div>

                <div class="border-t border-gray-200 my-4"></div>

                <div class="flex justify-between">
                    <h3 class="font-semibold text-sm">Total</h3>
                    <h3 class="font-semibold text-sm" id="total">0</h3>
                </div>

                <div class="flex gap-x-2">
                    <button onclick="btnCancel()"
                        class="w-full mt-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fa-solid fa-trash mr-2"></i>
                        Batal
                    </button>
                    <button onclick="btnOrder()"
                        class="w-full text-center mt-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <i class="fa-solid fa-shopping-cart mr-2"></i>
                        Pesan
                    </button>
                </div>
                <label for="confirmOrderModal" id="btnConfirmOrder"
                    class="hidden w-full block text-center mt-2 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Konfirmasi Pesanan
                </label>
            </x-card-container>
        </div>
    </div>

    <input type="checkbox" id="confirmOrderModal" class="modal-toggle" />
    <label for="confirmOrderModal" class="modal cursor-pointer">
        <label class="modal-box relative" for="">
            <h3 class="text-lg font-bold">Detail Reservasi</h3>
            <p class="py-4">
            <h3 class="font-semibold mb-4">Informasi Acara</h3>
            <ul class="mb-8 space-y-2 text-left text-gray-500 dark:text-gray-400">
                <li class="flex items-center space-x-3">
                    <span class="flex-shrink-0">Nama Acara:</span>
                    <span class="flex-1 text-right font-semibold" id="confirmEventName"></span>
                </li>
                <li class="flex items-center space-x-3">
                    <span class="flex-shrink-0">Tanggal:</span>
                    <span class="flex-1 text-right font-semibold" id="confirmDate"></span>
                </li>
                <li class="flex items-center space-x-3">
                    <span class="flex-shrink-0">Waktu:</span>
                    <span class="flex-1 text-right font-semibold" id="confirmTime"></span>
                </li>
                <li class="flex items-center space-x-3">
                    <span class="flex-shrink-0">Jumlah Tamu:</span>
                    <span class="flex-1 text-right font-semibold" id="confirmGuest"></span>
                </li>
            </ul>
            <div class="border-t border-gray-200 my-4"></div>
            {{-- Confirm menu item --}}
            <h3 class="font-semibold mb-4">Menu</h3>
            <ul id="confirmMenu" class="mb-8 space-y-2 text-left text-gray-500 dark:text-gray-400"></ul>

            {{-- border --}}
            <div class="border-t border-gray-200 my-4"></div>

            {{-- Confirm total --}}
            <div class="flex justify-between">
                <h3 class="font-semibold text-sm">Total</h3>
                <h3 class="font-semibold text-sm" id="confirmTotal">0</h3>
            </div>
            </p>

            <div class="modal-action">
                <x-link-button color="gray" onclick="btnCancel()">Batal</x-link-button>
                <x-button color="green" onclick="btnLastConfirmOrder()">Konfirmasi
                    Pesanan</x-button>
            </div>
        </label>
    </label>

    @push('js-internal')
        <script>
            // INFO: BOOKING VARIABLE DECLARATION
            let eventName;
            let totalGuest;
            let bookingDate;
            let booking_time;

            let dt = new Date();
            let date = dt.getDate() + '/' + (dt.getMonth() + 1) + '/' + dt.getFullYear();
            // time format 00:00
            let time = dt.getHours() + ':' + dt.getMinutes();
            let menu = [];

            // INFO: ORDER VARIABLE DECLARATION
            let cart = [];
            let subTotal = 0;
            let total = 0;

            function addCart(id, price) {
                $('#btnConfirmOrder').addClass('hidden');
                // add class border to menu item
                $('#menu-' + id).addClass('outline outline-primary');
                $('#listMenu').removeClass('lg:w-full').addClass('lg:w-3/4');
                $('#detailOrder').removeClass('hidden');
                // check if id is already on cart-item class, if true don't add to cart
                let isExist = $('#cart-item-' + id).length;
                if (isExist) {
                    return false;
                }
                let url = "{{ route('admin.booking.add-cart', ':id') }}";
                $.ajax({
                    url: url.replace(':id', id),
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(data) {
                        $('#cartList').append(data);
                    }
                });

                return false;

            }

            function addQuantity(id) {
                $('#btnConfirmOrder').addClass('hidden');
                let quantity = parseInt($('#cart-item-' + id).data('quantity'));
                let price = parseInt($('#cart-item-' + id).data('price'));

                quantity++;
                $('#cart-item-' + id).data('quantity', quantity.toString());
                $('#cart-item-' + id + ' .quantity').text(quantity);

                subTotal += price;

                $('#subTotal').text(subTotal);

                return false;
            }

            function removeQuantity(id) {
                $('#btnConfirmOrder').addClass('hidden');
                let quantity = parseInt($('#cart-item-' + id).data('quantity'));
                let price = parseInt($('#cart-item-' + id).data('price'));

                if (quantity !== 0) {
                    quantity--;
                    $('#cart-item-' + id).data('quantity', quantity.toString());
                    $('#cart-item-' + id + ' .quantity').text(quantity);

                    subTotal -= price;

                    $('#subTotal').text(subTotal);
                }

                return false;
            }

            function btnOrder() {
                event.preventDefault();

                eventName = $('input[name="event_name"]').val();
                totalGuest = $('input[name="total_guest"]').val();
                bookingDate = $('input[name="booking_date"]').val();
                bookingTime = $('input[name="booking_time"]').val();

                if (eventName == '' || totalGuest == '' || bookingDate == '' || booking_time == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Silahkan lengkapi data acara terlebih dahulu!',
                    })
                    return false;
                }

                cart = [];
                subTotal = 0;
                total = 0;

                // get every element that include cart-item class
                $('.cart-item').each(function() {
                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let quantity = $(this).data('quantity');
                    let price = $(this).data('price');
                    total = price * quantity;

                    cart.push({
                        id: id,
                        name: name,
                        quantity: quantity,
                        price: price,
                        total: total
                    });

                    subTotal += total;
                    total = subTotal;
                });

                let stop = false;

                // check if there's quantity 0 in cart
                cart.forEach(function(item) {
                    if (item.total === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Pesanan tidak boleh kosong!',
                        })

                        stop = true;
                    }
                });

                if (stop) {
                    return false;
                }

                // check if subTotal is 0
                if (subTotal === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pesanan tidak boleh kosong!',
                    })
                    return false;
                }

                $('#subTotal').text(subTotal);
                $('#total').text(subTotal);

                $('#btnConfirmOrder').removeClass('hidden');

                $('#confirmEventName').text(eventName);
                $('#confirmGuest').text(totalGuest);
                $('#confirmDate').text(date);
                $('#confirmTime').text(time);

                // set menu value
                let menuHtml = '';
                cart.forEach(function(item) {
                    menuHtml += '<li class="flex items-center space-x-3">';
                    menuHtml += '<div class="flex-1">';
                    menuHtml += '<h3 class="text-sm font-medium">' + item.name + '</h3>';
                    menuHtml += '<p class="text-sm font-medium text-gray-500">' + item.quantity + ' x ' + formatRupiah(
                        item.price) + '</p>';
                    menuHtml += '</div>';
                    menuHtml += '<span class="flex-1 text-right font-semibold">' + formatRupiah(item.total) + '</span>';
                    menuHtml += '</li>';
                });
                $('#confirmMenu').html(menuHtml);

                // set total value
                $('#confirmTotal').text(formatRupiah(total));

                return false;
            }

            function removeCart(id) {
                $('#btnConfirmOrder').addClass('hidden');
                $('#menu-' + id).removeClass('outline outline-primary');
                let price = parseInt($('#cart-item-' + id).data('price'));
                let quantity = parseInt($('#cart-item-' + id).data('quantity'));
                let total = price * quantity;

                subTotal -= total;
                total -= total;

                $('#subTotal').text(subTotal);
                $('#total').text(subTotal);

                $('#cart-item-' + id).remove();

                return false;
            }

            function btnCancel() {
                location.reload();
                $('#btnConfirmOrder').addClass('hidden');
                $('#detailOrder').addClass('hidden');
                // set class listMenu to 4/4
                $('#listMenu').removeClass('lg:w-3/4').addClass('lg:w-full');

                // remove all cart item and reset total price, and reset array
                $('.cart-item').remove();
                subTotal = 0;
                total = 0;
                $('#subTotal').text(subTotal);
                $('#total').text(subTotal);

                cart = [];

                // uncheck confirm order modal
                $('#confirmOrderModal').prop('checked', false);

                return false;
            }

            function btnLastConfirmOrder() {
                let today = new Date();
                if (today > new Date(bookingDate)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Tanggal acara tidak boleh kurang dari hari ini!',
                    })
                    return false;
                } else {
                    $.ajax({
                        url: "{{ route('admin.booking.store') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            eventName: eventName,
                            totalGuest: totalGuest,
                            bookingDate: bookingDate,
                            bookingTime: bookingTime,
                            cart: cart,
                            sub_total: subTotal,
                            total_payment: total
                        },
                        success: function(data) {
                            if (data == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Pesanan berhasil dibuat!',
                                });
                                window.location.href = "{{ route('admin.booking.index') }}";
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Pesanan gagal dibuat!',
                                });
                            }
                        }
                    });
                }
            }

            $(function() {
                $('#category').select2();
                $('#category').on('change', function(e) {
                    e.preventDefault();
                    let category_id = $(this).val();
                    let url = "{{ route('admin.menu.category', ':id') }}";
                    $.ajax({
                        url: url.replace(':id', category_id),
                        type: "GET",
                        success: function(data) {
                            $('#menuList').html(data);
                        }
                    });
                });

                $('#searchMenu').on('keyup', function(e) {
                    e.preventDefault();
                    let search = $(this).val();
                    let url = "{{ route('admin.menu.search') }}";
                    $.ajax({
                        url: url,
                        type: "GET",
                        data: {
                            search: search
                        },
                        success: function(data) {
                            $('#menuList').html(data);
                        }
                    });
                });

                $('#btnCheck').on('click', function(e) {
                    e.preventDefault();
                    let reservationDate = $('#booking_date').val();
                    let reservationTime = $('#booking_time').val();
                    let reservationGuest = $('#total_guest').val();

                    if (reservationDate != '' && reservationTime != '' && reservationGuest != '') {
                        $.ajax({
                            url: '{{ route('admin.reservation-config.check') }}',
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                booking_date: reservationDate,
                                booking_time: reservationTime,
                                total_guest: reservationGuest
                            },
                            success: function(response) {
                                if (response.data.isFull == true || response.data.isMaxBooking == true && response.data.isAvailable == false || response.data.isBetween == false) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Kuota reservasi sudah penuh! Sisa kuota pada tanggal ' +
                                            reservationDate + ' : ' + response.data
                                            .remainingCapacity + ' orang!' + ' Periksa waktu reservasi!',
                                    });
                                    $('#detailOrderForm').addClass('hidden');
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Kuota reservasi masih tersedia! Silahkan memesan!',
                                    });
                                    $('#detailOrderForm').removeClass('hidden');
                                }
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Mohon lengkapi detail reservasi!',
                        });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
