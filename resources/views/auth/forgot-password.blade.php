<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6  pb-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <img src="{{ asset('assets/images/logo.png') }}" width="129" alt="">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-8 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Lupa password anda? Tidak masalah. Beri tahu kami alamat email anda dan kami akan mengirimkan tautan reset password yang akan memungkinkan anda untuk memilih yang baru.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input id="email" label="Email" name="email" type="email" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">Kirim link reset password</x-button>
                </div>
            </form>
        </div>
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
</x-guest-layout>
