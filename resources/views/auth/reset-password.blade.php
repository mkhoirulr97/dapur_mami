<x-guest-layout>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6  pb-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                <img src="{{ asset('assets/images/logo.png') }}" width="129" alt="">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-8 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                    <x-input id="email" label="Email" name="email" type="email" required autofocus />

                <!-- Password -->
                <x-input id="password" label="Password" name="password" type="password" required />

                <!-- Confirm Password -->
                <x-input id="password_confirmation" label="Konfirmasi Password" name="password_confirmation" type="password" required />

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('Ubah Password') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
