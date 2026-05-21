<div>
    @section('title', 'Halaman Registrasi')

    @section('page-style')
        <!-- Page -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
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
                        <!-- Register Card -->
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mb-2">Daftar Akun</h4>

                                <form wire:submit="register" class="mb-3">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input wire:model="form.name" type="text" class="form-control" id="name"
                                            name="name" placeholder="Masukan nama" autofocus>
                                        @error('form.name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input wire:model="form.username" type="text" class="form-control"
                                            id="username" name="username" placeholder="Masukan username" autofocus>
                                        @error('form.username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input wire:model="form.email" type="text" class="form-control"
                                            id="email" name="email" placeholder="Masukan email">
                                        @error('form.email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input wire:model="form.password" type="password" id="password"
                                                class="form-control" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                        </div>
                                        @error('form.password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary d-grid w-100">
                                        Daftar
                                    </button>
                                </form>

                                <p class="text-center">
                                    <span>Sudah memiliki akun?</span>
                                    <a href="{{ route('admin.auth.login') }}">
                                        <span>Login disini</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- Register Card -->
                    </div>
                </div>
            </div>

        </div>
        <div class="col-0 col-md-6">
            <img src="{{ asset('/assets/img/Internet-Cafe.jpg') }}" alt="Logo" class="w-100 h-100">
        </div>
    </div>
</div>
