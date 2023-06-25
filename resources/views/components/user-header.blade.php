 <!-- Header -->
 <nav class="bg-white border-gray-200 mt-10">
     <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
         <a href="{{ route('user.home') }}" class="flex items-center">
             <img src="{{ asset('assets/images/logo.png') }}" class="h-12 mr-3" alt="Flowbite Logo" />
             <span class="self-center sm:none xl:text-2xl font-semibold whitespace-nowrap dark:text-white ">Dapur
                 Mami</span>
         </a>
         <div class="flex md:order-2">
             @if (auth()->check())
                 <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                     class="flex items-center text-md font-medium text-gray-900 rounded-full hover:text-green-600 dark:hover:text-green-500 md:mr-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
                     type="button">
                     <span class="sr-only">Open user menu</span>
                     <img class="w-12 h-12 mr-2 rounded-full"
                         src="{{ auth()->user()->profile_picture ? asset(auth()->user()->profile_picture) : asset('images/profile_picture/default.jpg') }}"
                         alt="user photo">
                     {{ auth()->user()->first_name }}
                     <svg class="w-4 h-4 mx-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd"
                             d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                             clip-rule="evenodd"></path>
                     </svg>
                 </button>

                 <!-- Dropdown menu -->
                 <div id="dropdownAvatarName"
                     class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                     <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                         <div class="font-medium ">
                             @if (auth()->user()->role == 1)
                                 Kasir
                             @elseif (auth()->user()->role == 2)
                                 Admin
                             @elseif (auth()->user()->role == 3)
                                 Pelanggan
                             @endif
                         </div>
                         <div class="truncate">
                             {{ auth()->user()->email }}
                         </div>
                     </div>
                     <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                         aria-labelledby="dropdownInformationButton">
                         @if (auth()->user()->role == 3)
                             <li>
                                 <a href="{{ route('admin.delivery-order.index') }}"
                                     class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                     Pesanan
                                 </a>
                             </li>
                             <li>
                                 <a href="{{ route('user.user-setting.index') }}"
                                     class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                     Pengaturan
                                 </a>
                             </li>
                         @endif

                         @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                             <li>
                                 <a href="{{ route('admin.dashboard') }}"
                                     class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                     Dashboard
                                 </a>
                             </li>
                         @endif
                     </ul>
                     <div class="py-2">
                         <form action="{{ route('logout') }}" method="POST">
                             @csrf
                             <button type="submit"
                                 class="flex w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                                 <i class="fas fa-sign-out-alt mr-2"></i>
                                 <span>Keluar</span>
                             </button>
                         </form>
                     </div>
                 </div>
             @else
                 <x-link-button route="{{ route('login') }}" class="bg-primary px-8 hidden md:block">
                     Masuk
                 </x-link-button>
             @endif
             <button data-collapse-toggle="navbar-cta" type="button"
                 class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                 aria-controls="navbar-cta" aria-expanded="false">
                 <span class="sr-only">Open main menu</span>
                 <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd"
                         d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                         clip-rule="evenodd"></path>
                 </svg>
             </button>
         </div>
         <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
             <ul
                 class="flex flex-col font-normal p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                 <li>
                     <a href="{{ route('user.home') }}"
                         class="block py-2 pl-3 pr-4 {{ request()->routeIs('user.home') ? 'text-primary' : 'text-gray-600 hover:text-primary' }} rounded md:bg-transparent md:p-0"
                         aria-current="page">Beranda</a>
                 </li>
                 <li>
                     <a href="{{ route('user.menu') }}"
                         class="block py-2 pl-3 pr-4 {{ request()->routeIs('user.menu') ? 'text-primary' : 'text-gray-600 hover:text-primary' }} rounded md:bg-transparent md:p-0">Menu</a>
                 </li>
                 <li>
                     <a href="#"
                         class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-green-700 md:p-0 md:dark:hover:text-green-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                         {{-- soon badge --}}
                         Pengumuman <span
                             class="inline-flex items-center justify-center px-2 py-1 ml-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">Soon</span>
                     </a>
                 </li>
                 <li class="sm:hidden">
                     <a href="{{ route('login') }}"
                         class="block py-2 pl-3 pr-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                         Masuk
                     </a>
                 </li>
             </ul>
         </div>
     </div>
 </nav>
