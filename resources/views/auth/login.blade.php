<x-guest-layout>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6  pb-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                <img src="{{ asset('assets/images/logo.png') }}" width="129" alt="">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-8 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <x-input id="email" label="Email" name="email" type="email" required autofocus />

                <!-- Password -->
                <x-input id="password" label="Password" name="password" type="password" required />

                <div class="flex items-center justify-between mt-4">
                    {{-- forgot password --}}
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                            {{ __('Lupa password?') }}
                        </a>
                    </div>

                    <x-button class="ml-3">Masuk</x-button>
                </div>
            </form>
        </div>
    </div>

    @push('js-internal')
        <script>
            $(function() {
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
            });
        </script>
    @endpush
</x-guest-layout>
