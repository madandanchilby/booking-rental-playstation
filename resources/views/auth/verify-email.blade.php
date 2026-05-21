@extends('layouts.blankLayout')

@section('title', 'Verifikasi Email')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('content')
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <div class="card px-sm-4 px-2">
                <div class="card-body">
                    <div class="app-brand justify-content-center mb-3">
                        <img src="{{ asset('/assets/img/ps-logo.png') }}" alt="Logo" style="width: 220px; height: 88px;"
                            class="rounded-pill">
                    </div>

                    <h4 class="mb-2 text-center">Verifikasi Email Anda</h4>
                    <p class="mb-4 text-center">
                        Kami sudah mengirim link verifikasi ke email Anda. Silakan buka email tersebut lalu klik link verifikasi
                        sebelum mulai booking.
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success" role="alert">
                            Link verifikasi baru berhasil dikirim.
                        </div>
                    @endif

                    <div class="alert alert-warning" role="alert">
                        Setelah email diverifikasi, Anda bisa langsung lanjut booking PlayStation.
                    </div>

                    <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-primary d-grid w-100">
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary d-grid w-100">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
