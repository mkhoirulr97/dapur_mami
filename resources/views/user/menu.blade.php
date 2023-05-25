<x-guest-layout>
    <x-user-header />

    @if (auth()->check())
        @if (
            !\Carbon\Carbon::now()->between(
                \Carbon\Carbon::parse($setting->open_at),
                \Carbon\Carbon::parse($setting->close_at)))
            <section class="w-full mt-10 flex items-center">
                <div class="max-w-screen-xl px-4 mx-auto w-full">
                    <div id="alert-additional-content-5"
                        class="p-4 border border-gray-300 rounded-lg bg-gray-50 dark:border-gray-600 dark:bg-gray-800"
                        role="alert">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-5 h-5 mr-2 text-gray-800 dark:text-gray-300"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Info</span>
                            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-300">
                                Toko Tutup
                            </h3>
                        </div>
                        <div class="mt-2 text-sm text-gray-800 dark:text-gray-300">
                            <p>
                                Toko buka pada pukul {{ \Carbon\Carbon::parse($setting->open_at)->format('H:i') }} WIB
                                dan tutup pada pukul {{ \Carbon\Carbon::parse($setting->close_at)->format('H:i') }} WIB
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        {{-- Search and Filter --}}
        <section class="w-full mt-10 flex items-center">
            <div class="max-w-screen-xl px-4 mx-auto w-full">
                <div class="flex flex-col items-end justify-between py-4 space-y-3 md:flex-row md:space-y-0">
                    <div class="w-full md:w-1/2">
                        <x-input id="search" name="search" label="Pencarian" type="text" class="py-3 mb-1" />
                    </div>
                    <div
                        class="flex flex-col items-end justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-end md:space-x-3">
                        <div class="flex items-center w-full space-x-3 md:w-auto">
                            <x-select label="Harga" id="price">
                                <option value="all" selected>Semua Harga</option>
                                <option value="minmax">Murah - Mahal</option>
                                <option value="maxmin">Mahal - Murah</option>
                            </x-select>
                            <x-select label="Kategori" id="category">
                                <option value="all" selected>Semua Kategori</option>
                                <option value="1">Makanan</option>
                                <option value="2">Minuman</option>
                                <option value="3">Camilan</option>
                            </x-select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- List Menu --}}
        <section class="bg-white">
            <div class="px-4 mx-auto max-w-screen-xl sm:pb-16 sm:pt-4 lg:px-6">
                <div id="listMenu"
                    class="space-y-8 mt-12 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-12 md:space-y-0">
                    @forelse ($products as $product)
                        <div id="menuItem" class="w-full bg-white h-fit rounded-2xl shadow-xl hover:shadow-2xl">
                            <a>
                                <img class="rounded-t-lg w-full h-48 object-cover object-center"
                                    src="{{ $product->image ? asset($product->image) : asset('images/menu/default.jpg') }}" />
                            </a>
                            <div class="px-5 pb-5 mt-4">
                                <a>
                                    <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
                                        {{ $product->name }}
                                    </h5>
                                </a>
                                <p class="mt-1 text-gray-600 text-sm my-4">
                                    {{-- truncate 2 lines --}}
                                    {{ Str::limit($product->description, 50) }}
                                </p>
                                <div class="flex items-end justify-between">
                                    <p id="priceMenu" class="text-green-800 font-medium"><span
                                            class="inline-block align-text-bottom text-sm">Rp</span>
                                        {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                    <p class="text-gray-400 text-sm">
                                        {{ $product->sold ?? '0' }} Terjual
                                    </p>
                                </div>
                                {{-- only show in open at to close at --}}
                                @if (\Carbon\Carbon::now()->between(\Carbon\Carbon::parse($setting->open_at), \Carbon\Carbon::parse($setting->close_at)))
                                    <div class="mt-8">
                                        <x-link-button id="addCart-{{ $product->id }}"
                                            onclick="addCart('{{ $product->id }}')"
                                            class="bg-primary w-full justify-center" data-drawer-target="drawer-example"
                                            data-drawer-show="drawer-example" aria-controls="drawer-example"
                                            data-drawer-body-scrolling="true">
                                            <span id="cartLabel-{{ $product->id }}">
                                                Tambah ke Pesanan
                                            </span>
                                        </x-link-button>
                                    </div>
                                @else
                                @endif
                            </div>
                        </div>
                    @empty
                        <p>
                            Tidak ada menu
                        </p>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Drawer --}}
        <div id="drawer-example"
            class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white xl:w-1/2 dark:bg-gray-800"
            tabindex="-1" aria-labelledby="drawer-label">
            <h5 id="drawer-label"
                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                Detail Pesanan
            </h5>
            <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center">
                <span class="sr-only">Close menu</span>
            </button>
            <div class="xl:grid grid-cols-2 gap-x-6">
                <div>
                    <div id="cartList" class="mb-6"></div>
                    <div class="border-t border-gray-200 dark:border-gray-700 mb-6"></div>
                    <div class="xl:flex justify-between mb-2">
                        <p class="text-gray-500 text-sm">
                            Sub Total
                        </p>
                        <p id="subTotal" class="text-gray-900 text-sm">
                            Rp 0
                        </p>
                    </div>
                    <div class="xl:flex justify-between mb-4">
                        <p class="text-gray-500 text-sm">
                            Total Harga
                        </p>
                        <p id="totalPrice" class="text-gray-900 text-sm">
                            Rp 0
                        </p>
                    </div>
                    <x-link-button onclick="calculateOrder()" class="bg-primary w-full justify-center mb-3">
                        Hitung Total
                    </x-link-button>
                </div>

                <div class="hidden" id="detailOrderForm">
                    <label for="order_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Pilih Metode Pesanan
                    </label>
                    <select id="order_type"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5"
                        name="order_type">
                        <option value="delivery_order" selected>Delivery Order</option>
                        <option value="take_away" disabled>Take Away</option>
                    </select>

                    <div class="my-4"></div>

                    <div id="detailDeliveryOrder">
                        <x-input id="invoice" label="Nomor Invoice" name="invoice" type="text"
                            :value="$invoice" readonly />
                        <x-input readonly id="customer_name" label="Nama Pemesan" name="customer_name"
                            :value="$customer->fullname" type="text" required />
                        <x-input readonly id="delivery_phone" label="Nomor Telepon" name="delivery_phone"
                            :value="$customer->phone" type="text" required />
                            <div class="flex justify-between items-end gap-x-3">
                                <x-select id="regency" name="regency" label="Kabupaten" required>
                                    <option value="Situbondo" selected>Situbondo</option>
                                </x-select>
                            <x-select id="district" name="district" label="Kecamatan" required>
                                <option value="Arjasa" selected>Arjasa</option>
                                <option value="Asembagus">Asembagus</option>
                                <option value="Banyuglugur">Banyuglugur</option>
                                <option value="Banyuputih">Banyuputih</option>
                                <option value="Besuki">Besuki</option>
                                <option value="Bungatan">Bungatan</option>
                                <option value="Jangkar">Jangkar</option>
                                <option value="Jatibanteng">Jatibanteng</option>
                                <option value="Kapongan">Kapongan</option>
                                <option value="Kendit">Kendit</option>
                                <option value="Mangaran">Mangaran</option>
                                <option value="Mlandingan">Mlandingan</option>
                                <option value="Panarukan">Panarukan</option>
                                <option value="Panji">Panji</option>
                                <option value="Ardirejo">Ardirejo</option>
                                <option value="Mimbaan">Mimbaan</option>
                                <option value="Situbondo">Situbondo</option>
                                <option value="Dawuhan">Dawuhan</option>
                                <option value="Patokan">Patokan</option>
                                <option value="Suboh">Suboh</option>
                                <option value="Sumber Malang">Sumber Malang</option>
                            </x-select>
                            </div>
                        <x-textarea id="alamat" label="Alamat" name="delivery_address" type="text"
                            placeholder="[Nama Jalan, RT/RW, Kelurahan, Kecamatan, No. Rumah]" required></x-textarea>
                        <x-textarea id="note" label="Catatan" name="delivery_note" type="text" required>
                        </x-textarea>

                        <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>

                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 mb-4">
                            <p class="text-gray-500 text-sm mb-2">
                                Detail Transfer
                            </p>
                            <div class="xl:flex justify-between mb-2">
                                <p class="text-gray-500 text-sm">
                                    Nama Bank
                                </p>
                                <p class="text-gray-900 text-sm">
                                    {{ $setting->bank_name }}
                                </p>
                            </div>
                            <div class="xl:flex justify-between mb-2">
                                <p class="text-gray-500 text-sm">
                                    Nomor Rekening
                                </p>
                                <p class="text-gray-900 text-sm">
                                    {{ $setting->bank_account }}
                                </p>
                            </div>
                            <div class="xl:flex justify-between mb-2">
                                <p class="text-gray-500 text-sm">
                                    Atas Nama
                                </p>
                                <p class="text-gray-900 text-sm">
                                    {{ $setting->bank_account_name }}
                                </p>
                            </div>
                        </div>
                        <div class="xl:flex justify-end gap-x-3">
                            <x-link-button color="gray" id="btnCancel" data-drawer-hide="drawer-example"
                                aria-controls="drawer-example" class="justify-center px-8">
                                Batal
                            </x-link-button>
                            <x-button>
                                Konfirmasi Pesanan
                            </x-button>
                        </div>
                    </div>

                    <div id="detailTakeAway" class="hidden">
                        <span class="badge badge-primary">
                            Soon
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 hidden" id="btnConfirmation">
                <x-link-button data-drawer-hide="drawer-example" aria-controls="drawer-example" id="btnCancel"
                    class="bg-red-700 justify-center">
                    Batal
                </x-link-button>
                <x-link-button class="bg-primary justify-center" id="btnOrder">
                    Pesan
                </x-link-button>
            </div>
        </div>

        @push('js-internal')
            <script>
                let subTotal = 0;
                let totalPrice = 0;
                let cart = [];

                function calculateOrder() {
                    subTotal = 0;
                    totalPrice = 0;
                    cart = [];

                    let cartList = $('#cartList').children();
                    let cartListLength = cartList.length;
                    if (cartListLength == 0) {
                        return false;
                    }

                    $('.cart-item').each(function() {
                        let id = $(this).data('id');
                        let name = $(this).data('name');
                        let quantity = $('#quantity-' + id).val();
                        let price = $(this).data('price');
                        total = price * quantity;

                        if (quantity == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Jumlah ' + name + ' tidak boleh 0',
                            });
                            $('#quantity-' + id).focus();
                            return false;
                        }

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

                    $('#subTotal').html('Rp ' + subTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $('#totalPrice').html('Rp ' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $('#detailOrderForm').removeClass('hidden');
                }

                function addCart(id) {
                    // check if user is logged in
                    @if (!auth()->check())
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Anda harus login terlebih dahulu',
                        });
                        window.location.href = "{{ route('login') }}";
                    @endif

                    $('#detailOrderForm').addClass('hidden');
                    $('#btnConfirmation').addClass('hidden');
                    $('#cartLabel-' + id).html('<i class="fas fa-check"></i> Ditambahkan');
                    $('#addCart-' + id).addClass('bg-gray-400 cursor-not-allowed');

                    let isExist = $('#cart-item-' + id).length;
                    if (isExist) {
                        return false;
                    }

                    let url = "{{ route('user.menu.add-cart', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function(data) {
                            $('#cartList').append(data);
                        }
                    });
                }

                function removeCartItem(id) {
                    $('#cart-item-' + id).remove();
                    $('#detailOrderForm').addClass('hidden');
                    $('#btnConfirmation').addClass('hidden');
                    $('#cartLabel-' + id).html('Tambah ke Pesanan');
                    $('#addCart-' + id).removeClass('bg-gray-400 cursor-not-allowed');
                }

                function hideConfirmationButton() {
                    $('#detailOrderForm').addClass('hidden');
                    $('#btnConfirmation').addClass('hidden');
                    return false;
                }

                $(function() {
                    $('input[name="search"]').on('keydown', function() {
                        let value = $(this).val();
                        if (event.keyCode == 13) {
                            $.ajax({
                                url: '{{ route('user.menu.search') }}',
                                type: 'GET',
                                data: {
                                    value: value
                                },
                                success: function(data) {
                                    $('#listMenu').html(data);
                                }
                            })
                        }
                    });

                    $('select#price').on('change', function() {
                        let value = $(this).val();
                        $.ajax({
                            url: '{{ route('user.menu.sort-by-price') }}',
                            type: 'GET',
                            data: {
                                value: value
                            },
                            success: function(data) {
                                $('#listMenu').html(data);
                            }
                        })
                    });

                    $('#category').on('change', function() {
                        let value = $(this).val();
                        $.ajax({
                            url: '{{ route('user.menu.sort-by-category') }}',
                            type: 'GET',
                            data: {
                                value: value
                            },
                            success: function(data) {
                                $('#listMenu').html(data);
                            }
                        })
                    });

                    $('#btnCancel').on('click', function() {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Peringatan',
                            text: 'Apakah anda yakin ingin membatalkan pesanan?',
                            showCancelButton: true,
                            confirmButtonText: `Ya`,
                            confirmButtonColor: '#19743b',
                            cancelButtonText: `Tidak`,
                            cancelButtonColor: '#6b7280',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            } else {
                                return false;
                            }
                        })
                    });

                    $('#input[name="quantity"]').on('keyup', function() {
                        $(this).val($(this).val().replace(/[^0-9]/g, ''));
                    });

                    $('#order_type').on('change', function() {
                        let value = $(this).val();
                        if (value == 'take_away') {
                            $('#detailTakeAway').removeClass('hidden');
                            $('#detailDeliveryOrder').addClass('hidden');
                        } else {
                            $('#detailTakeAway').addClass('hidden');
                            $('#detailDeliveryOrder').removeClass('hidden');

                            // reset all form value
                            $('#detailDeliveryOrder input[name="customer_name"]').val('');
                            $('#detailDeliveryOrder textarea[name="phone_number"]').val('');
                            $('#detailDeliveryOrder textarea').val('');
                            $('#detailDeliveryOrder textarea').html('');
                        }
                    });

                    $('#detailDeliveryOrder button[type="submit"]').on('click', function(e) {
                        e.preventDefault();
                        let invoice = $('#detailDeliveryOrder input[name="invoice"]').val();
                        let customer_name = $('#detailDeliveryOrder input[name="customer_name"]').val();
                        let delivery_phone = $('#detailDeliveryOrder input[name="delivery_phone"]').val();
                        let delivery_address = $('#detailDeliveryOrder textarea[name="delivery_address"]').val();
                        let delivery_note = $('#detailDeliveryOrder textarea[name="delivery_note"]').val();
                        let district = $('#detailDeliveryOrder select[name="district"]').val();
                        let regency = $('#detailDeliveryOrder select[name="regency"]').val();

                        // append district and regency to delivery_address
                        delivery_address += ', ' + district + ', ' + regency;

                        if (invoice != '' && customer_name != '' && delivery_phone != '' && delivery_address !=
                            '' && delivery_note != '') {

                            $.ajax({
                                url: '{{ route('admin.delivery-order.store') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    invoice: invoice,
                                    customer_name: customer_name,
                                    delivery_phone: delivery_phone,
                                    delivery_address: delivery_address,
                                    delivery_note: delivery_note,
                                    sub_total: subTotal,
                                    total_payment: total,
                                    payment_method: 'transfer',
                                    cart: cart
                                },
                                beforeSend: function() {
                                    $('#detailDeliveryOrder button[type="submit"]').html(
                                        '<i class="fas fa-spinner fa-spin mr-2"></i> Loading...'
                                    );
                                    $('#detailDeliveryOrder button[type="submit"]').attr('disabled',
                                        true);
                                },
                                success: function(response) {
                                    if (response.status == 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil',
                                            text: response.message,
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: response.message,
                                        });
                                        // remove disabled attribute
                                        $('#detailDeliveryOrder button[type="submit"]').html(
                                            'Konfirmasi Pesanan');
                                        $('#detailDeliveryOrder button[type="submit"]').attr('disabled',
                                            false);
                                    }
                                },
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Mohon lengkapi data terlebih dahulu',
                            });
                            return false;
                        }
                    })
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
                    class="mb-4 text-xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-3xl dark:text-white">
                    Nampaknya anda belum login
                </h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-lg sm:px-16 lg:px-48 dark:text-gray-400">
                    Silahkan login terlebih dahulu untuk melanjutkan pemesanan
                </p>
                <div class="xl:flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-2">
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
