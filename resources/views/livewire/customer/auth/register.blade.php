@php
    use App\Enums\Gender;
@endphp

<div>
    @section('title', 'Customer Registrasi')

    @section('page-style')
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
    @endsection
    @section('page-script')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endsection

    <div class="d-flex" style="min-height: 100vh;">
        <div class="col-12 col-md-6">
            <div class="w-100 mt-4">
                <div class="m-2">
                    <img src="{{ asset('/assets/img/ps-logo.png') }}" alt="Logo"
                        style="width: 250px; height: 100px;" class="rounded-pill">
                </div>
                <div class="authentication-wrapper authentication-basic container-p-y">
                    <div class="authentication-inner">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">Daftar Akun</h4>
                                <p class="mb-4">Setelah daftar, akun akan meminta verifikasi email sebelum bisa dipakai booking.</p>

                                <form wire:submit="register" class="mb-3">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input wire:model="form.name" type="text" class="form-control" id="name"
                                            name="name" placeholder="Masukkan nama" autofocus>
                                        @error('form.name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input wire:model="form.username" type="text" class="form-control"
                                            id="username" name="username" placeholder="Masukkan username">
                                        @error('form.username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input wire:model="form.email" type="email" class="form-control"
                                            id="email" name="email" placeholder="Masukkan email">
                                        @error('form.email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 form-password-toggle">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input wire:model="form.password" type="password" id="password"
                                                class="form-control" name="password"
                                                placeholder="Minimal 8 karakter" aria-describedby="password" />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                        @error('form.password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select wire:model="form.gender" id="gender" class="form-select">
                                            <option value="">Pilih gender</option>
                                            <option value="{{ Gender::MALE->value }}">Laki-laki</option>
                                            <option value="{{ Gender::FEMALE->value }}">Perempuan</option>
                                        </select>
                                        @error('form.gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Nomor HP</label>
                                        <input wire:model="form.phone" type="text" class="form-control" id="phone"
                                            name="phone" placeholder="Contoh: 081234567890">
                                        @error('form.phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <textarea wire:model="form.address" class="form-control" id="address" name="address" rows="3"
                                            placeholder="Masukkan alamat"></textarea>
                                        @error('form.address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3" wire:ignore>
                                    <div class="g-recaptcha"
                                        data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"
                                        data-callback="captchaCallback">
                                    </div>
                                </div>

                                @error('captcha')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <script>
                                    function captchaCallback(token) {
                                        @this.set('captchaToken', token);
                                    }
                                </script>
                                  
                                    

                                    <button type="submit" class="btn btn-primary d-grid w-100">
                                        Daftar
                                    </button>
                                </form>

                                <p class="text-center">
                                    <span>Sudah memiliki akun?</span>
                                    <a href="{{ route('customer.auth.login') }}">
                                        <span>Login di sini</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-0 col-md-6">
            <img src="{{ asset('/assets/img/Internet-Cafe.jpg') }}" alt="Logo" class="w-100 h-100">
        </div>
    </div>
</div>
