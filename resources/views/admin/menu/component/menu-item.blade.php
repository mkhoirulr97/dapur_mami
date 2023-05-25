@forelse ($menus as $menu)
    <div onclick="addCart({{ $menu->id }} , {{ $menu->price }})" id="menu-{{ $menu->id }}"
        class="w-full bg-white h-fit rounded-2xl shadow-xl hover:shadow-2xl">
        <a href="#">
            <img class="rounded-t-lg w-full h-48 object-cover object-center"
                src="{{ $menu->image ? asset($menu->image) : asset('images/menu/default.jpg') }}" />
        </a>
        <div class="px-5 pb-5 mt-4">
            <a>
                <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
                    {{ $menu->name }}</h5>
            </a>
            <p class="mt-2 text-gray-600 dark:text-gray-400 my-4 truncate hover:">
                {{ $menu->weight }} gram
            </p>
            <div class="flex items-end justify-between">
                <span class="flex md:text-lg lg:text-xl xl:text-lg font-bold text-gray-900 dark:text-white">
                    Rp. {{ number_format($menu->price, 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>
@empty
    {{-- sweet alert --}}
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Menu tidak ditemukan!',
        })
    </script>
@endforelse
