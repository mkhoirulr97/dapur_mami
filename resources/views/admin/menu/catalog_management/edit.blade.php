<x-app-layout>
    <x-breadcrumbs name="catalog-management.edit" :data="$data" />
    <h1 class="font-semibold text-2xl my-8">Edit Menu</h1>

    <div class="lg:flex gap-x-4">
        <div class="lg:w-1/5">
            <x-card-container>
                <div class="avatar">
                    <div class="w-full rounded rounded-xl">
                        <img src="{{ $data->image != null ? asset($data->image) : asset('images/menu/default.jpg') }}"
                            id="imageThumbnail" />
                    </div>
                </div>
                <a class="flex w-full justify-center items-center py-2 bg-gray-700 mt-3 text-white border border-transparent rounded-md shadow-sm"
                    id="btnChangeImage">
                    <i class="fas fa-camera mr-2"></i>
                    <span>Unggah Gambar</span>
                </a>
            </x-card-container>
        </div>
        <div class="lg:w-4/5">
            <form action="{{ route('admin.catalog-management.update', $data->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <x-card-container>

                    <input type="file" id="image" name="image" class="hidden" />

                    <div class="grid grid-cols-2 gap-x-3">
                        <x-input id="name" label="Nama" name="name" type="text" :value="$data->name"
                            required />
                        <x-input id="price" label="Harga" name="price" type="number" :value="$data->price"
                            required />
                    </div>
                    <div class="grid grid-cols-2 gap-x-3">
                        <x-select id="category" label="Kategori" name="category" class="w-full" :isFit="false">
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}"
                                    {{ $data->category == $category['id'] ? 'selected' : '' }}>
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input id="weight" label="Berat" name="weight" type="number" :value="$data->weight"
                            placeholder="gr" required />
                    </div>

                    <x-textarea id="description" label="Deskripsi" name="description" required>{{ $data->description }}
                    </x-textarea>

                    <div class="text-end mt-4">
                        <x-button class="px-6">
                            <span>Ubah</span>
                        </x-button>
                    </div>
                </x-card-container>
            </form>
        </div>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                $('#btnChangeImage').on('click', function() {
                    $('#image').click();
                });

                $('#image').on('change', function() {
                    const file = this.files[0];
                    const reader = new FileReader();

                    reader.onload = function() {
                        $('#imageThumbnail').attr('src', reader.result);
                    }

                    reader.readAsDataURL(file);
                });

                $('#category').select2();
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
                    title: 'Gagal',
                    text: '{{ Session::get('error') }}'
                });
            @endif
        </script>
    @endpush
</x-app-layout>
