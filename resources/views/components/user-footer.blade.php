<footer class="p-4 bg-white md:p-8 lg:p-10 mt-64 dark:bg-gray-800">
    <div class="mx-auto max-w-screen-xl text-center">
        <a href="#" class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="w-10 h-10 mr-2">
            Dapur Mami
        </a>
        <p class="my-6 text-gray-500 dark:text-gray-400">Rasakan makanan penuh kasih dan sentuhan rasa memukau di
            tempat kami. Selamat datang!</p>
        <ul class="flex flex-wrap justify-center items-center mb-6 text-gray-900 dark:text-white">
            <li>
                <a href="/" class="mr-4 hover:underline md:mr-6 ">Home</a>
            </li>
            <li>
                <a href="{{route('user.menu')}}" class="mr-4 hover:underline md:mr-6 ">Menu</a>
            </li>
            <li>
                <a href="#" class="mr-4 hover:underline md:mr-6 ">
                    {{-- soon badge --}}
                    Pengumuman <span class="px-2 py-1 ml-2 text-xs font-semibold text-white bg-red-500 rounded-full">Soon</span>
                </a>
            </li>
            {{-- <li>
                <a href="#" class="mr-4 hover:underline md:mr-6 ">Kontak Kami</a>
            </li> --}}
        </ul>
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="#"
                class="hover:underline">Suka Maju™</a>. All Rights Reserved.</span>
    </div>
</footer>
