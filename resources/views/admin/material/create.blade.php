<x-app-layout>
    <x-breadcrumbs name="material.create" />
    <h1 class="font-semibold text-2xl my-8">Tambah Bahan</h1>

    <x-card-container>
        <div class="sm:flex gap-x-2 mb-8">
            <x-link-button color="gray" id="add">
                <span>Tambah Bahan</span>
            </x-link-button>
        </div>

        <div id="form"></div>

        <div class="hidden flex justify-between items-end gap-x-3">
            <x-input id="total_paid" name="total_paid" label="Total Pembayaran" type="number" required />
            <div></div>
            <span class="text-lg font-semibold mb-3" id="textTotalPurchase"></span>
        </div>

        <div class="text-end hidden">
            <x-button color="green" class="mt-4">
                <span>
                    Konfirmasi Pembelian
                </span>
            </x-button>
        </div>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#add').click(function(e) {
                    e.preventDefault();

                    // remove hidden class
                    $('.hidden').removeClass('hidden');

                    $('#form').append(`
                        <div class="sm:flex justify-between items-center form">
                            <x-input id="name" name="name" label="Nama Bahan" type="text" required />
                            <x-input id="quantity" name="quantity" label="Jumlah" type="number" required />
                            <x-select id="unit_type" name="unit_type" label="Satuan" required class="max-w-sm">
                                <option value="kg">Kilogram</option>
                                <option value="g">Gram</option>
                                <option value="mg">Miligram</option>
                                <option value="l">Liter</option>
                                <option value="ml">Mililiter</option>
                                <option value="pcs">Pcs</option>
                            </x-select>
                            <x-input id="ppu" name="ppu" label="Harga" type="number" required />

                            <svg id="remove" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 cursor-pointer mt-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    `);

                    $('select').select2();
                });

                let item = [];
                let total_purchase = 0;
                let total_paid = 0;

                $(document).on('click', '#remove', function(e) {
                    e.preventDefault();
                    $(this).parent().remove();
                });

                $('button[type="submit"]').click(function(e) {
                    // reset item
                    item = [];
                    total_purchase = 0;
                    total_paid = 0;

                    // get total_paid
                    total_paid = $('input[name="total_paid"]').val();

                    e.preventDefault();
                    // count all .form
                    let count = $('.form').length;
                    // loop all .form
                    $('.form').each(function(i) {
                        // get all input
                        let name = $(this).find('input[name="name"]').val();
                        let quantity = $(this).find('input[name="quantity"]').val();
                        let unit_type = $(this).find('select[name="unit_type"]').val();
                        let ppu = $(this).find('input[name="ppu"]').val();
                        let total = quantity * ppu;

                        // push to item
                        item.push({
                            name: name,
                            quantity: quantity,
                            unit_type: unit_type,
                            ppu: ppu,
                            total: total
                        });
                    });

                    // loop item
                    item.forEach(function(i) {
                        parseInt(total_purchase += i.total);
                    });

                    // set textTotalPurchase
                    $('#textTotalPurchase').text(`Total Pembelian: Rp. ${total_purchase}`);

                    // check if total_paid is less than total_purchase
                    if (total_paid < total_purchase) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Total pembayaran tidak boleh kurang dari total pembelian!',
                        });
                    } else {
                        // send ajax
                        $.ajax({
                            url: "{{ route('admin.material.store') }}",
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                item: item,
                                total_paid: total_paid,
                                total_purchase: total_purchase
                            },
                            // on process
                            beforeSend: function() {
                                $('button[type="submit"]').attr('disabled', 'disabled')
                                    .html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                            },
                            success: function(res) {
                                if (res.status) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: res.message,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href =
                                                "{{ route('admin.material.index') }}";
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: res.message,
                                    });
                                }
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
