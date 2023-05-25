<x-app-layout>
    <x-breadcrumbs name="setting.configuration-store" />
    <h1 class="font-semibold text-2xl my-8">Pengaturan Tempat</h1>

    <div class="grid grid-cols-2">
        <x-card-container>
            <form action="{{ route('admin.configuration-store.update') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-x-3">
                    <div>
                        <x-input id="name" name="name" type="text" label="Nama Toko" :value="$setting->name" />
                        <x-input id="phone" name="phone" type="text" label="Nomor Telepon" :value="$setting->phone" />
                        <x-input id="bank_name" name="bank_name" type="text" label="Nama Bank" :value="$setting->bank_name" />
                    </div>
                    <div>
                        <x-input id="bank_account" name="bank_account" type="text" label="Nomor Rekening"
                            :value="$setting->bank_account" />
                        <x-input id="bank_account_name" name="bank_account_name" type="text"
                            label="Nama Pemilik Rekening" :value="$setting->bank_account_name" />
                        <div class="grid grid-cols-2 gap-x-2">
                            <x-input id="open_at" name="open_at" type="time" label="Jam Buka" :value="$setting->open_at" />
                            <x-input id="close_at" name="close_at" type="time" label="Jam Tutup"
                                :value="$setting->close_at" />
                        </div>
                    </div>
                </div>
                <x-textarea id="address" name="address" label="Alamat Toko">{{ $setting->address }}
                </x-textarea>
                <x-button class="mt-4">
                    Simpan Perubahan
                </x-button>
            </form>
        </x-card-container>
    </div>
    @push('js-internal')
        <script>
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ Session::get('error') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif
        </script>
    @endpush
</x-app-layout>
