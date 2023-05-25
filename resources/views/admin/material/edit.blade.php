<x-app-layout>
    <x-breadcrumbs name="material.edit" :data="$material" />
    <h1 class="font-semibold text-2xl my-8">Ubah Bahan</h1>

    <x-card-container>
        <div class="sm:flex gap-x-2 mb-8">
            <x-link-button color="gray" id="add">
                <span>Tambah Bahan</span>
            </x-link-button>
        </div>

        <div id="form">
            @foreach ($material->materialTransactionDetail as $data)
                <div class="sm:flex justify-between items-center form">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <x-input id="name" name="name" label="Nama Bahan" type="text" :value="$data->name"
                        required />
                    <x-input id="quantity" name="quantity" label="Jumlah" type="number" :value="$data->quantity" required />
                    <x-select id="unit_type" name="unit_type" label="Satuan" required class="max-w-sm">
                        <option value="kg" {{ $data->unit_type == 'kg' ? 'selected' : '' }}>Kilogram</option>
                        <option value="g" {{ $data->unit_type == 'g' ? 'selected' : '' }}>Gram</option>
                        <option value="mg" {{ $data->unit_type == 'mg' ? 'selected' : '' }}>Miligram</option>
                        <option value="l" {{ $data->unit_type == 'l' ? 'selected' : '' }}>Liter</option>
                        <option value="ml" {{ $data->unit_type == 'ml' ? 'selected' : '' }}>Mililiter</option>
                        <option value="pcs" {{ $data->unit_type == 'pcs' ? 'selected' : '' }}>Pcs</option>
                    </x-select>
                    <x-input id="ppu" name="ppu" label="Harga" type="number" :value="$data->ppu" required />

                    <svg id="remove" xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-red-500 cursor-pointer mt-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            @endforeach
        </div>

        <div class="flex justify-between items-end gap-x-3">
            <x-input id="total_paid" name="total_paid" label="Total Pembayaran" type="text" :value="$material->total_paid"
                required />
            <div></div>
            <span class="text-lg font-semibold mb-3" id="textTotalPurchase">
                Total Pembelian: Rp. {{ number_format($material->total_purchase, 0, ',', '.') }}
            </span>
        </div>

        <div class="text-end">
            <x-button id="btnCalculate" color="gray" type="button" class="mt-4">
                <span>
                    Hitung Total Pembelian
                </span>
            </x-button>
        </div>

        <div class="text-end">
            <x-button color="green" class="mt-4 hidden">
                <span>
                    Simpan Perubahan
                </span>
            </x-button>
        </div>
    </x-card-container>

    @push('js-internal')
        <script>
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
            let removed_item = [];
            let total_purchase = parseInt('{{ $material->total_purchase }}');
            let total_paid = $('#total_paid').val();

            $(document).on('click', '#remove', function(e) {
                e.preventDefault();
                // kurangi total pembelian dengan harga bahan dikali jumlah
                total_purchase -= parseInt($(this).parent().find('#ppu').val()) * parseInt($(this).parent().find(
                    '#quantity').val());
                $('#textTotalPurchase').text(`Total Pembelian: Rp. ${total_purchase.toLocaleString('id-ID')}`);
                removed_item.push(id = $(this).parent().find('input[name="id"]').val());
                console.log(removed_item);
                $(this).parent().remove();
            });

            $('#btnCalculate').on('click', function(e) {
                e.preventDefault();
                total_paid = $('#total_paid').val();
                total_purchase = 0;
                $('.form').each(function() {
                    total_purchase += parseInt($(this).find('#ppu').val()) * parseInt($(this).find('#quantity')
                        .val());
                });
                $('#textTotalPurchase').text(`Total Pembelian: Rp. ${total_purchase.toLocaleString('id-ID')}`);

                if (total_paid < total_purchase) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Total pembayaran tidak boleh kurang dari total pembelian!',
                    });
                    $('#total_paid').focus();
                    $('button[type="submit"]').addClass('hidden');
                } else {
                    $('button[type="submit"]').removeClass('hidden');
                }
            })

            $('button[type="submit"]').on('click', function(e) {
                e.preventDefault();
                item = [];
                $('.form').each(function() {
                    item.push({
                        id: $(this).find('input[name="id"]').val(),
                        name: $(this).find('#name').val(),
                        quantity: $(this).find('#quantity').val(),
                        unit_type: $(this).find('#unit_type').val(),
                        ppu: $(this).find('#ppu').val(),
                        total: parseInt($(this).find('#ppu').val()) * parseInt($(this).find('#quantity')
                            .val()),
                    });
                });

                $.ajax({
                    url: '{{ route('admin.material.update', $material->id) }}',
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        item: item,
                        removed_item: removed_item,
                        total_purchase: total_purchase,
                        total_paid: total_paid,
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data bahan telah diperbarui!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('admin.material.index') }}';
                            }
                        });
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.responseJSON.message,
                        });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
