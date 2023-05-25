<x-app-layout>
    <x-breadcrumbs name="menu" />
    <h1 class="font-semibold text-2xl my-8">Makanan & Minuman</h1>

    <div class="lg:flex gap-x-3">
        <div class="lg:w-full" id="listMenu">
            <div class="sm:block xl:flex justify-between items-center">
                <x-select id="category" name="category" label="Kategori Menu">
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                    <option value="all">Semua</option>
                </x-select>
                {{-- search --}}
                <div class="flex gap-x-3">
                    <div class="relative mt-6">
                        <input type="text" id="searchMenu"
                            class="w-64 text-sm px-4 py-2 text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-300 focus:border-transparent"
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
            {{-- Menu Item --}}
            <div class="grid sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-4 gap-x-4 gap-y-6 mt-8" id="menuList">
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
                                <p>
                                    <span class="inline-block align-text-bottom text-sm">Rp</span>
                                    {{ number_format($menu->price, 0, ',', '.') }}
                                </p>
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
                <input type="text" name="name" id="name"
                    class="w-full text-sm px-4 py-2 text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:border-transparent"
                    placeholder="Nama Pelanggan" />
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

    {{-- Modal Confirmation Order --}}
    <input type="checkbox" id="confirmOrderModal" class="modal-toggle" />
    <label class="modal">
        <label class="modal-box relative" for="">
            <h3 class="text-lg font-bold">Detail Pesanan</h3>
            <p class="py-4">
            <h3 class="font-semibold mb-4">Informasi Acara</h3>
            <ul class="mb-8 space-y-2 text-left text-gray-500 dark:text-gray-400">
                <li class="flex items-center space-x-3">
                    <span class="flex-shrink-0">Nama Pelanggan:</span>
                    <span class="flex-1 text-right font-semibold" id="confirmCustomerName"></span>
                </li>
                <li class="flex items-center space-x-3">
                    <span class="flex-shrink-0">Tanggal:</span>
                    <span class="flex-1 text-right font-semibold" id="confirmDate"></span>
                </li>
                <li class="flex items-center space-x-3">
                    <span class="flex-shrink-0">Waktu:</span>
                    <span class="flex-1 text-right font-semibold" id="confirmTime"></span>
                </li>
            </ul>
            <div class="border-t border-gray-200 my-4"></div>
            <h3 class="font-semibold mb-3">Menu</h3>
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
            let customerName = '';
            let dt = new Date();
            let date = dt.getDate() + '/' + (dt.getMonth() + 1) + '/' + dt.getFullYear();
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

                customerName = $('input[name="name"]').val();

                // check if customer name is empty
                if (customerName === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Nama pelanggan tidak boleh kosong!',
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

                console.log(cart, subTotal, total);

                $('#btnConfirmOrder').removeClass('hidden');

                $('#confirmCustomerName').text(customerName);
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
                $.ajax({
                    url: "{{ route('admin.invoice.store') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        customer_name: customerName,
                        cart: cart,
                        sub_total: subTotal,
                        total: total
                    },
                    success: function(data) {
                        if (data == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Pesanan berhasil dibuat!',
                            })
                            window.location.href = "{{ route('admin.invoice.index') }}";
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Pesanan gagal dibuat!',
                            })
                        }
                    }
                });
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
            });
        </script>
    @endpush
</x-app-layout>
