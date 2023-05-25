<x-app-layout>
    <x-breadcrumbs name="reservation-config" />
    <h1 class="font-semibold text-2xl my-8">
        Konfigurasi Reservasi
    </h1>

    <div class="grid grid-cols-3">
        <x-card-container>
            <form action="{{ route('admin.reservation-config.update', $reservationConfig->id) }}" method="POST">
                @csrf
                @method('PUT')
                <x-input id="capacity" name="capacity" type="number" label="Kapasitas" :value="$reservationConfig->capacity" />
                <x-input id="max_reservation_per_day" name="max_reservation_per_day" type="number"
                    label="Maksimal Reservasi Per Hari" :value="$reservationConfig->max_reservation_per_day" />
                <x-select id="is_active" name="is_active" label="Status">
                    <option value="1" {{ $reservationConfig->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$reservationConfig->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                </x-select>

                <x-button>
                    Simpan
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
