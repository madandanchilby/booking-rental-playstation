<div>
    @section('title', 'Customer Login')

    @section('page-style')
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
    @endsection

    <div class="d-flex" style="min-height: 100vh;">
        <div class="col-12 col-md-6">
            <div class="m-2">
                <img src="{{ asset('/assets/img/ps-logo.png') }}" alt="Logo" style="width: 250px; height: 100px;"
                    class="rounded-pill">
            </div>
            <div class="w-100 mt-4">
                <div class="authentication-wrapper authentication-basic container">
                    <div class="authentication-inner">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">Login</h4>

                                <form wire:submit="login" class="mb-3">
                                    @if (session('auth.error'))
                                        <div class="alert alert-danger" role="alert">{{ session('auth.error') }}</div>
                                    @endif

                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                                    @endif

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input wire:model="form.username" type="text" class="form-control"
                                            id="username" name="username" placeholder="Masukkan username" autofocus>
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input wire:model="form.password" type="password" id="password"
                                                class="form-control" name="password"
                                                placeholder="Masukkan password" aria-describedby="password" />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                                    </div>
                                </form>

                                <p class="text-center">
                                    <span>Belum memiliki akun?</span>
                                    <a href="{{ route('customer.auth.register') }}">
                                        <span>Buat akun di sini</span>
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
