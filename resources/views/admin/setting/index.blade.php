<x-app-layout>
    <x-breadcrumbs name="setting" />
    <h1 class="font-semibold text-2xl my-8">Pengaturan</h1>

    <div class="lg:flex gap-x-4">
        <div class="lg:w-1/5">
            <x-card-container>
                <div class="avatar">
                    <div class="w-full rounded rounded-xl">
                        <img src="{{ auth()->user()->profile_picture != null ? asset(auth()->user()->profile_picture) : asset('images/profile_picture/default.jpg') }}"
                            id="profileThumbnail" />
                    </div>
                </div>
                <a class="flex w-full justify-center items-center py-2 bg-gray-700 mt-3 text-white border border-transparent rounded-md shadow-sm"
                    id="btnChangeProfile">
                    <i class="fas fa-camera mr-2"></i>
                    <span>Ubah Profil</span>
                </a>
                <a href="#resetPasswordModal"
                    class="flex w-full justify-center items-center py-2 bg-red-500 mt-3 text-white border border-transparent rounded-md shadow-sm">
                    <i class="fas fa-key mr-2"></i>
                    <span>Ubah Sandi</span>
                </a>

                {{-- Modal --}}
                <!-- Put this part before </body> tag -->
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
            </x-card-container>
        </div>
        <div class="lg:w-4/5">
            <form action="{{ route('admin.setting.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <x-card-container>
                    <h2 class="font-medium text-lg mb-8">Informasi Pribadi</h2>
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
                </x-card-container>
            </form>
        </div>
    </div>

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
</x-app-layout>
