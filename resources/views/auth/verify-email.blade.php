@extends('layouts.app')

@section('title', 'Verifikasi Email - Game Top Up')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <i class="fas fa-envelope text-primary" style="font-size: 3rem;"></i>
                    </div>
                    
                    <h4 class="fw-bold mb-2">Verifikasi Email Anda</h4>
                    
                    <p class="text-muted mb-4">
                        Sebelum melanjutkan, silakan cek email Anda untuk tautan verifikasi. 
                        Jika Anda tidak menerima email, kami dengan senang hati akan mengirimkan yang lain.
                    </p>

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            Email verifikasi baru telah dikirim ke alamat email Anda.
                        </div>
                    @endif

                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-envelope me-2"></i>Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    <hr class="my-4">

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
