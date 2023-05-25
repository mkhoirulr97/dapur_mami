<x-app-layout>
    <x-breadcrumbs name="catalog-management" />
    <h1 class="font-semibold text-2xl my-8">Manajemen Menu</h1>

    <x-card-container>

        <div class="text-end">
            <x-link-button route="{{ route('admin.catalog-management.create') }}" class="mb-4" color="gray">Tambah Menu
            </x-link-button>
        </div>

        <div class="">
            <table class="w-full" id="catalogMenuTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Berat</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Menu</th>
                    </tr>
                </thead>
            </table>
        </div>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#catalogMenuTable').DataTable({
                    responsive: true,
                    serverSide: true,
                    processing: true,
                    autoWidth: false,
                    ajax: {
                        url: '{{ route('admin.catalog-management.index') }}',
                        type: 'GET',
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'image',
                            name: 'image',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'weight',
                            name: 'weight'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                @if (Session::has('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{{ Session::get('success') }}'
                    });
                @endif

                @if (Session::has('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Berhasil',
                        text: '{{ Session::get('error') }}'
                    });
                @endif
            });
        </script>
    @endpush

</x-app-layout>
