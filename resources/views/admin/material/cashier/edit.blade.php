<x-app-layout>
    <x-breadcrumbs name="material.edit" :data="$material" />
    <h1 class="font-semibold text-2xl my-8">
        Konfirmasi Pembelian
    </h1>

    <x-card-container>

        <div class="lg:flex justify-between items-center gap-x-3">
            <div class="">
                <x-input id="total_return" name="total_return" label="Total Kembali" :value="$material->total_return" type="number"
                    required />
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="purchase_proof">
                    Bukti Pembelian <span class="text-red-500">*</span>
                </label>
                <input
                    class="block w-full text-sm text-green-900 border border-green-300 rounded-lg cursor-pointer bg-green-50"
                    id="purchase_proof" name="purchase_proof" type="file" />
                <label class="label">
                    @error('purchase_proof')
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    @enderror
                </label>
            </div>
            <table class="">
                <tr>
                    <td>
                        Total uang yang diberikan
                    </td>
                    <td>:</td>
                    <td>
                        <span id="textTotalPaid" class="font-semibold">
                            Rp. {{ number_format($material->total_paid, 0, ',', '.') }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Total pembelian
                    </td>
                    <td>:</td>
                    <td>
                        <span id="textTotalPurchase" class="font-semibold">
                            Rp. {{ number_format($material->total_purchase, 0, ',', '.') }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        <hr class="my-4">

        <div id="form">
            @foreach ($material->materialTransactionDetail as $data)
                <div class="sm:flex justify-between items-center gap-x-3 form">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <x-select id="status" name="status" label="Status">
                        <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Dibeli</option>
                        <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Dibatalkan</option>
                    </x-select>
                    <x-input id="name" name="name" label="Nama Bahan" type="text" :value="$data->name" required
                        disabled />
                    <x-input id="quantity" name="quantity" label="Jumlah" type="number" :value="$data->quantity" required
                        disabled />
                    <x-select id="unit_type" name="unit_type" label="Satuan" required disabled class="max-w-sm">
                        <option value="kg" {{ $data->unit_type == 'kg' ? 'selected' : '' }}>Kilogram</option>
                        <option value="g" {{ $data->unit_type == 'g' ? 'selected' : '' }}>Gram</option>
                        <option value="mg" {{ $data->unit_type == 'mg' ? 'selected' : '' }}>Miligram</option>
                        <option value="l" {{ $data->unit_type == 'l' ? 'selected' : '' }}>Liter</option>
                        <option value="ml" {{ $data->unit_type == 'ml' ? 'selected' : '' }}>Mililiter</option>
                        <option value="pcs" {{ $data->unit_type == 'pcs' ? 'selected' : '' }}>Pcs</option>
                    </x-select>
                    <x-input id="ppu" name="ppu" label="Harga" type="number" :value="$data->ppu" required
                        disabled />
                </div>
            @endforeach
        </div>

        <div class="text-end">
            <x-button color="green" class="mt-4">
                <span>
                    Konfirmasi Pembelian
                </span>
            </x-button>
        </div>
    </x-card-container>

    @push('js-internal')
        <script>
            let item = [];
            let total_return = 0;


            $('button[type="submit"]').on('click', function(e) {
                e.preventDefault();
                // check if file is uploaded
                if ($('#purchase_proof').val() == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Bukti pembelian belum diupload',
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Apakah anda yakin?',
                        text: 'Periksa kembali data yang anda masukkan. Data yang sudah dikonfirmasi tidak dapat diubah kembali.',
                        showCancelButton: true,
                        confirmButtonText: 'Konfirmasi',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#19743b',
                        cancelButtonColor: '#d33',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            item = [];
                            $('.form').each(function() {
                                item.push({
                                    id: $(this).find('input[name="id"]').val(),
                                    status: $(this).find('#status').val(),
                                });
                            });

                            let formData = new FormData();
                            formData.append('total_return', $('#total_return').val());
                            formData.append('purchase_proof', $('#purchase_proof')[0].files[0]);
                            formData.append('item', JSON.stringify(item));
                            formData.append('_token', '{{ csrf_token() }}');

                            $.ajax({
                                url: "{{ route('admin.material.confirmed', $material->id) }}",
                                method: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                    $('button[type="submit"]').attr('disabled', 'disabled')
                                        .html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                                },
                                success: function(data) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Data berhasil dikonfirmasi',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        window.location.href =
                                            "{{ route('admin.material.index') }}";
                                    });
                                },
                                error: function(data) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: data.responseJSON.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                        }
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
