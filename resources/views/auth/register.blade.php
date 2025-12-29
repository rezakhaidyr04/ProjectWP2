@extends('layouts.app')

@section('title', 'Daftar - Pay to Win')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-md-6 col-lg-5">
            <!-- Card -->
            <div class="card" data-aos="fade-up" style="border-radius: 24px; overflow: hidden;">
                <!-- Header -->
                <div class="text-center p-4 pb-0">
                    <div class="icon-wrapper mx-auto mb-3" style="
                        width: 80px;
                        height: 80px;
                        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(6, 182, 212, 0.2));
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    ">
                        <i class="fas fa-user-plus" style="font-size: 2rem; color: var(--accent-emerald);"></i>
                    </div>
                    <h3 class="fw-bold text-gradient mb-1">Buat Akun</h3>
                    <p class="text-muted">Bergabung dan mulai top-up game favorit</p>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert mb-4" style="background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.3); border-radius: 12px; color: var(--accent-rose);">
                            <i class="fas fa-exclamation-circle me-2"></i>Periksa kembali data Anda
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-medium">
                                Nama Lengkap <span style="color: var(--accent-rose);">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: transparent; border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="fas fa-user" style="color: var(--accent-emerald);"></i>
                                </span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" 
                                       placeholder="John Doe" required autofocus
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            @error('name')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium">
                                Email <span style="color: var(--accent-rose);">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: transparent; border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="fas fa-envelope" style="color: var(--accent-primary);"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="nama@email.com" required
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            @error('email')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-medium">
                                Password <span style="color: var(--accent-rose);">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: transparent; border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="fas fa-lock" style="color: var(--accent-amber);"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" 
                                       placeholder="Minimal 8 karakter" required
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-info-circle me-1"></i>Password minimal 8 karakter
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-medium">
                                Konfirmasi Password <span style="color: var(--accent-rose);">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" style="background: transparent; border-right: none; border-radius: 12px 0 0 12px;">
                                    <i class="fas fa-check-circle" style="color: var(--accent-cyan);"></i>
                                </span>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                       id="password_confirmation" name="password_confirmation" 
                                       placeholder="Ketik ulang password" required
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-4" style="border-radius: 12px; padding: 0.875rem; background: linear-gradient(135deg, var(--accent-emerald), var(--accent-cyan));">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="text-muted mb-0">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="fw-semibold text-decoration-none" style="color: var(--accent-primary);">
                                Login di sini
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    .min-vh-75 {
        min-height: 75vh;
    }
    
    .text-gradient {
        background: linear-gradient(135deg, var(--accent-emerald), var(--accent-cyan));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .input-group-text {
        border-color: var(--glass-border);
    }
    
    .form-control {
        background: var(--glass-bg);
        border-color: var(--glass-border);
        color: var(--text-primary);
        padding: 0.75rem 1rem;
    }
    
    .form-control:focus {
        background: var(--glass-bg);
        border-color: var(--accent-emerald);
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        color: var(--text-primary);
    }
    
    .form-control::placeholder {
        color: var(--text-muted);
    }
</style>
@endsection
@endsection
