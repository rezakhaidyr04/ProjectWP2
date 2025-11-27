@extends('layouts.app')

@section('title', 'Konfirmasi Password - Game Top Up')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-header bg-primary text-white py-4">
                    <h4 class="mb-0"><i class="fas fa-shield-alt me-2"></i>Konfirmasi Password</h4>
                </div>
                <div class="card-body p-5">
                    <p class="small text-muted mb-4">
                        <i class="fas fa-info-circle me-1"></i>
                        Ini adalah area aman aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>Error!</strong>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" 
                                   placeholder="Masukkan password Anda" required autofocus>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check-circle me-2"></i>Konfirmasi
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="small">Kembali ke login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
