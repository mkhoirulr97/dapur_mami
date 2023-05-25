<x-app-layout>
    <x-breadcrumbs name="cashier" />
    <h1 class="font-semibold text-2xl my-8">Daftar Kasir</h1>

    <div class="flex justify-end mb-4">
        <x-link-button route="{{ route('admin.cashier.create') }}" color="gray">
            Tambah Kasir
        </x-link-button>
    </div>

    <div class="overflow-x-auto">
        <table id="cashierTable">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Jenis Kelamin</th>
                    <th class="px-4 py-2">No. Telepon</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="modal" id="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Peringatan!</h3>
            <p class="py-4">
                Apakah anda yakin ingin menghapus <b id="fullname"></b> ini?
            </p>
            <div class="modal-action">
                <x-link-button route="#" color="gray">Batal</x-link-button>
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" color="red">Hapus</x-button>
                </form>
            </div>
        </div>
    </div>

    @push('js-internal')
        <script>

            function btnDelete(id, fullname) {
                $('#fullname').text(fullname);
                let url = "{{ route('admin.cashier.destroy', ':id') }}".replace(':id', id);
                $('#modal form').attr('action', url);
            }

            $(function() {
                $('#cashierTable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: "{{ route('admin.cashier.index') }}",
                    columns: [{
                            data: 'fullname',
                            name: 'fullname'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'sex',
                            name: 'sex'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
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
                    title: 'Gagal',
                    text: '{{ Session::get('error') }}',
                });
            @endif
        </script>
    @endpush
</x-app-layout>
