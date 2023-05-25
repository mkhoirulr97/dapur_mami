<x-app-layout>
    <x-breadcrumbs name="material" />
    <h1 class="font-semibold text-2xl my-8">Manajemen Bahan</h1>

    <div class="text-end">
        <x-link-button color="gray" route="{{ route('admin.material.create') }}">Tambah Bahan</x-link-button>
    </div>

    <x-card-container>
        <table class="overflow-x-auto w-full" id="materialTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Pembayaran</th>
                    <th>Sisa</th>
                    <th>Pembelian</th>
                    <th>Status</th>
                    <th>Suplier</th>
                    <th>Oleh</th>
                    <th>Tgl Pembelian</th>
                    <th>Nota</th>
                    <th>Menu</th>
                    <th>Detail Pembelian</th>
                </tr>
            </thead>
        </table>

        @push('js-internal')
            <script>
                function process(id) {
                    let url = '{{ route('admin.material.process', ':id') }}';
                    url = url.replace(':id', id);
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#19743b',
                        cancelButtonColor: '#d33',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(data) {
                                    Swal.fire(
                                        'Berhasil!',
                                        'Data telah diproses.',
                                        'success'
                                    ).then((result) => {
                                        location.reload();
                                    });
                                },
                                error: function(data) {
                                    Swal.fire(
                                        'Gagal!',
                                        'Data gagal diproses.',
                                        'error'
                                    )
                                }
                            });
                        }
                    });
                }

                $(function() {
                    $('#materialTable').DataTable({
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        autoWidth: false,
                        ajax: "{{ route('admin.material.index') }}",
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'date',
                                name: 'date'
                            },
                            {
                                data: 'total_paid',
                                name: 'total_paid'
                            },
                            {
                                data: 'total_return',
                                name: 'total_return'
                            },
                            {
                                data: 'total_purchase',
                                name: 'total_purchase'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'supplier',
                                name: 'supplier'
                            },
                            {
                                data: 'user',
                                name: 'user'
                            },
                            {
                                data: 'purchase_date',
                                name: 'purchase_date'
                            },
                            {
                                data: 'purchase_proof',
                                name: 'purchase_proof'
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'detail',
                                name: 'detail',
                                orderable: false,
                                searchable: false,
                            }
                        ],
                    });
                });
            </script>
        @endpush
    </x-card-container>

</x-app-layout>
