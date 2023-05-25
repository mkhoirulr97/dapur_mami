<x-guest-layout>
    <x-user-header />

    {{-- heading --}}
    <section class="bg-white">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-700 from-green-500">Sentuhan
                        Rasa,</span> <br>Kasih Terhidang
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Rasakan makanan penuh kasih dan sentuhan rasa memukau di tempat kami. Selamat datang!
                </p>
                <a href="{{ route('user.menu') }}"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-900">
                    Jelajahi Menu
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="{{ 'https://api.whatsapp.com/send?phone=' . $whatsapp }}" target="_blank"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Hubungi Kami
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{ asset('assets/images/rightimage.png') }}" alt="mockup">
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-white">
        <div class="py-6 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-12 md:space-y-0">
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-green-100 lg:h-12 lg:w-12">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Autentik</h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        Nikmati hidangan dengan cita rasa asli Indonesia yang autentik di setiap sajian.Kami menawarkan
                        berbagai pilihan hidangan Indonesia yang lezat dan otentik.
                    </p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-green-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Terjangkau</h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        Harga terjangkau dengan porsi yang melimpah, sehingga Anda dapat menikmati hidangan lezat tanpa
                        perlu khawatir dengan harga yang mahal.
                    </p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-green-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-8 h-9" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Pengalaman</h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        Suasana yang nyaman dan cozy akan membuat pengalaman makan Anda semakin
                        menyenangkan dan dirancang dengan suasana yang bersahabat dan ramah
                    </p>
                </div>
                <div>
                    <div
                        class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-green-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Pelayanan</h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        Pelayanan yang ramah dan profesional sehingga Anda merasa dihargai sebagai pelanggan. Kami
                        selalu berusaha memberikan pelayanan yang terbaik untuk pelanggan kami
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Popular Food --}}
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-16 lg:py-32 xl:grid grid-cols-12">
            <div class="col-span-4">
                <h1 class="max-w-2xl mb-4 text-3xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-4xl">
                    Menu Favorit Kami
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-lg">
                    Berikut adalah menu favorit kami yang paling banyak dipesan oleh pelanggan kami.
                </p>
                <a href="{{ route('user.menu') }}"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-700 hover:text-white">
                    Jelajahi Menu
                </a>
            </div>
            <div class="carousel carousel-center w-full p-4 space-x-4 rounded-box h-96 col-span-8">
                @foreach ($favoriteMenu as $data)
                    <div class="carousel-item block">
                        <div class="avatar">
                            <div class="w-64 h-64 rounded rounded-lg">
                                <img
                                    src="{{ $data->menu->image ? asset($data->menu->image) : asset('images/menu/default.jpg') }}" />
                            </div>
                        </div>
                        <div class="flex items-center">
                            <a href="{{ route('user.menu') }}" class="font-medium mt-6" data-carousel-title>
                                {{ $data->menu->name }}
                            </a>
                            <i class="fas fa-chevron-right ml-4 mt-6 fa-sm" data-carousel-next></i>
                        </div>
                        <span class="text-sm font-light">
                            <i class="fas fa-bell-concierge text-yellow-500"></i>
                            Terjual {{ $data->total_quantity }} item</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Booking --}}
    <section class="bg-white dark:bg-gray-900">
        <div class="pt-16 pb-8 px-4 mx-auto max-w-screen-xl sm:py-24 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-gray-900 dark:text-white">
                    Buat Kegiatan Jadi Lebih Berkesan</h2>
                <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">
                    Kami menyediakan ruangan yang dapat digunakan untuk berbagai macam kegiatan seperti rapat,
                    seminar, workshop, dan lain-lain
                </p>
            </div>
        </div>
    </section>
    <section class="bg-white dark:bg-gray-900">
        <div class="gap-16 items-center pt-6 pb-6 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-10 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">
                    Reservasi Tempat</h2>
                <p class="mb-4">
                    Fitur reservasi pada website Dapur Mami memungkinkan pengguna memesan tempat dengan mudah dan cepat.
                    Pengguna dapat memilih tanggal dan waktu kunjungan, jumlah orang, serta melihat ketersediaan meja
                    pada jam kunjungan. Setelah memilih meja, pengguna bisa reservasi dan menerima konfirmasi pada
                    admin.
                    <br><br>
                    Pengguna dapat menjamin tempat mereka dan menikmati makanan yang lezat tanpa khawatir tidak
                    mendapatkan tempat.
                </p>
                <a href="{{ 'https://api.whatsapp.com/send?phone=' . $whatsapp }}" target="_blank"
                    class="inline-flex items-center justify-center mt-5 px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    <i class="fab fa-whatsapp mr-2"></i>
                    Pesan Sekarang
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="w-full rounded-lg" src="{{ asset('assets/images/gathering1.jpg') }}"
                    alt="office content 1">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" src="{{ asset('assets/images/gathering2.jpg') }}"
                    alt="office content 2">
            </div>
        </div>
    </section>
    <div class="my-24"></div>
    <section class="bg-white dark:bg-gray-900">
        <div
            class="gap-16 items-center pt-6 pb-6 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-10 lg:px-6">

            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="w-full rounded-lg" src="{{ asset('assets/images/deliveryorder1.jpg') }}"
                    alt="office content 1">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" src="{{ asset('assets/images/deliveryorder2.jpg') }}"
                    alt="office content 2">
            </div>
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">
                    Pesan Antar</h2>
                <p class="mb-4">
                    Fitur pesan antar memungkinkan pengguna melakukan proses pemesanan makanan dan minuman secara
                    online. Pengguna hanya perlu melakukan proses konfirmasi pembayaran, dan makanan akan diantar ke
                    alamat yang diinginkan.
                    <br><br>
                    Pengguna dapat melakukan tracking pada makanan yang diantar
                </p>
            </div>
        </div>
    </section>

    <x-user-footer />

    @push('js-internet')
        <script></script>
    @endpush
</x-guest-layout>
