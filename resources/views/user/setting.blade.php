<x-guest-layout>
    <x-user-header />
    <section class="bg-white my-16">
        <div class="max-w-screen-xl px-4 py-8 mx-auto xl:flex gap-4 justify-center">
            <div class="xl:w-1/4 text-center">
                <div class="avatar">
                    <div class="w-full h-48 rounded-full">
                        <img src="{{ auth()->user()->profile_picture != null ? asset(auth()->user()->profile_picture) : asset('images/profile_picture/default.jpg') }}"
                            id="profileThumbnail" class="object-fit" />
                    </div>
                </div>
                <div class="xl:flex flex-col gap-2 mx-8 mt-3">
                    <x-link-button color="gray" id="btnChangeProfile" class="justify-center">
                        <i class="fas fa-camera mr-2"></i>
                        <span>Ubah Profil</span>
                    </x-link-button>
                    <x-link-button color="red" class="justify-center" route="#resetPasswordModal">
                        <i class="fas fa-key mr-2"></i>
                        <span>Ubah Sandi</span>
                    </x-link-button>
                </div>

                <div class="modal" id="resetPasswordModal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">
                            Formulir Ubah Sandi
                        </h3>
                        <form action="{{ route('admin.setting.password.update') }}" method="POST">
                            <p class="py-4">
                                @csrf
                                <x-input id="current_password" label="Sandi Saat Ini" name="current_password"
                                    type="password" required autocomplete="current_password" />
                                <x-input id="new_password" label="Sandi Baru" name="new_password" type="password"
                                    required autocomplete="new_password" disabled />
                                <x-input id="confirm_password" label="Konfirmasi Sandi Baru" name="confirm_password"
                                    type="password" required autocomplete="confirm_password" disabled />
                            </p>
                            <div class="modal-action">
                                <x-link-button color="gray">
                                    Batal
                                </x-link-button>
                                <x-button class="px-8 hidden" id="resetPassword">
                                    <span>Simpan</span>
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="">
                <form action="{{ route('admin.setting.update', $user->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="file" id="profileImage" name="profile_picture" class="hidden" />

                    <div class="form-control mb-4">
                        <label class="input-group">
                            <div class="form-control">
                                <label class="label cursor-pointer">
                                    <input type="radio" name="sex" value="1"
                                        {{ $user->sex == 1 ? 'checked' : '' }} class="radio checked:bg-primary" />
                                    <span class="text-sm text-gray-700 2xl:label-text bg-transparent">Pria</span>
                                </label>
                            </div>
                            <div class="form-control">
                                <label class="label cursor-pointer">
                                    <input type="radio" name="sex" value="2"
                                        {{ $user->sex == 2 ? 'checked' : '' }} class="radio checked:bg-primary" />
                                    <span class="text-sm text-gray-700 2xl:label-text bg-transparent">Wanita</span>
                                </label>
                            </div>
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-x-4">
                        <x-input id="first_name" label="Nama Depan" name="first_name" type="text" :value="$user->first_name"
                            required />
                        <x-input id="last_name" label="Nama Belakang" name="last_name" type="text" :value="$user->last_name"
                            required />
                    </div>

                    <div class="grid grid-cols-2 gap-x-4">
                        <x-input id="phone" label="Nomor Telepon" name="phone" :value="$user->phone" type="text"
                            required />
                        <x-input-single-datepicker label="Tanggal Lahir" id="birth_date" :value="$user->getBirthDate()"
                            class="block w-full" type="text" name="birth_date" required autocomplete="off"
                            required />
                    </div>

                    <x-textarea id="address" label="Alamat" name="address" required>
                        {{ $user->address }}
                    </x-textarea>

                    <div class="text-end">
                        <x-button class="px-8">
                            <span>Simpan</span>
                        </x-button>
                    </div>

                </form>
            </div>
        </div>
    </section>
    <x-user-footer />

    @push('js-internal')
        <script>
            $(function() {
                $('#btnChangeProfile').on('click', function() {
                    $('#profileImage').click();
                });

                $('#profileImage').on('change', function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onloadend = function() {
                        $('#profileThumbnail').attr('src', reader.result);
                    };
                    if (file) {
                        reader.readAsDataURL(file);
                    } else {
                        $('#profileThumbnail').attr('src', '');
                    }
                });

                let typingTimer;
                let doneTypingInterval = 1000;

                $("#current_password").on("keyup", function() {
                    // disable enter
                    if (event.keyCode === 13) {
                        event.preventDefault();
                    }
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(function() {
                        let val = $('#current_password').val();
                        if (val != null) {
                            $.ajax({
                                url: '{{ route('admin.setting.password.check') }}',
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    password: val
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status == false) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal',
                                            text: 'Sandi saat ini tidak sesuai',
                                        });
                                        $('#current_password').removeClass(
                                            'border-green-500');
                                        $('#current_password').val('');
                                        $('#resetPassword').addClass('hidden');
                                        $('#new_password').prop('disabled', true);
                                        $('#confirm_password').prop('disabled', true);
                                    } else {
                                        $('#new_password').prop('disabled', false);
                                    }
                                }
                            });
                        }
                    }, doneTypingInterval);
                });

                $('#new_password').on('keyup', function() {
                    // disable enter
                    $('#new_password').on('keypress', function(e) {
                        if (e.which == 13) {
                            e.preventDefault();
                        }
                    });
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(function() {
                        let current_password = $('#current_password').val();
                        let new_password = $('#new_password').val();
                        if (current_password == new_password && new_password != '') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Sandi baru tidak boleh sama dengan sandi saat ini',
                            });
                            $('#new_password').val('');
                            $('#resetPassword').addClass('hidden');
                            $('#confirm_password').prop('disabled', true);
                        } else {
                            $('#confirm_password').prop('disabled', false);
                        }
                    }, doneTypingInterval);
                })

                $('#confirm_password').on('keyup', function() {
                    // disable enter
                    $('#confirm_password').on('keypress', function(e) {
                        if (e.which == 13) {
                            e.preventDefault();
                        }
                    });
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(function() {
                        let val = $('#confirm_password').val();
                        let new_password = $('#new_password').val();
                        if (val != new_password && val != '') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Konfirmasi sandi tidak sesuai',
                            });
                            $('#confirm_password').val('');
                            $('#resetPassword').addClass('hidden');
                        } else {
                            $('#confirm_password').addClass('border-green-500');
                            $('#confirm_password').removeClass('border-red-500');
                            $('#resetPassword').removeClass('hidden');
                        }
                    }, doneTypingInterval);
                });

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
