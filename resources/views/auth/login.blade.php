@extends('layouts.app')

@section('title', 'Masuk - Pay to Win')

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
                        background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(168, 85, 247, 0.2));
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    ">
                        <i class="fas fa-user" style="font-size: 2rem; color: var(--accent-primary);"></i>
                    </div>
                    <h3 class="fw-bold text-gradient mb-1">Selamat Datang</h3>
                    <p class="text-muted">Masuk ke akun Anda</p>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert mb-4" style="background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.3); border-radius: 12px; color: var(--accent-rose);">
                            <i class="fas fa-exclamation-circle me-2"></i>Email atau password salah
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

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
                                       placeholder="nama@email.com" required autofocus
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
                                    <i class="fas fa-lock" style="color: var(--accent-primary);"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" 
                                       placeholder="Masukkan password" required
                                       style="border-left: none; border-radius: 0 12px 12px 0;">
                            </div>
                            @error('password')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" style="cursor: pointer;">
                                <label class="form-check-label text-muted" for="remember" style="cursor: pointer;">
                                    Ingat saya
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-decoration-none small" style="color: var(--accent-primary);">
                                Lupa password?
                            </a>
                        </div>

                        <!-- Demo Account Info -->
                        <div class="mb-4 p-3" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1)); border-radius: 12px; border: 1px solid rgba(99, 102, 241, 0.2);">
                            <p class="fw-medium small mb-2" style="color: var(--accent-primary);">
                                <i class="fas fa-info-circle me-1"></i>Akun Demo
                            </p>
                            <p class="text-muted small mb-1">
                                <strong>Email:</strong> test@example.com
                            </p>
                            <p class="text-muted small mb-0">
                                <strong>Password:</strong> password
                            </p>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-4" style="border-radius: 12px; padding: 0.875rem;">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="text-muted mb-0">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="fw-semibold text-decoration-none" style="color: var(--accent-primary);">
                                Daftar sekarang
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
        background: var(--gradient-primary);
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
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        color: var(--text-primary);
    }
    
    .form-control::placeholder {
        color: var(--text-muted);
    }
    
    .form-check-input:checked {
        background-color: var(--accent-primary);
        border-color: var(--accent-primary);
    }
</style>
@endsection
@endsection
